<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'display_name',
        'label'
    ];

    // relation has many rules for admin
    public function admin(){
        return $this->hasMany('App\Models\Admin');
    }
}
