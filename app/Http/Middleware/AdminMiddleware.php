<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;

use Illuminate\Auth\Middleware\AdminMiddleware as Middleware;

class AdminMiddleware
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
        if(Auth::check()){
            // \Auth::user() && \Auth::user()->admin == 1
            if(Auth::user()->role=='1'){
                Session::flash('Success','Logged in as Admin');
                return $next($request);

            }
            if(Auth::user()->role=='Data-Clerk'){
                Session::flash('Success','Logged as a Data Clerk');                
                return redirect('/home');
            }else
            if(Auth::user()->role=='Station-Incharge'){
                Session::flash('Success','Logged as incharge of a Duty Station');                
                return redirect('/home');
            }

            elseif(Auth::user()->role=='0'){
                    Session::flash('Success','Logged as a Employee');                
                    return redirect()->route('stationemployees');
                }            


        }else{
            return redirect('/login');

        }

        return $next($request);
    }
}
