<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeLeaves extends Model
{
    use HasFactory;

    protected $fillable = [
        "leave_type",
        "half_leave",
        "leave_reason",
        "leave_to",
        "leave_from",
        "emp_id",
        "request_id",
        "status"
    ];

    public function employee()
    {
        return $this->belongsTo(OfficeEmployees::class, 'emp_id', 'id');
    }
    public function approved_by()
    {
        return $this->belongsTo(OfficeEmployees::class, 'request_id', 'id');
    }
}
