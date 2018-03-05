<?php

namespace App\Http\Middleware;

use App\Enums\Roles;
use Closure;
use Illuminate\Support\Facades\Auth;

class EmployeeMiddleware
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
        // || Roles::EMPLOYEE !== Auth::user()->role
        if (!Auth::check() || Roles::LEADER !== Auth::user()->role)
        {
            return redirect('/login');
        }

        return $next($request);
    }
}
