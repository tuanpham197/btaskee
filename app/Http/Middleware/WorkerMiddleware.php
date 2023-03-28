<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkerMiddleware
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
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $user = Auth::user();
        if (!in_array($user->role, [User::ROLE_ADMIN, User::ROLE_WORKER])  ) {
            return redirect()->route('home');
        }
        return $next($request);
    }
}
