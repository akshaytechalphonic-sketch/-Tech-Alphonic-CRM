<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use App\Models\OfficeEmployees;

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

    //  public function offlineAll(Request $request)
    //     {
    //         $now = Carbon::now('Asia/Kolkata');

    //         // Allow only between 12:00 AM to 12:05 AM
    //         if (!($now->format('H:i') >= '00:00' && $now->format('H:i') <= '00:05')) {
    //     //    if (!($now->format('H:i') >= '16:51' && $now->format('H:i') <= '17:00')) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'This API can only run between 4:51 PM and 5:00 PM'
    //         ], 403);
    //     }
    //         OfficeEmployees::where('is_online', 1)
    //             ->update(['is_online' => 0]);

    //         return response()->json([
    //             'status' => true,
    //             'message' => 'All employees marked offline'
    //         ]);
    //     }


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
}
