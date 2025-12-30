<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfficeEmployees;
use App\Models\OfficeLeads;
use App\Models\OfficeLeadsFolders;
use App\Models\OfficeLeadFollowups;
use App\Models\UploadedExcel;
use App\Models\UploadedExcelRow;
use App\Models\ExcelDistribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class MyOfficeLeadsController extends Controller
{

    public function index()
    {

        $leads = OfficeLeads::where('trash', false)
            ->when(isset($_GET['employee']) && $_GET['employee'] != null, fn($q) => $q->where('emp_id', $_GET['employee']))
            ->when(isset($_GET['status']) && $_GET['status'] != null, fn($q) => $q->where('status', $_GET['status']))
            ->when(isset($_GET['filter_by_lead']) && $_GET['filter_by_lead'] != null,  fn($q) => $q->where('assign_date', $_GET['filter_by_lead']))
            ->where('csv', '!=', '1')
            ->orderBy('id', 'DESC')
            ->with('employee')
            ->get();
         $seniors = OfficeEmployees::get();
        $sales_emp = OfficeEmployees::whereHas('designation.department', function ($query) {
            $query->where('department_name', 'Sales');
        })->with(['designation', 'designation.department'])->get();
        $lead_folders = OfficeLeadsFolders::all();

        return view('admin.office.leads', compact('leads', 'sales_emp', 'lead_folders','seniors'));
    }

    public function create_lead(Request $request)
    {
        // dd($request->all());
        $addlead = new OfficeLeads;
        $addlead->emp_id = $request->emp_id;
        $addlead->service_name = $request->service_name;
        $addlead->client_name = $request->client_name != null ? $request->client_name : 'Anonymous';
        $addlead->client_mobile = $request->client_mobile;
        $addlead->client_email = $request->client_email != null ? $request->client_email : 'Anonymous';
        $addlead->status = $request->status;
        $addlead->amount = $request->amount;
        $addlead->final_amount = $request->final_amount;
        $addlead->recived_amount = $request->recived_amount;
        $addlead->folder_id = $request->folder_id;
        $addlead->remark = json_encode([['remark' => $request->remark, 'date' => date('Y-m-d'), 'time' => date('h:i A'), 'status' => $request->status]]);
        $addlead->save();
        return redirect()->back()->with('success', 'Lead Added Successfully!');
    }
    public function single_lead($id)
    {
        $lead = OfficeLeads::find($id);
        $followups = OfficeLeadFollowups::where('lead_id', $id)->get();
        return view('admin.office.single-lead', compact('lead', 'followups'));
    }

    public function update_lead_remark(Request $request, $id)
    {
        $lead = OfficeLeads::find($id);
        $lead->status = $request->status;
        $old_remark = json_decode($lead->remark, true);
        $old_remark[] = ['remark' => $request->remark, 'date' => date('Y-m-d'), 'time' => date('h:i A'), 'status' => $request->status];
        $lead->remark = json_encode($old_remark);
        $lead->update();

        return redirect()->back();
    }

    public function create_folder(Request $request)
    {
        $create_folder = new OfficeLeadsFolders;
        $create_folder->folder_name = $request->input('folder_name');
        $create_folder->slug = Str::slug($request->input('folder_name'));
        $create_folder->emp_json = json_encode(array_map('intval', $request->input('employees')));
        $create_folder->save();

        return redirect(route('admin.leads.single_folder', ['slug' => $create_folder->slug]))->with('success', 'Folder Added Successfully!');
    }
    public function edit_folder(Request $request, $id)
    {
        $edit_folder = OfficeLeadsFolders::find($id);
        $edit_folder->folder_name = $request->input('folder_name');
        $edit_folder->slug = Str::slug($request->input('folder_name'));
        $edit_folder->emp_json = json_encode(array_map('intval', $request->input('employees')));
        $edit_folder->update();

        return redirect(route('admin.leads.single_folder', ['slug' => $edit_folder->slug]))->with('success', 'Folder Updated Successfully!');
    }
    public function single_folder($slug)
    {
        $single_folder = OfficeLeadsFolders::where('slug', $slug)->first();

        $lead_folders = OfficeLeadsFolders::all();

        // filter
        $leads = OfficeLeads::where('trash', false)
            ->where('folder_id', $single_folder->id)
            ->when(isset($_GET['employee']) && $_GET['employee'] != null, fn($q) => $q->where('emp_id', $_GET['employee']))
            ->when(isset($_GET['status']) && $_GET['status'] != null, fn($q) => $q->where('status', $_GET['status']))
            ->when(isset($_GET['filter_by_lead']) && $_GET['filter_by_lead'] != null, fn($q) => $q->where('assign_date', $_GET['filter_by_lead']))
            ->orderBy('id', 'DESC')
            ->with('employee')
            ->get();
        // end filter

        // dd($leads);
        $sales_emp = OfficeEmployees::whereHas('designation.department', function ($query) {
            $query->where('department_name', 'Sales');
        })->with(['designation', 'designation.department'])->get();

        $single_folder_json = json_decode($single_folder->emp_json);
        $sales_emp_folder = OfficeEmployees::whereIn('id', $single_folder_json)->whereHas('designation.department', function ($query) {
            $query->where('department_name', 'Sales');
        })->with(['designation', 'designation.department'])->get();

        return view('admin.office.single-lead-folder', compact('lead_folders', 'leads', 'slug', 'sales_emp', 'single_folder', 'sales_emp_folder'));
    }


    public function uploaded_excel()
    {
        $uploadedexcel = UploadedExcel::with('uploadedexcelrow')->get();

        
        $folders  = OfficeLeadsFolders::all();

        return view('admin.office.uploadedexcel', compact('uploadedexcel', 'folders'));
    }

    public function upload_lead_csv(Request $request)
    {

        $request->validate([
            'csv' => 'required|mimes:csv,txt',
        ]);

        $excludeKey = ['_token', 'csv'];
        $selectedCol = [];

        foreach ($request->all() as $key => $req) {
            if (!in_array($key, $excludeKey) && $req != 'none') {
                $selectedCol[$req] = $key; // db_col => csv_index
            }
        }
        // dd($selectedCol);

        /** 1️⃣ Create uploaded excel entry */
        $excel = UploadedExcel::create([
            'file_name'      => uniqid() . '_' . $request->file('csv')->getClientOriginalName(),
            'original_name' => $request->file('csv')->getClientOriginalName(),
            'total_rows' => 0, // update later
            'total_columns' => count($selectedCol),
            'uploaded_by' => auth()->id(),
            'created_at' => now(),
            'updated_at' => now(),
            'status' => 'pending'
        ]);

        $rows = array_map('str_getcsv', file($request->file('csv')));
        $rows = array_filter($rows, function ($row) {
            return count(array_filter($row)) > 0;
        });
        unset($rows[0]); // remove header

        

        $insert = [];
        $rowNo = 1;

        foreach ($rows as $row) {

            $data = [];
            foreach ($selectedCol as $dbCol => $csvIndex) {
                $data[$dbCol] = $row[$csvIndex] ?? null;
            }

            $insert[] = [
                'uploaded_excel_id' => $excel->id,
                'excel_row_no' => $rowNo++,
                'raw_json' => json_encode($data),
                'is_assigned' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        UploadedExcelRow::insert($insert);

        $excel->update(['total_rows' => count($insert)]);

        return back()->with('success', 'CSV uploaded successfully. Ready for distribution.');
    }


    // public function distributeExcel(Request $request)
    // {

    //     DB::beginTransaction();

    //     try {

    //         // ✅ 1. Validate request
    //         $request->validate([
    //             'excel_id'  => 'required|integer',
    //             'folder_id' => 'required|integer',
    //             'start'     => 'required|integer',
    //             'end'       => 'required|integer|gte:start',
    //         ]);

    //         // ✅ 2. Get unassigned excel rows (range based)
    //         $rows = UploadedExcelRow::where('uploaded_excel_id', $request->excel_id)
    //             ->whereBetween('excel_row_no', [$request->start, $request->end])
    //             ->where('is_assigned', 0)
    //             ->lockForUpdate() // 🔒 avoid double assignment
    //             ->get();


    //         if ($rows->isEmpty()) {
    //             DB::rollBack();
    //             return back()->with('error', 'No rows found to assign');
    //         }

    //         // ✅ 3. Get folder
    //         $folder = OfficeLeadsFolders::findOrFail($request->folder_id);


    //         // ✅ 4. Decode employee IDs from emp_json
    //         $empIds = is_array($folder->emp_json)
    //             ? $folder->emp_json
    //             : json_decode($folder->emp_json, true);



    //         if (empty($empIds)) {
    //             DB::rollBack();
    //             return back()->with('error', 'No employees in folder');
    //         }

    //         // ✅ 5. Get ACTIVE + ONLINE employees only
    //         $employees = OfficeEmployees::whereIn('id', $empIds)
    //             ->where('status', '1')
    //             ->where('is_online', '1')
    //             ->get();


    //         if ($employees->isEmpty()) {
    //             DB::rollBack();
    //             return back()->with('error', 'No active employees online');
    //         }

    //         // ✅ 6. Calculate workload in ONE query (performance fix)
    //         $workloads = OfficeLeads::select('emp_id', DB::raw('COUNT(*) as pending'))
    //             ->whereIn('emp_id', $employees->pluck('id'))
    //             ->where('status', 'open')
    //             ->groupBy('emp_id')
    //             ->pluck('pending', 'emp_id');




    //         foreach ($employees as $emp) {
    //             $emp->pending = $workloads[$emp->id] ?? 0;
    //         }

    //         // ✅ 7. Sort by least workload
    //         $employees = $employees->sortBy('pending')->values();

    //         // ✅ 8. Assign leads (Round-Robin)
    //         $i = 0;
    //         $totalEmp = $employees->count();

    //         foreach ($rows as $row) {

    //             $lead = $row->raw_json;
    //             $emp  = $employees[$i % $totalEmp];

    //             OfficeLeads::create([
    //                 'folder_id'     => $request->folder_id,
    //                 'service_name'   => $lead['service_name'] ?? null,
    //                 'client_name'   => $lead['client_name'] ?? null,
    //                 'client_mobile' => $lead['client_mobile'] ?? null,
    //                 'client_email'  => $lead['client_email'] ?? null,
    //                 'status'        => 'open',
    //                 'emp_id'        => $emp->id,
    //                 'assign_date'   => now()->toDateString(),
    //                 'remark'        => json_encode([
    //                     [
    //                         'remark' => 'Please work on this lead as soon as possible',
    //                         'date'   => now()->format('Y-m-d'),
    //                         'time'   => now()->format('h:i A'),
    //                         'status' => 'open'
    //                     ]
    //                 ]),
    //             ]);

    //             // ✅ mark excel row assigned
    //             $row->update(['is_assigned' => 1]);

    //             $i++;
    //         }

    //         // ✅ 9. Update excel status
    //         UploadedExcel::where('id', $request->excel_id)
    //             ->update(['status' => 'partially_distributed']);

    //         DB::commit();

    //         return back()->with('success', "{$i} leads distributed successfully");
    //     } catch (\Throwable $e) {

    //         DB::rollBack();
    //         return back()->with('error', $e->getMessage());
    //     }
    // }

  


  public function scheduleDistribution(Request $request)
{
    // dd($request);
    $request->validate([
        'excel_id'        => 'required|exists:uploaded_excels,id',
        'folder_id'       => 'required|array',
        'start'           => 'required|array',
        'end'             => 'required|array',
        'assign_date'     => 'required|array',
        'assign_time'     => 'required|array',
    ]);

    foreach ($request->folder_id as $index => $folderId) {

        ExcelDistribution::create([
            'uploaded_excel_id' => $request->excel_id,
            'folder_id'         => $folderId,
            'start_row'         => $request->start[$index],
            'end_row'           => $request->end[$index],
            'run_at'            => $request->assign_date[$index] . ' ' . $request->assign_time[$index],
            'status'            => 'pending',
        ]);
    }

    return back()->with('success', 'Multiple distributions scheduled successfully');
}


    private function getAvailableEmployees()
    {
        return OfficeEmployees::scopeActive()
            // ->where('is_present', 1)
            ->withCount(['leads as pending_leads_count' => function ($q) {
                $q->where('status', '!=', 'closed');
            }])
            ->orderBy('pending_leads_count', 'asc')
            ->get();
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
        $assign_lead->assign_date = date('Y-m-d');
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
            $assign_lead->assign_date = date('Y-m-d');
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
    public function trash_restore($id)
    {
        $trash = OfficeLeads::find($id);
        $trash->trash = false;
        $trash->update();
        return redirect()->back()->with('success', 'Lead Restore Successfully!');
    }
    public function delete_lead($id)
    {
        $delete = OfficeLeads::find($id);
        $delete->delete();
        return redirect()->back()->with('success', 'Lead Deleted Successfully!');
    }

    public function delete_cron($id)
    {
        $delete = ExcelDistribution::find($id);
        $delete->delete();
        return redirect()->back()->with('success', 'Cron Job Deleted Successfully!');
    }
    public function trash_leads()
    {
        $leads = OfficeLeads::where('trash', true)->with('employee')->get();

        $sales_emp = OfficeEmployees::whereHas('designation.department', function ($query) {
            $query->where('department_name', 'Sales');
        })->with(['designation', 'designation.department'])->get();
        $lead_folders = OfficeLeadsFolders::all();

        return view('admin.office.leads', compact('leads', 'sales_emp', 'lead_folders'));
    }


    public function cron_history($id)
    {

        $cronleads = ExcelDistribution::where('uploaded_excel_id',$id)->with('uploadexcell', 'employeefolder')->get();


        return view('admin.office.leadcron-history', compact('cronleads'));
    }

     public function assiged_employee($id)
    {
      

        // $assign_lead = OfficeLeads::with('employee','folder')->where('excel_distribution_id',$id)->get();
       
        
       $assign_lead = OfficeLeads::with(['employee', 'folder','excel_distribution'])
        ->where('excel_distribution_id', $id)
        ->select(
            'emp_id',
            DB::raw('COUNT(*) as lead_count'),
            DB::raw('MIN(folder_id) as folder_id'),
            DB::raw('MIN(service_name) as service_name'),
            // DB::raw('MIN(assign_date) as assign_date'),
             DB::raw('MIN(created_at) as created_at')
            // DB::raw('MIN(status) as status')
        )
        ->groupBy('emp_id')
        ->get();




        return view('admin.office.assigned-leads', compact('assign_lead'));
    }

    public function excel_leads($id)
    {

        $excelleads = UploadedExcelRow::where('uploaded_excel_id', $id)->get();

        return view('admin.office.excel-leads', compact('excelleads'));
    }
}
