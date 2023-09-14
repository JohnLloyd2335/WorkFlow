<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // return redirect(RouteServiceProvider::HOME);
                if(in_array(auth()->user()->role->role,[1])) {
                    return redirect(route('admin.dashboard'));
                } elseif(in_array(auth()->user()->role->role,[1,2])) {
                    return redirect(route('employer.dashboard'));
                }
                else{
                    return redirect(route('home'));
                }
                
            }
        }

        return $next($request);
    }
}
