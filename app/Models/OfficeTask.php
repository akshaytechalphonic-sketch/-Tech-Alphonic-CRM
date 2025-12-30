<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeTask extends Model
{
    use HasFactory;
    protected $table = 'tasks';

    protected $fillable = [
        'department_id',
        'project_id',
        'role_id',
        'assign_by',
        'assigned_to',
        'reporting_head',
        'task_type',
        'estimate',
        'title',
        'description',
        'remark',
        'review_at',
        'completed_at',
        'status',
    ];

    public function department()
    {
        return $this->belongsTo(OfficeDepartments::class,'department_id', 'id');
    }

    public function assignee()
    {
        return $this->belongsTo(OfficeEmployees::class,'assigned_to', 'id');
    }
     public function reporter()
    {
        return $this->belongsTo(OfficeEmployees::class,'reporting_head', 'id');
    }

     public function project()
    {
        return $this->belongsTo(Project::class,'project_id', 'id');
    }
}
