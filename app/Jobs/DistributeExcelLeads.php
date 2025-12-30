<?php

namespace App\Jobs;

use App\Mail\MeetingReminderMail;
use App\Models\OfficeLeadFollowups;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class DistributeExcelLeads  implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $now = Carbon::now();
        $reminderTime = $now->copy()->addMinutes(30); // 30 min baad ke followups nikalna
        $followups = OfficeLeadFollowups::with('employee')
            ->where('date', date('Y-m-d'))
            ->where('time', '>', $now->toTimeString())
            ->where('time', '<', $reminderTime->toTimeString())
            ->where('active', 1)
            ->where('notification_count', '<', 3)
            ->get();
        foreach ($followups as $followup) {
            $employee = $followup->employee;
            if ($employee) {
                OfficeLeadFollowups::where('id', $followup->id)
                ->update(['notification_count' => ($followup->notification_count + 1)]);
                
                Mail::to($employee->email)->send(new MeetingReminderMail($employee, $followup));
                // SmsService::sendSms($employee->phone, "Reminder: Your meeting is at {$followup->time} about {$followup->content}");
            }
        }
    }
}
