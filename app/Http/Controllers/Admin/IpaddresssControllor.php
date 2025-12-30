<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AllowedIp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class IpaddresssControllor  extends Controller
{
    public function index(){
        $allowIp=AllowedIp::get();
        return view('admin.Ipaddress.index',compact('allowIp'));
    }
}