<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class HasApproval
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check() AND Auth::user()->approve_status == "yes") {
            return $next($request);
        } else {
            return redirect()->route('login')->with('message',"Your request is not approve yet. Please contact with our admin.");
        }
    }
}
