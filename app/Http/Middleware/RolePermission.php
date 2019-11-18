<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RolePermission
{
    /**
     * Handle an incoming request.
     * db admin_roles->name == name
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param array                    $role
     * @return mixed
     */
    public function handle($request, Closure $next, ...$role){
        if(in_array(Auth::user()->adminRole->name, $role))
        {
            return $next($request);
        }
        else{
            return redirect('/login');
        }
    }
}
