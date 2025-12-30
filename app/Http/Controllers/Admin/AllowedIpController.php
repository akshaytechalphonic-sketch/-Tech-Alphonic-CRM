<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AllowedIp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AllowedIpController  extends Controller
{
     public function index()
    {
        $allowIp = AllowedIp::orderBy('id','desc')->paginate(10);
        return view('admin.Ipaddress.index', compact('allowIp'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'ip_address' => 'required|ip',
        ]);

        AllowedIp::create([
            'ip_address' => $request->ip_address
        ]);

        return redirect()->route('admin.ip.index')->with('success', 'IP Added Successfully');
    }

    // public function edit($id)
    // {
    //     $allowIp = AllowedIp::findOrFail($id);
    //     return view('admin.ip.edit', compact('allowIp'));
    // }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ip_address' => 'required|ip',
        ]);

        $allowIp = AllowedIp::findOrFail($id);
        $allowIp->update([
            'ip_address' => $request->ip_address
        ]);

        return redirect()->route('admin.ip.index')->with('success', 'IP Updated Successfully');
    }

    public function destroy($id)
    {
        AllowedIp::find($id)->delete();
        return response()->json(['success' => 'IP Deleted']);
    }
}