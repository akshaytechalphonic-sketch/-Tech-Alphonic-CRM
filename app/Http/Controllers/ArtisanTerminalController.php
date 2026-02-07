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
            } catch (\Exception $e) {
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
        $now   = Carbon::now('Asia/Kolkata');
        $today = Carbon::today('Asia/Kolkata')->toDateString();

        $updatedCount = Meeting::where(function ($q) use ($now) {

            // Case 1: Date is before today
            $q->whereDate('date', '<', $now->toDateString())

                // Case 2: Same date but end_time is past
                ->orWhere(function ($q2) use ($now) {
                    $q2->whereDate('date', $now->toDateString())
                        ->whereTime('end_time', '<', $now->toTimeString());
                });
        })
            ->where('status', '!=', 'completed')
            ->update([
                'status'    => 'completed',
                'cron_date' => $today
            ]);

        return response()->json([
            'status'  => true,
            'message' => $updatedCount . ' past meetings marked as completed'
        ]);
    }

    public function sync(Request $request)
{
    try {

        $sheets = UploadedExcel::where("sheet_status", "live_sync")->get();
   
        $totalImported = 0;

        foreach ($sheets as $sheet) {

            if (!$sheet->sheet_url) continue;

            // Extract Sheet ID
            preg_match("/\/d\/(.*?)\//", $sheet->sheet_url, $matches);
            if (!isset($matches[1])) continue;

            $sheetId = $matches[1];
           

            // ✅ Use CSV export (NO CACHE ISSUE)
            $url = "https://docs.google.com/spreadsheets/d/$sheetId/export?format=csv";
           

            $csvData = Http::timeout(20)->get($url);
            

            if (!$csvData->successful()) continue;

            $rows = array_map('str_getcsv', explode("\n", $csvData->body()));

            if (count($rows) <= 1) continue;

            // Remove header row
            $header = array_shift($rows);

            $lastSynced = $sheet->last_synced_row ?? 0;
            $currentRowCount = count($rows);

            if ($currentRowCount <= $lastSynced) {
                continue;
            }

            $insert = [];

            for ($i = $lastSynced; $i < $currentRowCount; $i++) {

                if (!isset($rows[$i])) continue;

                $row = $rows[$i];

                $data = [
                    "client_name"   => $row[0] ?? null,
                    "client_mobile" => $row[1] ?? null,
                    "client_email"  => $row[2] ?? null,
                    "service_name"  => $row[3] ?? null,
                ];

                if (!$data['client_name'] && !$data['client_mobile']) continue;

                $insert[] = [
                    "uploaded_excel_id" => $sheet->id,
                    "excel_row_no"      => $i + 1,
                    "raw_json"          => json_encode($data),
                    "is_assigned"       => 0,
                    "created_at"        => now(),
                    "updated_at"        => now(),
                ];
            }

            if (!empty($insert)) {

                UploadedExcelRow::insert($insert);

                $sheet->update([
                    "last_synced_row" => $currentRowCount,
                    "total_rows"      => $currentRowCount,
                ]);

                $totalImported += count($insert);
            }
        }

        return response()->json([
            "status" => true,
            "message" => "Sync Completed",
            "imported_leads" => $totalImported
        ]);

    } catch (\Throwable $e) {

        return response()->json([
            "status" => false,
            "error" => $e->getMessage()
        ], 500);
    }
}

}
