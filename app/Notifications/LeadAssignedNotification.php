<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class LeadAssignedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $type;
    protected $data;

    public function __construct(string $type, array $data)
    {
        $this->type = $type;
        $this->data = $data;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        if ($this->type === 'single') {
            return [
                'title'   => 'New Lead Assigned',
                'message' => 'A new lead has been assigned to you',
                'lead_id' => $this->data['lead_id'] ?? null,
            ];
        }

        return [
            'title'     => 'New Leads Assigned',
            'message'   => ($this->data['count'] ?? 0) . ' new leads assigned to you',
            'folder_id' => $this->data['folder_id'] ?? null,
            'job_id'    => $this->data['job_id'] ?? null,
        ];
    }
}
