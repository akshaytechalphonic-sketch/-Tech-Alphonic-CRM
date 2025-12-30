<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\ExcelDistribution;
use App\Models\UploadedExcelRow;
use App\Models\UploadedExcel;
use App\Models\OfficeLeads;
use App\Models\OfficeLeadsFolders;
use App\Models\OfficeEmployees;

class DistributeExcelLeads extends Command
{
    protected $signature = 'excel:distribute-leads';
    protected $description = 'Distribute scheduled excel leads';

    public function handle()
    {
        $now = now()->startOfMinute(); // 18:24:00

        $jobs = ExcelDistribution::where('status', 'pending')
            ->where('run_at', '<=', $now)
            ->get();


        foreach ($jobs as $job) {

            DB::beginTransaction();

            // try {


            // 🔒 lock job
            $job->update(['status' => 'processing']);

            // Folder
            $folder = OfficeLeadsFolders::findOrFail($job->folder_id);


            $empIds = $folder->emp_json;
            // If JSON string → decode
            if (is_string($empIds)) {
                $empIds = json_decode($empIds, true);
            }

            // If still not array → convert
            if (!is_array($empIds)) {
                $empIds = [];
            }

            $employees = OfficeEmployees::whereIn('id', $empIds)
                ->where('status', '1')
                ->where('is_online', 1)
                ->get();



            if ($employees->isEmpty()) {
                throw new \Exception('No active employees');
            }

            // workload
            $workloads = OfficeLeads::select('emp_id', DB::raw('COUNT(*) as open'))
                ->whereIn('emp_id', $employees->pluck('id'))
                ->where('status', 'open')
                ->groupBy('emp_id')
                ->pluck('open', 'emp_id');


            foreach ($employees as $emp) {
                $emp->open = $workloads[$emp->id] ?? 0;
            }

            $employees = $employees->sortBy('open')->values();

            // Excel rows
            $rows = UploadedExcelRow::where('uploaded_excel_id', $job->uploaded_excel_id)
                ->whereBetween('excel_row_no', [$job->start_row, $job->end_row])
                ->where('is_assigned', 0)
                ->lockForUpdate()
                ->get();



            $i = 0;
            $totalEmp = $employees->count();

            foreach ($rows as $row) {

                $lead = $row->raw_json;
                $emp  = $employees[$i % $totalEmp];

                OfficeLeads::create([
                    'folder_id'     => $job->folder_id,
                    'client_name'   => $lead['client_name'] ?? null,
                    'service_name'   => $lead['service_name'] ?? null,
                    'client_mobile' => $lead['client_mobile'] ?? null,
                    'client_email'  => $lead['client_email'] ?? null,
                    'status'        => 'open',
                    'emp_id'        => $emp->id,
                    'excel_distribution_id'=>$job->id,
                    'assign_date'   => now()->toDateString(),
                    'remark'        => json_encode([
                        [
                            'remark' => 'Please work on this lead as soon as possible',
                            'date'   => now()->format('Y-m-d'),
                            'time'   => now()->format('h:i A'),
                            'status' => 'open'
                        ]
                    ])
                ]);

                $row->update(['is_assigned' => 1]);
                $i++;
            }

            $job->update(['status' => 'completed']);

            UploadedExcel::where('id', $job->uploaded_excel_id)
                ->update(['status' => 'partially_distributed']);

            DB::commit();
            // } catch (\Throwable $e) {

            //     DB::rollBack();

            //     $job->update(['status' => 'pending']);

            //     \Log::error('Excel Distribution Error', [
            //         'job_id' => $job->id,
            //         'error'  => $e->getMessage()
            //     ]);
            // }
        }

        return Command::SUCCESS;
    }
}
