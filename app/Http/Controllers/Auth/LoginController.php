<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     * @var string
     */
    protected $redirectTo = '/admin/admins';

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct(){
        $this->middleware('guest')->except('logout');
    }

    protected function loggedOut(Request $request) {
        return redirect('/login');
    }

    protected function authenticated(Request $request, $user)
    {
        switch ($user->admin_role_id){
            case 1:
                return redirect()->route('admin.superadmin.index');
            case 2:
                return redirect()->route('admin.news.index');
            case 3:
                return redirect()->route('admin.company.user.index', $user->company->id);
        }

        return redirect('/home');
    }
}
