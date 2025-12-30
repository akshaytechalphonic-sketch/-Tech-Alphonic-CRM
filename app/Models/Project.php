<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'project_name',
        'client_name',
        'project_manager_id',
        'team_id',
        'start_date',
        'deadline',
        'status',
        'description',
    ];


    public function department()
    {
        return $this->belongsTo(OfficeDepartments::class, 'team_id', 'id');
    }

    public function manager()
    {
        return $this->belongsTo(OfficeEmployees::class, 'project_manager_id', 'id');
    }

    public function tasks()
    {
        return $this->hasMany(OfficeTask::class, 'project_id', 'id');
    }
}
