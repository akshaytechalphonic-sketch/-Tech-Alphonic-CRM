<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfficeAttendances;
use App\Models\OfficeDepartments;
use App\Models\OfficeEmployees;
use App\Models\OfficeDesignations;
use App\Models\OfficeLeaves;
use App\Models\OfficeTeams;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MyOfficeSalaryController extends Controller
{
    public function index(){
        return view('admin.office.salery');
    }
}