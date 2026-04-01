<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'client_email',
        'client_name',
        'date',
        'start_time',
        'end_time',
        'meet_link',
        'status',
        'created_by',
        'description',
        'remarks',
    ];

    protected $casts = [
        'remarks' => 'array',
    ];

    /**
     * The employee who created the meeting.
     */
    public function creator()
    {
        return $this->belongsTo(OfficeEmployees::class, 'created_by', 'id');
    }

    /**
     * The lead associated with the meeting.
     */
    public function officelead()
    {
        return $this->belongsTo(OfficeLeads::class, 'client_name', 'id');
    }
}
