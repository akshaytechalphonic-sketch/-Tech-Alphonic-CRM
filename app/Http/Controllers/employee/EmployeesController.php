<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Models\OfficeEmployees;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class EmployeesController extends Controller
{

    public function index()
    {
        $login_employee = Auth::guard('office_employees')->user();

        // ADMIN → See all employees
        if ($login_employee->role_id == 1) {

            $office_employees = OfficeEmployees::with(['designation.department'])
                ->active()
                ->get();
        }
        // MANAGER → See department employees
        elseif ($login_employee->role_id == 2) {

            $deptId = $login_employee->designation->department_id;

            $office_employees = OfficeEmployees::with(['designation.department'])
                ->whereHas('designation', function ($q) use ($deptId) {
                    $q->where('department_id', $deptId);
                })
                ->active()
                ->get();
        }
        // TEAM LEAD → See own team
        elseif ($login_employee->role_id == 4) {

            $office_employees = OfficeEmployees::with(['designation.department'])
                ->where('manager_id', $login_employee->id)
                ->active()
                ->get();
        }
        // EMPLOYEE → See only self
        elseif ($login_employee->role_id == 3) {

            $office_employees = OfficeEmployees::with(['designation.department'])
                ->where('id', $login_employee->id)
                ->get();
        } else {
            abort(403, 'You are not authorized.');
        }

        return view('office.employees',compact('office_employees')

        );
    }

   
}
