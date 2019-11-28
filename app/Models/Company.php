<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'admin_id',
        'company_name',
        'post_code',
        'address',
        'phone',
        'status',
    ];

    public function admin(){
        return $this->belongsTo('App\Models\Admin');
    }

    public function users() {
        return $this->hasMany('App\Models\Users');
    }

}
