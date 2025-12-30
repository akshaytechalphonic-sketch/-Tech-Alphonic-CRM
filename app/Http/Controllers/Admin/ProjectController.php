<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfficeTask;
use App\Models\OfficeEmployees;
use App\Models\OfficeDesignations;
use App\Models\OfficeTeams;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::with(['department', 'manager'])->latest()->get();
        $managers = OfficeEmployees::get();


        return view('admin.office.project_management', compact('projects', 'managers'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'project_name' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            // 'project_manager_id' => 'required|integer',
            // 'team_id' => 'required|integer',
            'start_date' => 'nullable|date',
            'deadline' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        Project::create($request->all());

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully.');
    }


    public function update(Request $request, $id)
    {
        // Find project by ID
        $project = Project::findOrFail($id);

        // Validate incoming data
        $validatedData = $request->validate([
            'project_name' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'project_manager_id' => 'nullable|integer',
            'deadline' => 'required|date',
            'description' => 'required|string',
        ]);

        // Update project fields (must match DB columns)
        $project->project_name = $validatedData['project_name'];
        $project->client_name = $validatedData['client_name'];
        $project->project_manager_id = $validatedData['project_manager_id'];
        $project->start_date = $validatedData['start_date'];
        $project->deadline = $validatedData['deadline'];
        $project->description = $validatedData['description'];

        // Save the project
        $project->save();

        // Redirect back with success message
        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully.');
    }



    // public function detail(Request $request, $id)
    // {
    //     $data['clientDetail'] = Project::where('id', $id)->first();

    //     // Task should be fetched using project_id, not id
    //     $data['task'] = OfficeTask::where('project_id', $id)->get();

    //     return view('admin.office.poject-management-view', compact('data'));
    // }

    public function detail(Request $request, $id)
    {
        $project = Project::with('tasks','manager')->findOrFail($id);

        $totalTasks = $project->tasks->count();
        $completedTasks = $project->tasks->where('status', 'completed')->count();

        // Calculate Total Hours
        $totalHours = 0;

        foreach ($project->tasks as $task) {

            if ($task->review_at) {
                $review = \Carbon\Carbon::parse($task->review_at);

                $end = $task->completed_at
                    ? \Carbon\Carbon::parse($task->completed_at)
                    : \Carbon\Carbon::now();

                if ($end >= $review) {
                    $diff = $review->diff($end);
                    $totalHours += ($diff->days * 24) + $diff->h + ($diff->i / 60);
                }
            }
        }

        $start = Carbon::parse($project->start_date);
        $end   = Carbon::parse($project->deadline);

        if ($project->start_date && $project->deadline) {

            // Total seconds difference
            $diffInSeconds = $start->diffInSeconds($end);

            // Convert to days, hours, minutes
            $days = floor($diffInSeconds / 86400);
            $hours = floor(($diffInSeconds % 86400) / 3600);
            $minutes = floor(($diffInSeconds % 3600) / 60);

            // For display
            $estimateDuration = "{$days}d {$hours}h {$minutes}m";

            $estimatedHours = $start->diffInHours($end);
        } else {

            $estimateDuration = "N/A";
            $estimatedHours = 0;
        }

        $remainingHours = max($estimatedHours - $totalHours, 0);
        $progress = $estimatedHours > 0 ? ($totalHours / $estimatedHours) * 100 : 0;

        $data = [
            'project' => $project,
            'totalTasks' => $totalTasks,
            'completedTasks' => $completedTasks,
            'totalHours' => $estimateDuration,
            'remainingHours' => round($remainingHours, 2),
            'progress' => round($progress),
            'estimatedHours' => $estimatedHours,
        ];

        return view('admin.office.poject-management-view', compact('data'));
    }




    public function delete(Request $request)
    {
        // Validate request
        $request->validate([
            'project_id' => 'required|exists:projects,id',
        ]);

        // Find & delete
        $project = Project::findOrFail($request->input('project_id'));
        $project->delete();

        // Redirect with success message
        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }

  public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required',
    ]);

    // Find Project
    $project = Project::findOrFail($id);
    $project->status = $request->status;
    $project->save();

    return back()->with('success', 'Project status updated successfully!');
}

}
