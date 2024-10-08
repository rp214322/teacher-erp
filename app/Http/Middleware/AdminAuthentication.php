<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AdminAuthentication
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
        if(Auth::check())
        {
            if(in_array(Auth::user()->role,['admin','teacher','student']))
            {
                return $next($request);
            }
            else
            {
                return redirect()->intended('/')->with('info','You do not have rights to access this location');
            }
        }
        return redirect()->intended(route('admin.login'))->with('info','You do not have rights to access this location');
    }
}
