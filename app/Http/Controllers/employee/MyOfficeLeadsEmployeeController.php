<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Models\OfficeEmployees;
use App\Models\OfficeLeads;
use App\Models\OfficeLeadsFolders;
use App\Models\OfficeSaleTargets;
use App\Models\OfficeLeadFollowups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MyOfficeLeadsEmployeeController extends Controller
{
    public function index()
    {
      
        $login_employee = Auth::guard('office_employees')->user();

        $leads = OfficeLeads::where('trash', false)
            ->when(isset($_GET['status']) && $_GET['status'] != null, fn($q) => $q->where('status', $_GET['status']))
            ->when(isset($_GET['filter_by_lead']) && $_GET['filter_by_lead'] != null, fn($q) => $q->where('assign_date', $_GET['filter_by_lead']))
            ->where('emp_id', $login_employee->id)
            ->orderBy('id', 'DESC')
            ->with('employee', 'integration')
            ->get();
        $lead_folders = OfficeLeadsFolders::all();
        $seniors = OfficeEmployees::get();
        $clients=OfficeLeads::pluck('client_name');
        

        return view('office.leads.leads', compact('leads', 'lead_folders', 'login_employee','seniors','clients'));
    }

    public function create_lead(Request $request)
    {
        $login_employee = Auth::guard('office_employees')->user();

        $addlead = new OfficeLeads;
        $addlead->emp_id = $login_employee->id;
        $addlead->service_name = $request->service_name;
        $addlead->client_name = $request->client_name != null ? $request->client_name : 'Anonymous';
        $addlead->client_mobile = $request->client_mobile;
        $addlead->client_email = $request->client_email != null ? $request->client_email : 'Anonymous';
        $addlead->status = $request->status;
        $addlead->amount = $request->amount;
        $addlead->final_amount = $request->final_amount;
        $addlead->recived_amount = $request->recived_amount;
        $addlead->folder_id = $request->folder_id;
        $addlead->assign_date = date('Y-m-d');
        $addlead->remark = json_encode([['remark' => $request->remark, 'date' => date('Y-m-d'), 'time' => date('h:i A'), 'status' => $request->status]]);
        $addlead->save();

        $month = strtolower(date('M'));
        $day = date('d');

        $findYear = OfficeSaleTargets::where('emp_id', $login_employee->id)->where('year', date('Y'))->count();

        if ($findYear == 0) {
            $targetSet = new OfficeSaleTargets;
            $targetSet->emp_id = $login_employee->id;
            $targetSet->year = date('Y');
            $targetSet->$month = json_encode([['day' => $day, 'final_amount' => $request->final_amount, 'recived_amount' => $request->recived_amount == null ? 0 : $request->recived_amount]]);
            $targetSet->save();
        } else {
            $findMonth = OfficeSaleTargets::where('emp_id', $login_employee->id)->where('year', date('Y'))->whereNull($month)->count();
            if ($findMonth == 0) {
                $createMonth = OfficeSaleTargets::where('emp_id', $login_employee->id)->where('year', date('Y'))->first();
                $oldJson = json_decode($createMonth->$month, true);
                $oldJson[] = ['day' => $day, 'final_amount' => $request->final_amount, 'recived_amount' => $request->recived_amount == null ? 0 : $request->recived_amount];
                $createMonth->$month = json_encode($oldJson);
                $createMonth->update();
            } else {
                $createMonth = OfficeSaleTargets::where('emp_id', $login_employee->id)->where('year', date('Y'))->first();
                $createMonth->$month = json_encode([['day' => $day, 'final_amount' => $request->final_amount, 'recived_amount' => $request->recived_amount == null ? 0 : $request->recived_amount]]);
                $createMonth->update();
            }
        }
        //end check storage

        return redirect()->back()->with('success', 'Lead Added Successfully!');
    }
    public function single_lead($id)
    {
        
        $login_employee = Auth::guard('office_employees')->user();
        $lead = OfficeLeads::where('trash', false)->where('emp_id', $login_employee->id)->find($id);
        $followups = OfficeLeadFollowups::where('lead_id', $id)->where('emp_id', $login_employee->id)->get();
        // dd($lead);
        return view('office.leads.single-lead', compact('lead', 'followups'));
    }

    public function update_lead_remark(Request $request, $id)
    {
        $login_employee = Auth::guard('office_employees')->user();
        $lead = OfficeLeads::where('trash', false)->where('emp_id', $login_employee->id)->find($id);
        $lead->status = $request->status;

        $old_remark = json_decode($lead->remark, true);
        if ($lead->final_amount != $request->final_amount && $lead->recived_amount != $request->recived_amount) {
            $old_remark[] = ['remark' => $request->remark, 'date' => date('Y-m-d'), 'time' => date('h:i A'), 'status' => $request->status, 'final_amount' => $request->final_amount, 'recived_amount' => $request->recived_amount];
        } elseif ($lead->final_amount != $request->final_amount) {
            $old_remark[] = ['remark' => $request->remark, 'date' => date('Y-m-d'), 'time' => date('h:i A'), 'status' => $request->status, 'final_amount' => $request->final_amount];
        } elseif ($lead->recived_amount != $request->recived_amount) {
            $old_remark[] = ['remark' => $request->remark, 'date' => date('Y-m-d'), 'time' => date('h:i A'), 'status' => $request->status, 'recived_amount' => $request->recived_amount];
        } else {
            $old_remark[] = ['remark' => $request->remark, 'date' => date('Y-m-d'), 'time' => date('h:i A'), 'status' => $request->status];
        }
        $lead->amount = $lead->amount == "0" ? $request->final_amount : $lead->amount;
        $lead->final_amount = $request->final_amount;
        $lead->recived_amount = $request->recived_amount;
        $lead->remark = json_encode($old_remark);
        $lead->update();

        $month = strtolower(date('M'));
        $day = date('d');

        $findYear = OfficeSaleTargets::where('emp_id', $login_employee->id)->where('year', date('Y'))->count();

        if ($findYear == 0) {
            $targetSet = new OfficeSaleTargets;
            $targetSet->emp_id = $login_employee->id;
            $targetSet->year = date('Y');
            $targetSet->$month = json_encode([['day' => $day, 'final_amount' => $request->final_amount, 'recived_amount' => $request->recived_amount == null ? 0 : $request->recived_amount]]);
            $targetSet->save();
        } else {
            $findMonth = OfficeSaleTargets::where('emp_id', $login_employee->id)->where('year', date('Y'))->whereNull($month)->count();
            if ($findMonth == 0) {
                $createMonth = OfficeSaleTargets::where('emp_id', $login_employee->id)->where('year', date('Y'))->first();
                $oldJson = json_decode($createMonth->$month, true);
                $oldJson[] = ['day' => $day, 'final_amount' => $request->final_amount, 'recived_amount' => $request->recived_amount == null ? 0 : $request->recived_amount];
                $createMonth->$month = json_encode($oldJson);
                $createMonth->update();
            } else {
                $createMonth = OfficeSaleTargets::where('emp_id', $login_employee->id)->where('year', date('Y'))->first();
                $createMonth->$month = json_encode([['day' => $day, 'final_amount' => $request->final_amount, 'recived_amount' => $request->recived_amount == null ? 0 : $request->recived_amount]]);
                $createMonth->update();
            }
        }

        return redirect()->back();
    }

    public function create_folder(Request $request)
    {
        $create_folder = new OfficeLeadsFolders;
        $create_folder->folder_name = $request->input('folder_name');
        $create_folder->slug = Str::slug($request->input('folder_name'));
        $create_folder->emp_json = json_encode(array_map('intval', $request->input('employees')));
        $create_folder->save();

        return redirect(route('office_employee.leads.single_folder', ['slug' => $create_folder->slug]))->with('success', 'Folder Added Successfully!');
    }



    public function single_folder($slug)
    {
       
        $login_employee = Auth::guard('office_employees')->user();
        $single_folder = OfficeLeadsFolders::where('slug', $slug)->first();
        $lead_folders = OfficeLeadsFolders::all();

        // filter
        $leads = OfficeLeads::where('trash', false)
            ->when(isset($_GET['status']) && $_GET['status'] != null, fn($q) => $q->where('status', $_GET['status']))
            ->when(isset($_GET['filter_by_lead']) && $_GET['filter_by_lead'] != null, fn($q) => $q->where('assign_date', $_GET['filter_by_lead']))
            ->where('emp_id', $login_employee->id)
            ->where('folder_id', $single_folder->id)
            ->orderBy('id', 'DESC')
            ->with('employee')
            ->get();
        // end filter

        $single_folder_json = json_decode($single_folder->emp_json);

        return view('office.leads.single-lead-folder', compact('lead_folders', 'leads', 'slug', 'single_folder', 'login_employee'));
    }
    public function upload_lead_csv(Request $request, $folder_id)
    {
        $selectedCol = [];
        $excludeKey = ['_token', 'emp_id', 'csv', 'service_name', 'employees'];

        foreach ($request->all() as $key => $req) {
            if (!in_array($key, $excludeKey) &&  $req != 'none') {
                $selectedCol[$key] = $req;
            }
        }
        // print_r($selectedCol);
        // $csvFile = fopen($request->file('csv')->getPathName(), 'r');
        // manage assign
        $emp_json = json_decode($request->employees, true);
        $totalLeads = 29;
        $totalAgents = count($emp_json);
        $leadsPerAgent = ceil($totalLeads / $totalAgents);
        $employee = [];
        for ($i = 0; $i < $totalAgents; $i++) {
            $employee[] = ['agent_id' => $emp_json[$i], 'gets' => ($i < $totalLeads % $totalAgents ? $leadsPerAgent : $leadsPerAgent)];
        }

        print_r($employee);
        $lines = file($request->file('csv')->getPathName(), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $keys = $lines[0];
        unset($lines[0]);
        if ($lines === false) {
            die('Error reading the file.');
        }
        $oldVal = 1;
        $databse = [];
        foreach ($employee as $key => $emp) {
            $startIndex = $oldVal - 1;
            // echo $startIndex .'--'. $emp['gets'];
            $rows = array_slice($lines, $startIndex, $emp['gets']);
            foreach ($rows as $row) {
                // dd(json_decode($keys, true));
                $data = explode(',', $row);
                $data = array_combine(array_values($selectedCol), array_intersect_key($data, $selectedCol));
                $data['folder_id'] = $folder_id;
                $data['service_name'] = $request->service_name;
                $data['status'] = 'open';
                $data['emp_id'] = $emp['agent_id'];
                $data['amount'] = 0;
                $data['remark'] = json_encode([['remark' => "Please work on this lead as soon as possible", 'date' => date('Y-m-d'), 'time' => date('h:i A'), 'status' => 'open']]);
                $data['csv'] = json_encode(array_combine(array_values(explode(',', $keys)), array_intersect_key(explode(',', $row), explode(',', $keys))));;
                // dd($keys);
                // print_r($data);
                $databse[] = $data;
            }

            $oldVal += count($rows);
        }
        OfficeLeads::insert($databse);
        return redirect()->back()->with('success', 'Csv Imported Successfully!');
    }

    public function change_lead_assign(Request $request, $id)
    {
        $assign_lead = OfficeLeads::find($id);
        $assign_lead->emp_id = $request->assignTo;
        if ($assign_lead->old_assign != null) {
            $oldss = json_decode($assign_lead->old_assign, true);
            $oldss[] = ['id' => $request->old_emp, 'date' => date('Y-m-d'), 'time' => date('h:i A'), 'last_status' => $assign_lead->status];
        } else {
            $oldss = json_encode([['id' => $request->old_emp, 'date' => date('Y-m-d'), 'time' => date('h:i A'), 'last_status' => $assign_lead->status]]);
        }
        $assign_lead->old_assign = $oldss;
        $assign_lead->update();

        return redirect()->back()->with('success', 'Lead Assigned Successfully!');
    }

    public function assign_multiple_leads(Request $request)
    {
        foreach (json_decode($request->leads_ids) as $lead_id) {
            $assign_lead = OfficeLeads::find($lead_id);
            if ($assign_lead->old_assign != null) {
                $oldss = json_decode($assign_lead->old_assign, true);
                $oldss[] = ['id' => $assign_lead->emp_id, 'date' => date('Y-m-d'), 'time' => date('h:i A'), 'last_status' => $assign_lead->status];
            } else {
                $oldss = json_encode([['id' => $assign_lead->emp_id, 'date' => date('Y-m-d'), 'time' => date('h:i A'), 'last_status' => $assign_lead->status]]);
            }
            $assign_lead->emp_id = $request->emp_id;
            $assign_lead->old_assign = $oldss;
            $assign_lead->update();
        }
        return redirect()->back()->with('success', 'Leads Assigned Successfully!');
    }
    public function trash($id)
    {
        $trash = OfficeLeads::find($id);
        $trash->trash = true;
        $trash->update();
        return redirect()->back()->with('success', 'Lead Trashed Successfully!');
    }
    public function followup(Request $request, $lead_id)
    {
        $login_employee = Auth::guard('office_employees')->user();
        $add = new OfficeLeadFollowups;
        $add->emp_id = $login_employee->id;
        $add->lead_id = $lead_id;
        $add->date = $request->input('date');
        $add->time = $request->input('time') . ":00";
        $add->content = $request->input('content');
        $add->save();
        return redirect()->back();
    }
}
