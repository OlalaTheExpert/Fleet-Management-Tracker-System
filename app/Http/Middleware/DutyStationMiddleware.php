<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;

use Illuminate\Auth\Middleware\DutyStationMiddleware as Middleware;

class DutyStationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

       //
        return $next($request);
    }
}
