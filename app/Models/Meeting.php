<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;
   

    protected $fillable=[
        'title',
        'client_email',
        'client_name',
        'date',
        'start_time',
        'end_time',
        'meet_link',
        'google_event_id',
        'senior_id',
        'status',
        'created_by',
        'description',
    ];


    public function employee(){
        return $this->belongsTo(OfficeEmployees::class,'senior_id','id');
    }

    public function officelead()
{
    return $this->belongsTo(OfficeLeads::class, 'client_name', 'id');
}

}
