<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    public $timestamps = false;

    protected $appends  = ['display_name'];

    protected $fillable =[
        'admin_id',
        'activity',
        'detail',
        'ip',
        'access_time'
    ];

    public function admin(){
        return $this->belongsTo('App\Models\Admin');
    }

    public function getDisplayNameAttribute()
    {
        return $this->admin()->first()->display_name;
    }
}
