<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfficeLeads;
use App\Models\OfficeLeadsFolders;
use App\Models\OfficeSaleTargets;
use App\Models\OfficeEmployees;
use App\Models\OfficeTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        $online = OfficeEmployees::where('is_online', 1)->count();
        $offline = OfficeEmployees::where('is_online', 0)->count();
        $active_emp = OfficeEmployees::where('status', '1')->count();
        $Inactive_emp = OfficeEmployees::where('status', '2')->count();


        $sales_emp = OfficeEmployees::whereHas('designation.department', function ($query) {
            $query->where('department_name', 'Sales');
        })->with(['designation', 'designation.department'])->get();
        $idd = isset($_GET['employee']) && $_GET['employee'] != '' ? $_GET['employee'] : 1;
        //   $idd = request('employee', optional($sales_emp->first())->id);

        $login_employee = OfficeEmployees::find($idd);
     


        if (isset($_GET['filter_by_month']) && $_GET['filter_by_month'] != '') {

            $month = strtolower(date('M', strtotime($_GET['filter_by_month'])));

            $year = date('Y', strtotime($_GET['filter_by_month']));
            // dd($month, $year);
            $monthlyTarget = OfficeSaleTargets::where('emp_id', $login_employee->id ?? '')->where('year', $year)->whereNotNull($month)->first();
        } else {
            $monthlyTarget = OfficeSaleTargets::where('emp_id', $login_employee->id ?? '')->where('year', date('Y'))->whereNotNull(strtolower(date('M')))->first();
        }
        $leads = OfficeLeads::where('trash', false)->where('emp_id', $login_employee->id ?? '')->where('assign_date', date('Y-m-d'))->get();
        $all_leads = OfficeLeads::where('trash', false)->where('emp_id', $login_employee->id ?? '')->get();
        // $officeLeadsFolders = OfficeLeadsFolders::where()-all();
        // dd($officeLeadsFolders);
        $month = strtolower(date('M'));
        $monthlyTarget = $monthlyTarget != null ? json_decode($monthlyTarget->$month, true) : null;


        // ================= TASK REPORT ======================
        $taskQuery = OfficeTask::where('assigned_to', $idd);

        // Employee-wise counts
        $total_tasks     = OfficeTask::where('assigned_to', $idd)->count();
        $completed_tasks = OfficeTask::where('assigned_to', $idd)->where('status', 'completed')->count();
        $in_progress     = OfficeTask::where('assigned_to', $idd)->where('status', 'in_progress')->count();
        $pending_tasks   = OfficeTask::where('assigned_to', $idd)->whereIn('status', ['todo', 'review'])->count();


        // Format data for Chart.js
        $taskChart = [
            'labels' => ['Completed', 'In Progress', 'Pending'],
            'data'   => [$completed_tasks, $in_progress, $pending_tasks],
        ];

        return view('admin.dashboard.index', compact('leads', 'login_employee', 'monthlyTarget', 'all_leads', 'sales_emp', 'total_tasks', 'completed_tasks', 'in_progress', 'pending_tasks', 'taskChart', 'active_emp', 'Inactive_emp','online','offline'));
        
    }
}
