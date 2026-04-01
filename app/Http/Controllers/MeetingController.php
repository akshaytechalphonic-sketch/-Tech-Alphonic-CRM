<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meeting;
use Illuminate\Support\Facades\Auth;
use App\Models\OfficeEmployees;
use Carbon\Carbon;
use App\Models\OfficeLeads;
use Illuminate\Support\Str;

class MeetingController extends Controller
{
    /**
     * Display a listing of the meetings.
     */
    public function index(Request $request)
    {
        $authEmployee = Auth::guard('office_employees')->user();

        $query = Meeting::with('creator', 'officelead')
            ->when($authEmployee->role_id == 3, function ($q) use ($authEmployee) {
                // Roles: 3 = Employee. Employees see only their own meetings.
                $q->where('created_by', $authEmployee->id);
            })
            ->when(in_array($authEmployee->role_id, [2, 4]), function ($q) use ($authEmployee) {
                // Roles: 2 = Team Lead, 4 = Manager (Assuming based on previous context).
                // They see their own and their subordinates' meetings.
                $subordinateIds = OfficeEmployees::where('manager_id', $authEmployee->id)->pluck('id')->toArray();
                $q->whereIn('created_by', array_merge([$authEmployee->id], $subordinateIds));
            })
            // Admin (role 1) sees all by default if no when logic matches.
            
            ->when($request->filled('employee'), function ($q) use ($request) {
                $q->where('created_by', $request->employee);
            })
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->when($request->filled('date'), function ($q) use ($request) {
                $q->where('date', $request->date);
            });

        $meetings = $query->orderByDesc('id')->get();

        // For filter dropdowns and create modal
        $leads = OfficeLeads::select('id', 'client_name')->get();
        $sales_emp = OfficeEmployees::whereHas('designation.department', function ($query) {
            $query->where('department_name', 'Sales');
        })->with(['designation', 'designation.department'])->get();

        return view('meetings.index', compact('meetings', 'sales_emp', 'leads'));
    }

    /**
     * Schedule a new meeting (Simple Link Generation).
     */
    public function scheduleMeeting(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'client_name' => 'nullable|exists:office_leads,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $employee = Auth::guard('office_employees')->user();

        Meeting::create([
            'title' => $request->title,
            'client_email' => $request->client_email,
            'client_name' => $request->client_name, // This is lead_id
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'meet_link' => $request->meet_link, // Nullable
            'created_by' => $employee->id,
            'description' => $request->description,
            'status' => 'scheduled',
            'remarks' => [],
        ]);

        return redirect()->route('office_employee.meetings.index')->with('success', 'Meeting link generated successfully.');
    }

    /**
     * View meeting details and remarks.
     */
    public function view($id)
    {
        $meeting = Meeting::with('creator', 'officelead')->findOrFail($id);
        return view('meetings.view', compact('meeting'));
    }

    /**
     * Update/Add remarks for the meeting.
     */
    public function updateRemarks(Request $request, $id)
    {
        $request->validate([
            'remark' => 'required|string',
        ]);

        $meeting = Meeting::findOrFail($id);
        $authEmployee = Auth::guard('office_employees')->user();

        $remarks = $meeting->remarks ?? [];
        $remarks[] = [
            'date' => date('Y-m-d H:i:s'),
            'by' => $authEmployee->name,
            'text' => $request->remark,
        ];

        $meeting->update(['remarks' => $remarks]);

        return back()->with('success', 'Remark added successfully.');
    }

    /**
     * Mark a meeting as completed.
     */
    public function completeMeeting($meetingId)
    {
        $meeting = Meeting::findOrFail($meetingId);
        $meeting->update(['status' => 'completed']);
        return back()->with('success', 'Meeting marked as completed successfully');
    }

    /**
     * Cancel a meeting.
     */
    public function cancelMeeting($meetingId)
    {
        $meeting = Meeting::findOrFail($meetingId);
        $meeting->update(['status' => 'cancelled']);

        return back()->with('success', 'Meeting cancelled successfully');
    }
}
