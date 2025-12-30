<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeDepartments extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_name',
        'status',
        'created_at',
        'updated_at',
    ];

    // Relationship with Designations
    public function designations()
    {
        return $this->hasMany(OfficeDesignations::class, 'department_id');
    }

    // Relationship with Employees through Designations
    public function employees()
    {
        return $this->hasManyThrough(OfficeEmployees::class, OfficeDesignations::class, 'department_id', 'designation_id');
    }

    public function scopeActive($query)
{
    return $query->where('status', '1');
}
}
