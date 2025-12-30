<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Mail\MeetingReminderMail;
use App\Models\OfficeLeadFollowups;
use Illuminate\Support\Facades\Mail;

class NotificationController extends Controller
{
    public function cronjob_notification()
    {
        // die;
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
                OfficeLeadFollowups::where('id', $followup->id)->update(['notification_count' => ($followup->notification_count + 1)]);
                Mail::to($employee->email)->send(new MeetingReminderMail($employee, $followup));
            }
        }
    }
}
