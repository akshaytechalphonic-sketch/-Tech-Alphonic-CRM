<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class MeetingReminderMail extends Mailable
{
    public $employee, $followup;

    public function __construct($employee, $followup)
    {
        $this->employee = $employee;
        $this->followup = $followup;
    }

    public function build()
    {
        return $this->subject("Meeting Reminder")
                    ->view('email.meeting_reminder')
                    ->with([
                        'employee' => $this->employee,
                        'followup' => $this->followup,
                    ]);
    }
}
