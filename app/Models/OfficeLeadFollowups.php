<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeLeadFollowups extends Model
{
    use HasFactory;
    protected $fillable = [
        "lead_id",
        "emp_id",
        "date",
        "time",
        "content",
        "active",
        "created_at",
        "updated_at",
    ];

    public function employee()
    {
        return $this->belongsTo(OfficeEmployees::class, 'emp_id', 'id');
    }
}
