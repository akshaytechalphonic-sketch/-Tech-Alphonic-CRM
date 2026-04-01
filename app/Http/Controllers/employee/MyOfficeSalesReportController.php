<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Models\OfficeEmployees;
use App\Models\OfficeLeads;
use App\Models\OfficeLeadsFolders;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class MyOfficeSalesReportController extends Controller
{
    public function index(Request $request)
    {
        $login_employee = Auth::guard('office_employees')->user();

        // Only Admin (1), Manager (2) and Team Lead (4) should access
        if (!in_array($login_employee->role_id, [1, 2, 4])) {
            abort(403, 'You are not authorized to view the Sales Report.');
        }

        $leads_query = OfficeLeads::where('trash', false)
            ->with(['employee'])
            ->orderBy('id', 'DESC');

        $sales_emp = collect();

        // ADMIN (1) → ALL LEADS
        if ($login_employee->role_id == 1) {
            $sales_emp = OfficeEmployees::with('role')
                ->whereHas('designation.department', function ($q) {
                    $q->where('department_name', 'Sales');
                })->get();

        // MANAGER (2) → THEIR TEAM LEADS, AND JUNIORS UNDER THOSE TEAM LEADS
        } elseif ($login_employee->role_id == 2) {
            $teamLeadIds = OfficeEmployees::where('manager_id', $login_employee->id)->pluck('id');
            $leads_query->where(function ($q) use ($login_employee, $teamLeadIds) {
                $q->where('emp_id', $login_employee->id)
                  ->orWhereIn('emp_id', $teamLeadIds)
                  ->orWhereHas('employee', function ($qq) use ($teamLeadIds) {
                      $qq->whereIn('manager_id', $teamLeadIds);
                  });
            });

            $sales_emp = OfficeEmployees::with('role')
                ->where(function ($q) use ($login_employee, $teamLeadIds) {
                    $q->where('manager_id', $login_employee->id)
                      ->orWhereIn('manager_id', $teamLeadIds);
                })
                ->whereHas('designation.department', function ($q) {
                    $q->where('department_name', 'Sales');
                })
                ->get();

        // TEAM LEAD (4) → OWN + JUNIORS
        } elseif ($login_employee->role_id == 4) {
            $leads_query->where(function ($q) use ($login_employee) {
                $q->where('emp_id', $login_employee->id)
                    ->orWhereHas('employee', function ($qq) use ($login_employee) {
                        $qq->where('manager_id', $login_employee->id);
                    });
            });

            $sales_emp = OfficeEmployees::with('role')
                ->where('manager_id', $login_employee->id)
                ->whereHas('designation.department', function ($q) {
                    $q->where('department_name', 'Sales');
                })
                ->get();
        }

        // Apply Filters
        if ($request->filled('employee_id')) {
            $leads_query->where('emp_id', $request->employee_id);
        }
        if ($request->filled('status')) {
            $leads_query->where('status', $request->status);
        }
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $leads_query->whereBetween('assign_date', [$request->from_date, $request->to_date]);
        } elseif ($request->filled('from_date')) {
            $leads_query->whereDate('assign_date', '>=', $request->from_date);
        } elseif ($request->filled('to_date')) {
            $leads_query->whereDate('assign_date', '<=', $request->to_date);
        }

        $leads = $leads_query->get();
         $statusCounts = $this->getStatusCounts($leads);
        return view('office.reports.sales_report', compact('leads', 'sales_emp', 'login_employee'));
    }

    private function getStatusCounts($leads)
{
    $statuses = [
        'open' => 'primary',
        'converted' => 'success',
        'hot' => 'danger',
        'warm' => 'warning',
        'connected' => 'info',
        'fake' => 'secondary',
        'not connected' => 'dark',
        'cold' => 'light',
        'future' => 'purple',
        'follow up' => 'pink',
        'loss' => 'orange',
        'not intrested' => 'teal'
    ];
    
    $statusCounts = [];
    foreach ($statuses as $status => $color) {
        $statusCounts[$status] = [
            'count' => $leads->where('status', $status)->count(),
            'color' => $color
        ];
    }
    
    return $statusCounts;
}
}
