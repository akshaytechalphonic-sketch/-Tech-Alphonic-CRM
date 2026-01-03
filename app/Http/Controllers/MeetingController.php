<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client;
use Google\Service\Calendar;
use App\Models\Meeting;
use Google\Service\Calendar\Event;
use Illuminate\Support\Facades\Auth;
use App\Models\OfficeEmployees;
use Carbon\Carbon;
use App\Models\OfficeLeads;

class MeetingController extends Controller
{

    public function index(Request $request)
    {
        $employee = auth('office_employees')->user();
        $query = Meeting::with('employee', 'officelead')
            ->where(function ($q) use ($employee) {
                $q->where('created_by', $employee->id)
                    ->orWhere('senior_id', $employee->id);
            })
            ->orderBy('date', 'desc');

        if ($request->from_date) {
            $query->whereDate('date', '>=', $request->from_date);
        }

        if ($request->to_date) {
            $query->whereDate('date', '<=', $request->to_date);
        }

        if ($request->status) {
            if ($request->status == 'completed') {
                $query->whereRaw("CONCAT(date,' ',end_time) < NOW()");
            } else {
                $query->whereRaw("CONCAT(date,' ',end_time) >= NOW()");
            }
        }

        $meetings = $query->get();


        return view('meetings.index', compact('meetings'));
    }


    public function scheduleMeeting(Request $request)
    {


        $exists = Meeting::where('senior_id', $request->senior_id)
            ->where('date', $request->date)
            ->where(function ($q) use ($request) {
                $q->where('start_time', '<', $request->end_time)
                    ->where('end_time', '>', $request->start_time);
            })->exists();

        if ($exists) {

            return redirect('/office-employee/leads')->with('error', 'This time is already booked');
        }

        $client_email = $request->filled('client_email') ? $request->client_email : null;

        $senior_email = OfficeEmployees::where('id', $request->senior_id)->value('email');

        if (!$senior_email) {

            return redirect('/office-employee/leads')->with('error', 'Senior email not found');
        }

        // 2️⃣ Google Client
        $employee = auth('office_employees')->user();
        // dd($employee);
        if (!$employee || !$employee->google_token) {


            return redirect('/office-employee/leads')->with('error', 'Google account not connected');
        }

        $client = new Client();

        // dd(json_decode($employee->google_token, true));
        $client->setAccessToken(json_decode($employee->google_token, true));
        $client->setApplicationName('CRM Google Meet Scheduler');

        // if ($client->isAccessTokenExpired()) {

        //     $client->fetchAccessTokenWithRefreshToken(
        //         $client->getRefreshToken()
        //     );

        //     $employee->update([
        //         'google_token' => json_encode($client->getAccessToken())
        //     ]);
        // }


        if ($client->isAccessTokenExpired()) {

            if ($client->getRefreshToken()) {

                $newToken = $client->fetchAccessTokenWithRefreshToken(
                    $client->getRefreshToken()
                );

                $employee->update([
                    'google_token' => json_encode(array_merge(
                        json_decode($employee->google_token, true),
                        $newToken
                    ))
                ]);

                $client->setAccessToken($employee->google_token);
            } else {
                return redirect('/office-employee/leads')
                    ->with('error', 'Google account reconnect required');
            }
        }


        $service = new Calendar($client);

        $startDateTime = Carbon::createFromFormat(
            'Y-m-d H:i',
            $request->date . ' ' . $request->start_time,
            'Asia/Kolkata'
        )->setTimezone('UTC');

        $endDateTime = Carbon::createFromFormat(
            'Y-m-d H:i',
            $request->date . ' ' . $request->end_time,
            'Asia/Kolkata'
        )->setTimezone('UTC');

        $attendees = [
            ['email' => $senior_email], // senior always invited
        ];

        if ($client_email) {
            $attendees[] = ['email' => $client_email]; // only if provided
        }

        // 3️⃣ Event Data
        $event = new Event([
            'summary' => $request->title,
            'description' => $request->description,
            'organizer' => [
                'email' => $employee->email,
                'displayName' => $employee->name,
            ],
            'start' => [
                'dateTime' => $startDateTime->toRfc3339String(),
                'timeZone' => 'UTC',
            ],
            'end' => [
                'dateTime' => $endDateTime->toRfc3339String(),
                'timeZone' => 'UTC',
            ],
            'conferenceData' => [
                'createRequest' => [
                    'requestId' => uniqid(),
                    'conferenceSolutionKey' => [
                        'type' => 'hangoutsMeet',
                    ],
                ],
            ],
            'attendees' => $attendees,

        ]);


        // 5️⃣ Create Google Meet
        try {
            $event = $service->events->insert(
                'primary',
                $event,
                [
                    'conferenceDataVersion' => 1,
                    'sendUpdates' => 'all',
                ]
            );
        } catch (\Google\Service\Exception $e) {
            return response()->json([
                'status' => false,
                'google_error' => $e->getErrors()
            ]);
        }

        // 5️⃣ Save in DB
        Meeting::create([
            'title' => $request->title,
            'client_email' => $client_email,
            'client_name' => $request->client_name,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'meet_link' => $event->getHangoutLink(),
            'senior_id' => $request->senior_id,
            'created_by' => $employee->id,
            'description' => $request->description ?? null
        ]);

        return redirect('/office-employee/leads')->with('success', 'Meeting scheduled successfully')
            ->with('meet_link', $event->getHangoutLink());
    }
}
