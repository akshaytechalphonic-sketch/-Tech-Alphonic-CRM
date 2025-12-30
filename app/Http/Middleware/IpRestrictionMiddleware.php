<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AllowedIp;


class IpRestrictionMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // $allowedIp = '106.219.163.210'; // Replace with your allowed IP
        $userIp = $request->ip();
        // dd($userIp);
       
        $exists = AllowedIp::where('ip_address', $userIp)->exists();
        if (!$exists) {
            abort(403, 'Access denied.');
        }

        return $next($request);
    }
}
