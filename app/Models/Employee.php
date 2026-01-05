<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'rand_id',
        'name',
        'email',
        'mobile_no',
        'father_name',
        'ipn_no',
        'uan_no',
        'client_id',
        'designation',
        'gstin',
        'address',
        'ifd_concurrence',
        'role',
        'designation_of_administrative_approval',
        'payment_mode',
        'designation_of_financial_approval',
        'profile_image',
        'cvupload',
        'is_online',
        'role_id',
        'manager_id'
    ];

    public function getDesignationName() {
        return $this->hasOne(Destination::class, 'id', 'designation')->select('id','destination');
    }


    public function getDestinationsName() {
        return $this->hasOne(Destination::class, 'id', 'designation');
    }

    public function getClientName() {
        return $this->hasOne(Client::class, 'id', 'client_id')->select('id','name');
    }


}
