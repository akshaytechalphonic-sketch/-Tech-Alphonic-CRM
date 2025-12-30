<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OfficeAssignIntegLeads
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
