<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckCanLogin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && ! Auth::user()->can_login) {
            Auth::logout();

            return redirect()->route('login')->withErrors([
                'email' => 'Tu sesión ha sido cerrada porque tu cuenta fue deshabilitada.',
            ]);
        }

        return $next($request);
    }
}


