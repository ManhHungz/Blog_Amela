<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class Permission
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
        if(auth()->user()->roles['0']->name == 'Admin'){
            return $next($request);
        }

        return redirect('/login');
    }
}
