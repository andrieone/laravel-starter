<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    // These traits are used for admin login authentication
    use Authenticatable, Authorizable, CanResetPassword, Notifiable, SoftDeletes;

    protected $hidden   = [
        'password',
        'remember_token'
    ];

    protected $fillable =[
        'company_id',
        'user_role_id',
        'display_name',
        'email',
        'password',
        'remember_token'
    ];

    public function userRole(){
        return $this->belongsTo('App\Models\UserRole');
    }

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }

}
