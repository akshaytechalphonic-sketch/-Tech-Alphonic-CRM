<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Models\OfficeLeads;
use App\Models\OfficeLeadsFolders;
use App\Models\OfficeSaleTargets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfficeDashboardController extends Controller
{
    public function index()
    {
        // dd('kd');
        $login_employee = Auth::guard('office_employees')->user();
        if(isset($_GET['filter_by_month']) && $_GET['filter_by_month'] != ''){
            $month = strtolower(date('M', strtotime($_GET['filter_by_month'])));
            $year = date('Y', strtotime($_GET['filter_by_month']));
            // dd($month, $year);
            $monthlyTarget = OfficeSaleTargets::where('emp_id', $login_employee->id)->where('year', $year)->whereNotNull($month)->first();
        }else{
            $monthlyTarget = OfficeSaleTargets::where('emp_id', $login_employee->id)->where('year', date('Y'))->whereNotNull(strtolower(date('M')))->first();
        }
        $leads = OfficeLeads::where('trash', false)->where('emp_id', $login_employee->id)->where('assign_date', date('Y-m-d'))->get();
        $all_leads = OfficeLeads::where('trash', false)->where('emp_id', $login_employee->id)->get();
        // $officeLeadsFolders = OfficeLeadsFolders::where()-all();
        // dd($officeLeadsFolders);
        $month = strtolower(date('M'));
        $monthlyTarget = $monthlyTarget != null ? json_decode($monthlyTarget->$month, true) : null;
        return view('office.dashboard.index',compact('leads','login_employee','monthlyTarget','all_leads'));
    }
}
