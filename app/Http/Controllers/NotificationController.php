<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Mail\MeetingReminderMail;
use App\Models\OfficeLeadFollowups;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

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


    // public function read($id)
    // {
    //     $employee = Auth::guard('office_employees')->user();

    //     $notification = $employee->notifications()->where('id', $id)->first();

    //     if ($notification) {
    //         $notification->markAsRead();
    //     }

    //     return redirect()->route(
    //         'office_employee.leads.single_lead',
    //         $notification->data['lead_id'] ?? null
    //     );
    // }


    public function readAll()
    {
        $employee = Auth::guard('office_employees')->user();

        // ✅ Mark all unread notifications as read
        $employee->unreadNotifications->markAsRead();

        return redirect()->back()->with('success', 'All notifications marked as read');
    }

}
