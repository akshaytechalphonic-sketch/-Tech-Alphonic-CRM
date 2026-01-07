<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Models\OfficeEmployees;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class EmployeeProfileController extends Controller
{




    public function employeeProfile()
    {
        // Detect logged-in user & guard
        if (auth('office_employees')->check()) {
            $user = auth('office_employees')->user();
            $guard = 'office_employees';
        } elseif (auth('admin')->check()) {
            $user = auth('admin')->user();
            $guard = 'admin';
        } else {
            abort(403);
        }

        // Load relations
        $office_employees = OfficeEmployees::with(['designation', 'designation.department'])
            ->where('id', $user->id)
            ->first();
        if (auth('office_employees')->check()) {

            return view('office.employee.profileupdate', compact('office_employees', 'guard'));
        } else {

            return view('admin.adminprofileupdate', compact('office_employees', 'guard'));
        }
    }


    public function profileUpdate(Request $request)
    {
        if (auth('office_employees')->check()) {
            $user = auth('office_employees')->user();
            $table = 'office_employees';
        } elseif (auth('admin')->check()) {
            $user = auth('admin')->user();
            $table = 'admins';
        } else {
            abort(403);
        }

        $request->validate([
            'name'       => 'required|string|max:255',
            'email' => 'required|email|unique:' . $table . ',email,' . $user->id,
            'mobile_no'  => 'required|digits:10',
            'gender'     => 'required',
            'password'   => 'nullable|min:6',
            'profile_image' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile_no = $request->mobile_no;
        $user->gender = $request->gender;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('profile_image')) {

            if ($user->profile_image && File::exists(public_path('uploads/profile/' . $user->profile_image))) {
                File::delete(public_path('uploads/profile/' . $user->profile_image));
            }
            $imageName = time() . '.' . $request->profile_image->extension();
            $request->profile_image->move(public_path('uploads/profile'), $imageName);

            $user->profile_image = $imageName;
        }


        $user->save();

        return back()->with('success', 'Profile updated successfully');
    }
}
