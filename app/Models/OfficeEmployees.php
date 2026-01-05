<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Import Authenticatable
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OfficeEmployees extends Authenticatable  // Extend Authenticatable
{
    use HasFactory;

    // protected $guard="office_employees";
    protected $fillable = [
        "doj",
        "name",
        "email",
        "mobile_no",
        "gender",
        "dob",
        "religion",
        "marital_status",
        "children",
        "school_year",
        "school_document",
        "high_school_year",
        "high_school_document",
        "graducation_year",
        "graducation_document",
        "masters_year",
        "masters_document",
        "certificate",
        "total_exp",
        "about_employee",
        "father_name",
        "mother_name",
        "family_contact",
        "family_photo",
        "permanent_building_no",
        "permanent_area",
        "permanent_city",
        "permanent_country",
        "present_building_no",
        "present_area",
        "present_city",
        "present_country",
        "ipn_no",
        "ipn_file",
        "uan_no",
        "uan_file",
        "designation_id",
        "aadhar_no",
        "aadhar_file",
        "pan_no",
        "pan_file",
        "rent_elec",
        "rent_elec_file",
        "reference",
        "bank_name",
        "branch_location",
        "ifsc",
        "account_no",
        "profile_image",
        "cvupload",
        "police_verification",
        "status",
        "status_reason",
        "status_document",
        "other_document",
        "monthly_casual_leave",
        "monthly_paid_leave",
        "monthly_sick_leave",
        "other_leave",
        "shift_json",
        "monthly_sales_target",
        "password",
        "forgot_token",
        "google_token",
        "created_at",
        "updated_at"
    ];
    protected $hidden = [
        'password',
    ];
    
    

    public function scopeActive($query)
    {
        return $query->where('status', '1');
    }
    // Relationship with Designation
    public function designation()
    {
        return $this->belongsTo(OfficeDesignations::class, 'designation_id');  // The foreign key is 'designation_id'
    }

    // Access the department via the designation relationship
    public function department()
    {
        return $this->belongsToThrough(OfficeDepartments::class, OfficeDesignations::class, 'designation_id', 'department_id');
    }

    public function attendances()
    {
        return $this->hasMany(OfficeAttendances::class, 'emp_id', 'id');
    }
    public function attendances2()
    {
        return $this->hasMany(OfficeSecAttendances::class, 'emp_id', 'id');
    }

    public function role(){
        return $this->belongsTo(Role::class,'role_id','id');
    }

}
