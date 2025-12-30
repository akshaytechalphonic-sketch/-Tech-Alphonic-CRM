<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\OfficeLeadsFolders;
use App\Models\OfficeLeads;
use App\Models\OfficeEmployees;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CampaignController extends Controller
{
    public function run($folder_id)
    {
        
        DB::beginTransaction();

        try {

            $folder = OfficeLeadsFolders::findOrFail($folder_id);
            

            // Employees from emp_json
            $empIds = json_decode($folder->emp_json, true);
           
           
            if (empty($empIds)) {
                return back()->with('success', 'No employees in folder');
            }

            // Active + Online employees
            $employees = OfficeEmployees::whereIn('id', $empIds)
                ->where('status', '1')
                ->where('is_online', 1)
                ->get();
               

            

            if ($employees->count() == 0) {
                return back()->with('success', 'No active employees online');
            }

            // Workload count
            foreach ($employees as $emp) {
                $emp->pending = OfficeLeads::where('emp_id', $emp->id)
                    ->where('status', 'open')
                    ->count();
            }

            // Sort by least workload
            $employees = $employees->sortBy('pending')->values();
            // dd($employees);  

            // Unassigned leads
            $leads = OfficeLeads::where('folder_id', $folder_id)
                ->whereNull('emp_id')
                ->where('status', 'open')
                ->get();


            if ($leads->count() == 0) {
                return back()->with('success', 'No unassigned leads');
            }

            // Assign (Round Robin)
            $i = 0;
            $totalEmp = $employees->count();
          

            foreach ($leads as $lead) {

                $emp = $employees[$i % $totalEmp];
               

                $lead->update([
                    'emp_id' => $emp->id,
                     'assign_date' => now()->format('Y-m-d')
                ]);

                $i++;
            }

            DB::commit();

            return back()->with('success', "{$i} leads assigned successfully");

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }
}