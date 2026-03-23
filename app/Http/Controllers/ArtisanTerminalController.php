<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use App\Models\OfficeEmployees;
use App\Models\Meeting;
use App\Models\UploadedExcel;
use App\Models\UploadedExcelRow;
use Illuminate\Support\Facades\Http;

class ArtisanTerminalController extends Controller
{
    public function execute(Request $request)
    {
        if ($request->isMethod('post')) {
            $command = $request->input('command'); // Get command from input

            try {
                Artisan::call($command);
                $output = Artisan::output();
                return response()->json(['output' => $output]);
            }
            catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
        return view('welcome');
    }



    public function offlineAll(Request $request)
    {

        $today = Carbon::today()->format('Y-m-d');


        // Check if cron already ran today
        $alreadyRun = OfficeEmployees::whereDate('cron_date', $today)->exists();

        if ($alreadyRun) {
            return response()->json([
                'status' => false,
                'message' => 'Cron already executed today'
            ]);
        }

        // Update all users offline & save cron_date
        OfficeEmployees::query()->update([
            'is_online' => 0,
            'cron_date' => $today
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Employees marked offline & cron_date updated'
        ]);
    }

    public function meetingStatusUpdate(Request $request)
    {
        $now = Carbon::now('Asia/Kolkata');
        $today = Carbon::today('Asia/Kolkata')->toDateString();

        $updatedCount = Meeting::where(function ($q) use ($now) {

            // Case 1: Date is before today
            $q->whereDate('date', '<', $now->toDateString())

                // Case 2: Same date but end_time is past
                ->orWhere(function ($q2) use ($now) {
                $q2->whereDate('date', $now->toDateString())
                    ->whereTime('end_time', '<', $now->toTimeString());
            }
            );
        })
            ->where('status', '!=', 'completed')
            ->update([
            'status' => 'completed',
            'cron_date' => $today
        ]);

        return response()->json([
            'status' => true,
            'message' => $updatedCount . ' past meetings marked as completed'
        ]);
    }
    //     public function sync(Request $request)
// {
//     try {
    //         $sheets = UploadedExcel::where("sheet_status", "live_sync")->get();


    
//         $totalImported = 0;
    //         foreach ($sheets as $sheet) {
    //             if (!$sheet->sheet_url) continue;
    //             // Extract Sheet ID
//             preg_match("/\/d\/(.*?)\//", $sheet->sheet_url, $matches);
//             if (!isset($matches[1])) continue;
    //             $sheetId = $matches[1];


    
//             // ✅ Use CSV export (NO CACHE ISSUE)
//             $url = "https://docs.google.com/spreadsheets/d/$sheetId/export?format=csv";


    
//             $csvData = Http::timeout(20)->get($url);


    
//             if (!$csvData->successful()) continue;
    //             $rows = array_map('str_getcsv', explode("\n", $csvData->body()));
    //             if (count($rows) <= 1) continue;
    //             // Remove header row
//             $headerRow = array_shift($rows);
//             // Array sanitize headers
//             $formatHeader = function ($str) {
//                 // Remove BOM if exists
//                 $str = preg_replace('/^\xEF\xBB\xBF/', '', $str); 
//                 // Lowercase and trim
//                 $str = trim(strtolower($str));
//                 // Convert spaces and hyphens to underscores to match mapping
//                 $str = str_replace([' ', '-'], '_', $str); 
//                 return $str;
//             };
    //             $headers = array_map($formatHeader, $headerRow);

    
//             $mapping = json_decode($sheet->column_mapping, true) ?? [];


    
//             $mappedIndices = [];
//             foreach ($mapping as $dbKey => $headerName) {
//                 if ($headerName !== null && $headerName !== '') {
//                     $index = array_search($formatHeader($headerName), $headers);
//                     if ($index !== false) {
//                         $mappedIndices[$dbKey] = $index;
//                     }
//                 }
//             }
    //             $lastSynced = $sheet->last_synced_row ?? 0;
//             $currentRowCount = count($rows);


    
//             if ($currentRowCount <= $lastSynced) {
//                 continue;
//             }
    //             $insert = [];
    //             for ($i = $lastSynced; $i < $currentRowCount; $i++) {
    //                 if (!isset($rows[$i])) continue;
    //                 $row = $rows[$i];
    //                 $data = [
//                     "client_name"   => isset($mappedIndices['client_name']) ? ($row[$mappedIndices['client_name']] ?? null) : ($row[0] ?? null),
//                     "client_mobile" => isset($mappedIndices['client_mobile']) ? ($row[$mappedIndices['client_mobile']] ?? null) : ($row[1] ?? null),
//                     "client_mobile2"=> isset($mappedIndices['client_mobile2']) ? ($row[$mappedIndices['client_mobile2']] ?? null) : null,
//                     "client_email"  => isset($mappedIndices['client_email']) ? ($row[$mappedIndices['client_email']] ?? null) : ($row[2] ?? null),
//                     "service_name"  => isset($mappedIndices['service_name']) ? ($row[$mappedIndices['service_name']] ?? null) : ($row[3] ?? null),
//                     "budget"        => isset($mappedIndices['budget']) ? ($row[$mappedIndices['budget']] ?? null) : null,
//                     "website"       => isset($mappedIndices['website']) ? ($row[$mappedIndices['website']] ?? null) : null,
//                     "location"      => isset($mappedIndices['location']) ? ($row[$mappedIndices['location']] ?? null) : null,
//                     "extra_1"       => isset($mappedIndices['extra_1']) ? ($row[$mappedIndices['extra_1']] ?? null) : null,
//                     "extra_2"       => isset($mappedIndices['extra_2']) ? ($row[$mappedIndices['extra_2']] ?? null) : null,
//                     "extra_3"       => isset($mappedIndices['extra_3']) ? ($row[$mappedIndices['extra_3']] ?? null) : null,
//                     "extra_4"       => isset($mappedIndices['extra_4']) ? ($row[$mappedIndices['extra_4']] ?? null) : null,
//                 ];


    
//                 if (!$data['client_name'] && !$data['client_mobile']) continue;
    //                 $insert[] = [
//                     "uploaded_excel_id" => $sheet->id,
//                     "excel_row_no"      => $i + 1,
//                     "client_name"       => $data['client_name'] ?? null,
//                     "client_mobile"     => $data['client_mobile'] ?? null,
//                     "client_email"      => $data['client_email'] ?? null,
//                     "raw_json"          => json_encode($data),
//                     "is_assigned"       => 0,
//                     "created_at"        => now(),
//                     "updated_at"        => now(),
//                 ];


    
//             }



    
//             if (!empty($insert)) {
    //                 $data=UploadedExcelRow::insert($insert);

    
//                 $sheet->update([
//                     "last_synced_row" => $currentRowCount,
//                     "total_rows"      => $currentRowCount,
//                 ]);
    //                 $totalImported += count($insert);
//             }
//         }
    //         return response()->json([
//             "status" => true,
//             "message" => "Sync Completed",
//             "imported_leads" => $totalImported
//         ]);
    //     } catch (\Throwable $e) {
    //         return response()->json([
//             "status" => false,
//             "error" => $e->getMessage()
//         ], 500);
//     }
// }

    public function sync(Request $request)    {
        try {
            $sheets = UploadedExcel::where("sheet_status", "live_sync")->get();

            $totalImported = 0;

            foreach ($sheets as $sheet) {
                if (!$sheet->sheet_url)
                    continue;

                // Extract Sheet ID
                preg_match("/\/d\/(.*?)\//", $sheet->sheet_url, $matches);
                if (!isset($matches[1]))
                    continue;

                $sheetId = $matches[1];

                // Extract GID (Specific Tab)
                preg_match('/gid=([0-9]+)/', $sheet->sheet_url, $gux);
                $gid = $gux[1] ?? 0;

                // Use CSV export with GID
                $url = "https://docs.google.com/spreadsheets/d/$sheetId/export?format=csv&gid=$gid";

                $csvData = Http::timeout(20)->get($url);

                if (!$csvData->successful())
                    continue;

                // Parse CSV properly
                $rows = array_map('str_getcsv', explode("\n", trim($csvData->body())));

                // Remove empty rows
                $rows = array_filter($rows, function ($row) {
                    return !empty(array_filter($row));
                });
                $rows = array_values($rows);

                if (count($rows) <= 2) {
                    \Log::warning("Not enough rows in CSV");
                    continue;
                }

                // The SECOND row contains the actual column headers
                $headerRow = $rows[0];

                // Data starts from the THIRD row (index 2)
                $dataRows = array_slice($rows, 1);

                \Log::info("Headers found: ", $headerRow);
                \Log::info("Total data rows: " . count($dataRows));

                // Get mapping from database
                $mapping = json_decode($sheet->column_mapping, true) ?? [];

                // Create mapping of database field to column index
                $mappedIndices = [];
                foreach ($mapping as $dbKey => $headerName) {
                    if ($headerName !== null && $headerName !== '') {
                        // Find exact header name in the sheet headers
                        $index = array_search($headerName, $headerRow);
                        if ($index !== false) {
                            $mappedIndices[$dbKey] = $index;
                            \Log::info("Mapped {$dbKey} to column '{$headerName}' at index {$index}");
                        }
                        else {
                            \Log::warning("Header '{$headerName}' not found in sheet");
                        }
                    }
                }

                $lastSynced = $sheet->last_synced_row ?? 0;
                $currentRowCount = count($dataRows);

                \Log::info("Last synced: {$lastSynced}, Current rows: {$currentRowCount}");

                if ($currentRowCount <= $lastSynced) {
                    continue;
                }

                $insert = [];

                for ($i = $lastSynced; $i < $currentRowCount; $i++) {
                    if (!isset($dataRows[$i]))
                        continue;

                    $row = $dataRows[$i];

                    // Debug first few rows
                    if ($i < 3) {
                        \Log::info("Data Row " . ($i + 1) . " sample:", array_slice($row, 0, 10));
                    }

                    // Check if row has any data
                    if (empty(array_filter($row))) {
                        \Log::info("Row " . ($i + 1) . " is empty, skipping");
                        continue;
                    }

                    // Build data array from mapped indices
                    $data = [
                        "client_name" => isset($mappedIndices['client_name']) ? ($row[$mappedIndices['client_name']] ?? null) : null,
                        "client_mobile" => isset($mappedIndices['client_mobile']) ? ($row[$mappedIndices['client_mobile']] ?? null) : null,
                        "client_mobile2" => isset($mappedIndices['client_mobile2']) ? ($row[$mappedIndices['client_mobile2']] ?? null) : null,
                        "client_email" => isset($mappedIndices['client_email']) ? ($row[$mappedIndices['client_email']] ?? null) : null,
                        "service_name" => isset($mappedIndices['service_name']) ? ($row[$mappedIndices['service_name']] ?? null) : null,
                        "budget" => isset($mappedIndices['budget']) ? ($row[$mappedIndices['budget']] ?? null) : null,
                        "website" => isset($mappedIndices['website']) ? ($row[$mappedIndices['website']] ?? null) : null,
                        "location" => isset($mappedIndices['location']) ? ($row[$mappedIndices['location']] ?? null) : null,
                        "extra_1" => isset($mappedIndices['extra_1']) ? ($row[$mappedIndices['extra_1']] ?? null) : null,
                        "extra_2" => isset($mappedIndices['extra_2']) ? ($row[$mappedIndices['extra_2']] ?? null) : null,
                        "extra_3" => isset($mappedIndices['extra_3']) ? ($row[$mappedIndices['extra_3']] ?? null) : null,
                        "extra_4" => isset($mappedIndices['extra_4']) ? ($row[$mappedIndices['extra_4']] ?? null) : null,
                    ];

                    // Debug first few rows data
                    if ($i < 3) {
                        \Log::info("Row " . ($i + 1) . " extracted data: ", $data);
                    }

                    // Skip if no client name or mobile
                    if (empty($data['client_name']) && empty($data['client_mobile'])) {
                        \Log::info("Skipping row " . ($i + 1) . " - no client name or mobile");
                        continue;
                    }

                    $insert[] = [
                        "uploaded_excel_id" => $sheet->id,
                        "excel_row_no" => $i + 1,
                        "raw_json" => json_encode($data),
                        "is_assigned" => 0,
                        "created_at" => now(),
                        "updated_at" => now(),
                    ];
                }

                if (!empty($insert)) {
                    UploadedExcelRow::insert($insert);

                    $sheet->update([
                        "last_synced_row" => $currentRowCount,
                        "total_rows" => $currentRowCount,
                    ]);

                    $totalImported += count($insert);
                    \Log::info("Imported " . count($insert) . " rows for sheet " . $sheet->id);
                }
            }

            return response()->json([
                "status" => true,
                "message" => "Sync Completed",
                "imported_leads" => $totalImported
            ]);

        }
        catch (\Throwable $e) {
            \Log::error("Sync error: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            return response()->json([
                "status" => false,
                "error" => $e->getMessage()
            ], 500);
        }    }

}
