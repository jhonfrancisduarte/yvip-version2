<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$role)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if (in_array($user->user_role, $role)) {
                return $next($request);
            }

            if ($user->user_role === 'yv' || $user->user_role === 'yip') {
                return redirect()->route('dashboard');
            }else if($user->user_role === 'sa' || $user->user_role === 'vs'
                    || $user->user_role === 'vsa' || $user->user_role === 'ips'){
                return redirect()->route('admin-dashboard');
            }

        }

        return redirect('/');
    }
}
