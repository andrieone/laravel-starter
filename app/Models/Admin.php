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
use App\Notifications\AdminResetPassword;

class Admin extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    // These traits are used for admin login authentication
    use Authenticatable, Authorizable, CanResetPassword, Notifiable;

    protected $hidden   = [
        'password',
        'remember_token'
    ];

    protected $fillable =[
        'admin_role_id',
        'display_name',
        'email',
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = ['email_verified_at' => 'datetime',];

    /** Override the default function to send password reset notification */
    public function sendPasswordResetNotification($token){
        $this->notify(new AdminResetPassword($token));
    }

    public function adminRole(){
        return $this->belongsTo('App\Models\AdminRole');
    }

    /** For company_admin role **/
    public function company(){
        return $this->hasOne('App\Models\Company');
    }

}
