<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RolePermission
{
    /**
     * Handle an incoming request.
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$role){
        $allowed = false;
        foreach($role as $r){
            if(Auth::user()->adminRole->name == $r){
                $allowed = true;
                break;
            }
        }
        //dd($allowed);

        if($allowed === true){
            return $next($request);
        }
        else{
            abort(404);
        }
    }
}
