<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeAttendances extends Model
{
    use HasFactory;

    protected $fillable = [
        "emp_id",
        "check_in",
        "check_out",
        "leave_type",
        "half_leave",
        "leave_reason",
        "leave_to",
        "leave_from",
        "leave_file",
        "status"
    ];

    // Relationship with Employee
    public function employee()
    {
        return $this->belongsTo(OfficeEmployees::class, 'emp_id', 'id');
    }
}
