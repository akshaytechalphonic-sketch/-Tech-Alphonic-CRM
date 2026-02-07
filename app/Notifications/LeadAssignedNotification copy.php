<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class LeadAssignedNotification extends Notification
{
    use Queueable;

    public $lead;

    public function __construct($lead)
    {
        $this->lead = $lead;
    }

    
    public function via($notifiable)
    {
        return ['database']; 
    }

    
    public function toDatabase($notifiable)
    {
        return [
            'title' => 'New Lead Assigned',
            'message' => 'A new lead has been assigned to you',
            'lead_id' => $this->lead->id,
            
        ];
    }


}

// namespace App\Notification;

// use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Notifications\Notification;

// class LeadAssignedNotification extends Notification implements ShouldQueue
// {
//     use Queueable;

//     protected $type; // single | bulk
//     protected $data;

//     /**
//      * @param string $type  single | bulk
//      * @param array  $data
//      */
//     public function __construct(string $type, array $data)
//     {
//         $this->type = $type;
//         $this->data = $data;
//     }

//     public function via($notifiable)
//     {
//         return ['database'];
//     }

//     public function toDatabase($notifiable)
//     {
//         // ✅ SINGLE LEAD
//         if ($this->type === 'single') {
//             return [
//                 'title'   => 'New Lead Assigned',
//                 'message' => 'A new lead has been assigned to you',
//                 'lead_id' => $this->data['lead_id'],
//             ];
//         }

//         // ✅ BULK LEADS
//         return [
//             'title'     => 'New Leads Assigned',
//             'message'   => $this->data['count'] . ' new leads assigned to you',
//             'folder_id' => $this->data['folder_id'],
//             'job_id'    => $this->data['job_id'],
//         ];
//     }
// }

