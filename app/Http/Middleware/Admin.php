<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class Admin
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
        if (empty(Auth::guard('admin')->user())){
            return redirect()->route('admin_login')->withErrors(['password' => "You're not Authenticated. Please Login."]);
        }
        return $next($request);
    }
}
