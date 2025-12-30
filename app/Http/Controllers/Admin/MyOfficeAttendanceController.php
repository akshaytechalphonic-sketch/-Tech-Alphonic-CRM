<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfficeAttendances;
use App\Models\OfficeDepartments;
use App\Models\OfficeEmployees;
use App\Models\OfficeDesignations;
use App\Models\OfficeLeaves;
use App\Models\OfficeSecAttendances;
use App\Models\OfficeTeams;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class MyOfficeAttendanceController extends Controller
{
    public function index()
    {
        $today_attendance = OfficeAttendances::with(['employee.designation'])->where('day', date('d'))->where('month', date('m'))->where('year', date('Y'))->get();
        if (isset($_GET['filter_by_date'])) {
            $day = date('d', strtotime($_GET['filter_by_date']));
            $month = date('m', strtotime($_GET['filter_by_date']));
            $year = date('Y', strtotime($_GET['filter_by_date']));
            $today_attendance = OfficeAttendances::with(['employee.designation'])->where('day', $day)->where('month', $month)->where('year', $year)->get();
        }
        if (isset($_GET['filter_by_employee']) && $_GET['filter_by_employee'] != '') {
            $today_attendance = OfficeAttendances::with(['employee.designation'])->where('emp_id', $_GET['filter_by_employee'])->get();
        }
        if (isset($_GET['filder_by_month']) && $_GET['filder_by_month'] != '') {
            $month = date('m', strtotime($_GET['filder_by_month']));
            $year = date('Y', strtotime($_GET['filder_by_month']));
            $today_attendance = OfficeAttendances::with(['employee.designation'])->where('month', $month)->where('year', $year)->get();
        }
        if (isset($_GET['filder_by_month']) && $_GET['filder_by_month'] != '' && isset($_GET['filter_by_employee']) && $_GET['filter_by_employee'] != '') {
            $today_attendance = OfficeAttendances::with(['employee.designation'])->where('month', $month)->where('year', $year)->where('emp_id', $_GET['filter_by_employee'])->get();
        }
        $attendance = OfficeAttendances::with(['employee.designation'])->get();
        $employees = OfficeEmployees::with('designation')->where('status', '1')->orderBy('name', 'ASC')->get();
        $leaves = OfficeLeaves::with(['employee.designation', 'approved_by'])->get();
        // dd($leaves);
        return view('admin.office.attendence', compact('attendance', 'employees', 'leaves', 'today_attendance'));
    }

    public function create_attendance(Request $request)
    {
        $create = new OfficeAttendances;
        $create->emp_id = $request->emp_id;
        $create->day = date('d', strtotime($request->date));
        $create->month = date('m', strtotime($request->date));
        $create->year = date('Y', strtotime($request->date));
        $create->check_in = $request->check_in;
        $create->check_out = $request->check_out;
        $create->work_type = $request->work_type;
        $create->save();
        return redirect('admin/office-attendance?type=attendance')->with('success', 'Attendance Added Successfully!');
    }

    public function create_leave(Request $request)
    {
        $create = new OfficeLeaves;
        $create->leave_type = $request->leave_type;
        $create->half_leave = $request->day_type;
        $create->leave_reason = $request->input('reason');
        $create->leave_to = $request->to;
        $create->leave_from = $request->from;
        $create->emp_id = $request->emp_id;
        // $create->request_id = $request->request_id;
        $create->status = $request->status;
        $create->save();
        return redirect('admin/office-attendance?type=leaves')->with('success', 'Leave Added Successfully!');
    }

    public function change_leave_status(Request $request)
    {
        $status = OfficeLeaves::find($request->leave_id);
        $status->status = $request->status;
        $status->update();
        return "Status Updated Successfully!";
    }

    public function assign_leave_to(Request $request)
    {
        $status = OfficeLeaves::find($request->leave_id);
        $status->request_id = $request->request_id;
        $status->update();
        return redirect('admin/office-attendance?type=leaves')->with('success', 'Leave Assigned Successfully!');
    }

    public function attendance2()
    {
        $office_employees = OfficeEmployees::with(['designation', 'designation.department', 'attendances2' ])->where('status','1')->get();
        $tableName = 'office_sec_attendances'; // Replace with your table name
        $columns = Schema::getColumnListing($tableName);
        // dd($office_employees->firstWhere('attendances2.0.month', date('Y-m')));
        $sec_attendance = OfficeSecAttendances::get();
        // dd($sec_attendance);
        return view('admin.office.attendence2', compact('office_employees','columns','sec_attendance'));
    }
    public function attendance2_update(Request $request, $id){
        if($request->type == 'checked'){
            $data = ['emp_id' => $id,'month' => "$request->monthYear"];
            foreach($request->data as $date){
                $jsontoarry = json_decode($date,true);
                $data[$jsontoarry['day']] = $jsontoarry['sun'] == true ? 'sun' : 'p';
            }
            $check = OfficeSecAttendances::where('month',$request->monthYear)->where('emp_id',$id);
            if($check->count() == 0){
                OfficeSecAttendances::insert($data);
            }else{
                OfficeSecAttendances::find($check->first()->id)->update($data);
            }
        }else{
            $jsontoarry = json_decode($request->data, true);
            // print_R($jsontoarry);
            $day = $jsontoarry['day'];
            // print_r(["$day" => '']);
            OfficeSecAttendances::where('month', $request->monthYear)->where('emp_id', $id)->update(["$day" => null]);
        }

    }
}
