<?php

namespace App\Http\Middleware;

use Closure;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use App\Models\User;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->role->value !== User::ROLE_ADMIN)
        {
            abort(404);
        }
        return $next($request);
    }
}
