<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if($request->is('admin')){
                return redirect()->route('admin.home');
            }
            else if($request->is('editor')){
                return redirect()->route('editor.home');
            }
            else if($request->is('reporter')){
                return redirect()->route('reporter.home');
            }
        }

        return $next($request);
    }
}
