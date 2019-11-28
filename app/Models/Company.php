<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_name',
        'post_code',
        'address',
        'phone',
    ];

    public function users() {
        return $this->hasMany('App\Models\Users');
    }

}
