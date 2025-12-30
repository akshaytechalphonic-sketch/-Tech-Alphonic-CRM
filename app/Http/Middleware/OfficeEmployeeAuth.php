<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class OfficeEmployeeAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $guard = 'office_employees') // Default guard set to 'office_employees'
    {
        if (!Auth::guard($guard)->check()) {
            return redirect('/employee'); // Redirect to the login page if not authenticated
        }
        if (isset($_COOKIE['verify_location']) && Crypt::decrypt($_COOKIE['verify_location']) == 'device_is_inside_the_office_area') {
            return $next($request);
        } else {
            // Auth::guard($guard)->logout();
            // return redirect('/employee');
        }
        return $next($request);
    }
}
