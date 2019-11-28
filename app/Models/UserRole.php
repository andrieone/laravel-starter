<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'display_name',
        'label'
    ];

    public function user(){
        return $this->hasMany('App\Models\User');
    }
}
