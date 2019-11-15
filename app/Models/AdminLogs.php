<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminLogs extends Model
{
    /**
     * flyable form
     * @var array
     */
    protected $fillable = [
        'admins_id',
        'activity',
        'detail',
        'ip',
        'last_access'
    ];

    public function admin(){
        return $this->belongsTo('App\Models\Admin', 'admins_id', 'id');
    }
}

