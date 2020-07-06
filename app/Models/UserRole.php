<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'label'
    ];

    public function user(){
        return $this->hasMany('App\Models\User');
    }
}
