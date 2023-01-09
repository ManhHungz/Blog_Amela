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
        $a = User::find(1);
        if (@$a->email == "daomanhhung3105@gmai.com"){
            return $next($request);
        }

        return redirect('login');
    }
}
