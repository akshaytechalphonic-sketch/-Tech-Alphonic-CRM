<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeLeads extends Model
{
    use HasFactory;

    protected $fillable = [
        "excel_distribution_id",
        "emp_id",
        "assign_date",
        "service_name",
        "client_name",
        "client_mobile",
        "client_email",
        "amount",
        "final_amount",
        "recived_amount",
        "remark",
        "followups",
        "status",
        "old_assign",
        "folder_id",
        "csv",
        "trash",
        "type",
        "integration_id",
        "created_at",
        "updated_at",
    ];


    public function employee()
    {
        return $this->belongsTo(OfficeEmployees::class, 'emp_id', 'id');
    }
    public function integration()
    {
        return $this->belongsTo(OfficeFacebookIntegrations::class, 'integration_id', 'id');
    }

    public function folder()
    {
        return $this->belongsTo(OfficeLeadsFolders::class,'folder_id','id');
    }

    public function excel_distribution(){
        return $this->belongsTo(ExcelDistribution::class,'excel_distribution_id');
    }
}
