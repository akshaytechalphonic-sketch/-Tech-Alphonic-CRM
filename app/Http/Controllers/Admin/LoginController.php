<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use Session;
use Mail;
use Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Session::flush();
        return view('admin.login.login');
    }
    public function submit(Request $request)
    {
        if ($request->has('email'))
        {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
                return redirect()->route('admin.dashboard');
            } else {
                return back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
            }
        }
        elseif ($request->has('mobile_no'))
        {
            $request->validate([
                'mobile_no' => 'required|numeric',
                'password' => 'required',
            ]);

            if (Auth::guard('admin')->attempt(['mobile_no' => $request->mobile_no, 'password' => $request->password])) {
                return redirect()->route('admin.dashboard');
            } else {
                return back()->withErrors(['mobile_no' => 'Invalid mobile number or password.'])->withInput();
            }
        }
          return redirect()->back()->withInput()->with('success' , 'Login failed, please try again!');
    }


    public function signup(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:admins,email',
                'mobile_no' => 'required|digits:10|unique:admins,mobile',
                'company_name' => 'nullable|string|max:255',
                'gst_no' => 'nullable|string|max:15',
                'password' => 'required|confirmed|min:6',
            ]);

            // Create user
            $user = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'company_name' => $request->company_name,
                'gst_no' => $request->gst_no,
                'password' => Hash::make($request->password),
            ]);
            return redirect()->route('login')->with('success', 'Registration successful!');

        }

        return view('admin.login.sign-up');


    }





    public function forget(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $request->validate([
                'email' => 'required|email|exists:admins,email',
            ], [
                'email.exists' => 'The email  is not registered in our admin system.',
            ]);

            $otp = rand(100000, 999999);

            Session::put('otp', $otp);
           $checkEmailSession = Session::put('otp_email', $request->email);
            return redirect()->route('verifyOtp')->with('success', 'Otp is'.$otp);
        }

        return view('admin.login.forget');

    }


    public function verifyOtp(Request $request)
    {
        if ($request->isMethod('post'))
        {
          //  return $request->all();
            $request->validate([
                'otp1' => 'required|numeric',
                'otp2' => 'required|numeric',
                'otp3' => 'required|numeric',
                'otp4' => 'required|numeric',
                'otp5' => 'required|numeric',
                'otp6' => 'required|numeric',
            ]);

            $otp = $request->otp1 . $request->otp2 . $request->otp3 . $request->otp4 . $request->otp5 . $request->otp6;

            $storedOtp = Session::get('otp');

            if ($otp == $storedOtp)
            {
                return redirect()->route('setPassword')->with('success', 'OTP verified successfully!');
            }
            else
            {
                return back()->withErrors(['otp' => 'Invalid OTP. Please try again.']);
            }
        }
        // if(Session::get('otp_email'))
        // {
            return view('admin.login.verify');
        // }
        // else{
        //     return redirect(route('login'));
        // }

    }

    public function setPassword(Request $request)
    {

        if ($request->isMethod('post'))
        {
            $request->validate([
                'email' => 'required|email|exists:admins,email',
                'password' => 'required|confirmed|min:2',
            ]);

            $admin = Admin::where('email', $request->email)->first();

            if ($admin) {
                $admin->password = Hash::make($request->password);
                $admin->save();
                Session::flush();
                return redirect()->route('login')->with('success', 'Password changed successfully!');
            }
        }

      //  Session::flush();
        if(Session::get('otp_email'))
        {
            return view('admin.login.setpassword');
        }
        else{
            return redirect(route('login'));
        }

    }


        public function logout()
            {
                // Log out the admin guard
                Auth::guard('admin')->logout();

                // Redirect to the login page or any desired location
                return redirect()->route('admin.login')->with('success', 'You have been logged out successfully.');
            }
}
