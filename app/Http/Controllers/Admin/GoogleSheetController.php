<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UploadedExcel;
use App\Services\GoogleSheetService;


class GoogleSheetController  extends Controller
{

        public function fetchColumns(Request $request, GoogleSheetService $service)
        {
            $request->validate([
                "sheet_url" => "required"
            ]);

            try {

                $result = $service->fetchSheetWithHeaders($request->sheet_url);

                return response()->json([
                    "status"  => true,
                    "headers" => $result["headers"],
                     "sheet_name" => $result["sheet_name"]
                ]);

            } catch (\Throwable $e) {

                return response()->json([
                    "status"  => false,
                    "message" => $e->getMessage()
                ]);
            }
        }

        // ✅ Save Sheet + Mapping
     public function connect(Request $request, GoogleSheetService $service)
        {
            
            $request->validate([
                "sheet_url" => "required",
                "folder_id" => "required",
                "mapping"   => "required|array"
            ]);

            $result = $service->fetchSheetWithHeaders($request->sheet_url);
            UploadedExcel::create([
                "file_name"         => uniqid() . "_google_sheet",
                "original_name"     => $result["sheet_name"],
                "sheet_url"         => $request->sheet_url,
                "default_folder_id" => $request->folder_id,
                "column_mapping"    => json_encode($request->mapping),
                "source_type"       => "google_sheet",
                "sheet_status"      => "live_sync",
                "last_synced_row"   => 0,
                "uploaded_by"       => auth()->id(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return back()->with("success", "Google Sheet Live Sync Connected Successfully!");
        }


}
