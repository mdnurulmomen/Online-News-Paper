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
        // dd(Auth::guard($guard)->check());

        if (Auth::guard($guard)->check()) {
            
            switch ($guard) {
                case 'admin':
                    return redirect()->route('admin.home');
                    break;

                case 'editor':
                    return redirect()->route('editor.home');
                    break;

                case 'reporter':
                    return redirect()->route('reporter.home');
                    break;

                // default:
                //     return redirect('/');
                //     break;
            }
        }

        return $next($request);
    }
}
