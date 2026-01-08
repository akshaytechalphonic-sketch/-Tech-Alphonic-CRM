<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use App\Models\OfficeEmployees;
use App\Models\Meeting;

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
}
