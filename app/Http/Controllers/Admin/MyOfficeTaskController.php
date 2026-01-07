<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfficeDepartments;
use App\Models\OfficeEmployees;
use App\Models\OfficeDesignations;
use App\Models\OfficeTeams;
use App\Models\OfficeTask;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class MyOfficeTaskController extends Controller
{

    // public function index(Request $request)
    // {
    //     $tasks = OfficeTask::with(['department', 'assignee', 'reporter']);

    //     if ($request->department) {
    //         $tasks->where('department_id', $request->department);
    //     }

    //     if ($request->employee) {
    //         $tasks->where('assigned_to', $request->employee);
    //     }

    //     if ($request->status) {
    //         $tasks->where('status', $request->status);
    //     }

    //     $tasks = $tasks->get();

    //     $department = OfficeDepartments::active()->get();
    //     $employee = OfficeEmployees::active()->get();
    //     $projects = Project::get();

    //     return view('admin.office.task-management', compact('department', 'employee', 'tasks', 'projects'));
    // }


    public function index(Request $request)
    {
        // Base query
        $tasks = OfficeTask::with(['department', 'assignee', 'reporter']);


        if (auth('admin')->check()) {

            // Filters for Admin
            if ($request->department) {
                $tasks->where('department_id', $request->department);
            }

            if ($request->employee) {
                $tasks->where('assigned_to', $request->employee);
            }

            if ($request->status) {
                $tasks->where('status', $request->status);
            }

            $tasks = $tasks->latest()->get();

            // Admin filter dropdown data
            $department = OfficeDepartments::active()->get();
            $employee   = OfficeEmployees::active()->get();
            $projects   = Project::get();

            return view('admin.office.task-management', compact(
                'department',
                'employee',
                'tasks',
                'projects'
            ));
        }

        /**
         * ============================
         * OFFICE EMPLOYEE SECTION
         * ============================
         */
        if (auth('office_employees')->check()) {

            // Employee can only see their tasks
            $tasks->where('assigned_to', auth('office_employees')->id());

            // Employee can filter only status
            if ($request->status) {
                $tasks->where('status', $request->status);
            }

            $tasks = $tasks->latest()->get();
            $department = OfficeDepartments::active()->get();
            $projects   = Project::get();
            $employee   = OfficeEmployees::active()->get();


            return view('office.task-management.index', compact(
                'tasks',
                'employee',
                'department',
                'projects'
            ));
        }

        // If not logged in anywhere
        abort(403, 'Unauthorized');
    }


    public function departmentEmployee($departmentId)
    {
        return OfficeEmployees::whereHas('designation', function ($q) use ($departmentId) {
            $q->where('department_id', $departmentId);
        })
            ->with(['designation.department'])
            ->get()
            ->map(function ($emp) {
                return [
                    'id'               => $emp->id,
                    'name'             => $emp->name,
                    'email'            => $emp->email,
                    'designation_id'   => $emp->designation_id,
                    'designation_name' => $emp->designation->designation_name ?? null,
                    'department_name'  => $emp->designation->department->department_name ?? null,
                    'is_sales'         => ($emp->designation->department->department_name ?? '') === 'Sales' ? 1 : 0,
                ];
            });
    }




    public function store(Request $request)
    {

        $request->validate([
            'project_id' => 'required',
            'title' => 'required|string|max:255',
            'department_id' => 'required|exists:office_departments,id',
            'assigned_to' => 'required|exists:office_employees,id',
            'reporting_head' => 'required|exists:office_employees,id',
            'estimate' => 'nullable|date_format:Y-m-d\TH:i',
            'description' => 'required|string',
        ]);

        // Create task

        $task = OfficeTask::create([
            'department_id'   => $request->department_id,
            'project_id'        =>  $request->project_id,
            'role_id'         => $request->role_id,
            'assign_by'       => $request->assign_by ?? auth()->id(),
            'assigned_to'     => $request->assigned_to,
            'reporting_head'  => $request->reporting_head,
            'task_type'       => $request->task_type,
            'estimate'            => $request->estimate,
            'title'           => $request->title,
            'description'     => $request->description,
            'remark'          => $request->remark,
            'status'          => 'todo',
        ]);


        return redirect()->back()->with('success', 'Task created successfully!');
    }

    public function update(Request $request, $id)
    {

        // Find the task by ID
        $task = OfficeTask::findOrFail($id);

        // Validate incoming data
        $validatedData = $request->validate([
            'project_id' => 'required',
            'title' => 'required|string|max:255',
            'department_id' => 'required|exists:office_departments,id',
            'assigned_to' => 'required|exists:office_employees,id',
            'reporting_head' => 'required|exists:office_employees,id',
            'estimate' => 'nullable|date_format:Y-m-d\TH:i',
            'description' => 'required|string',
            // Add more validation rules as needed
        ]);

        // Update task fields
        $task->project_id = $validatedData['project_id'];
        $task->title = $validatedData['title'];
        $task->department_id = $validatedData['department_id'];
        $task->assigned_to = $validatedData['assigned_to'];
        $task->reporting_head = $validatedData['reporting_head'];
        $task->estimate = $validatedData['estimate'];
        $task->description = $validatedData['description'];
        // Update other fields if necessary

        // Save the task
        $task->save();
        if (auth('admin')->check()) {

            return redirect()->route('admin.task_management.index')->with('success', 'Task updated successfully.');
        }
        // Redirect back with success message
        if (auth('office_employees')->check()) {

            return redirect()->route('office_employee.task_management.index')->with('success', 'Task updated successfully.');
        }
    }

    public function view($id)
    {
        $task = OfficeTask::with(['project', 'department', 'assignee', 'reporter'])
            ->findOrFail($id);

        // If admin is logged in → show admin view
        if (auth('admin')->check()) {

            return view('admin.office.task-management-view', compact('task'));
        }

        // If office employee logged in → show employee view
        if (auth('office_employees')->check()) {

            // Security: employee should view ONLY their assigned tasks
            if ($task->assigned_to != auth('office_employees')->id()) {
                abort(403, 'Unauthorized');
            }

            return view('office.task-management.view', compact('task'));
        }

        abort(403, 'Unauthorized');
    }


    public function delete(Request $request)
    {

        // Validate the request
        $request->validate([
            'task_id' => 'required|exists:tasks,id', // adjust table/model names as needed
        ]);

        // Find and delete the task
        $task = OfficeTask::findOrFail($request->input('task_id'));
        $task->delete();

        // Redirect back with success message
        if (auth('admin')->check()) {
            return redirect()->route('admin.task_management.index')->with('success', 'Task deleted successfully.');
        }

        if (auth('office_employees')->check()) {
            return redirect()->route('office_employee.task_management.index')->with('success', 'Task deleted successfully.');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'status' => 'required',
        ]);

        $task = OfficeTask::findOrFail($id);
        $task->status = $request->status;
        if ($request->status == 'review') {
            $task->review_at = now();
        }

        if ($request->status == 'completed') {
            $task->completed_at = now();
        }

        $task->save();

        return back()->with('success', 'Task status updated successfully!');
    }
}
