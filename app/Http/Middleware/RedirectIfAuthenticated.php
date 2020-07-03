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
        if (Auth::guard($guard)->check()) {
            if(Auth::guard("web")->check()){
                if(Auth::user()->admin_role_id == 1){
                    return redirect()->route('admin.superadmin.edit', ['superadmin' => Auth::user()->id]);
                }else{
                    return redirect()->route('admin.admins.edit', ['admin' => Auth::user()->id]);
                }
            }
        
            if(Auth::guard("user")->check()){
                return redirect()->route('userowner-edit');
            }
        }

        return $next($request);
    }
}
