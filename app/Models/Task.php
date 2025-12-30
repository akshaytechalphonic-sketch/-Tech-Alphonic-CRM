<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

     protected $fillable = ['department_id','role_id','assign_by','reporting_head','task_type','title','description','remark','status'];

}
