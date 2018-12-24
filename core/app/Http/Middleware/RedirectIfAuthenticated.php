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
            if($request->route()->name('admin')){
                return redirect()->route('admin.home');
            }
            if($request->route()->name('editor')){
                return redirect()->route('editor.home');
            }
            if($request->route()->name('reporter')){
                return redirect()->route('reporter.home');
            }
        }

        return $next($request);
    }
}
