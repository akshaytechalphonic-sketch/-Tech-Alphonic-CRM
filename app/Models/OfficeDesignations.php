<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeDesignations extends Model
{
    use HasFactory;

    protected $fillable = [
        'designation_name',
        'department_id',
        'status',
        'created_at',
        'updated_at',
    ];

    // Relationship with Department
    public function department()
    {
        return $this->belongsTo(OfficeDepartments::class, 'department_id');  // 'department_id' should be the foreign key
    }

    // Relationship with Employees
    public function employees()
    {
        return $this->hasMany(OfficeEmployees::class, 'designation_id');  // Assuming 'designation_id' is the foreign key
    }
}
