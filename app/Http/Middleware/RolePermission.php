<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
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
            /** RESTRICT TO EDIT ANOTHER COMPANY DATA **/
            if(Auth::user()->adminRole->name == "company_admin" && $request->route('company') != Auth::user()->company->id ){
                abort(404);
            }

            if(!empty( $request->hasSession('language') )){
                App::setLocale( $request->session()->get('language') );
            }

            return $next($request);
        }
        else{
            return redirect('/login');
        }
    }
}
