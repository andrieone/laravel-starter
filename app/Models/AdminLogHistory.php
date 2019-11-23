<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminLogHistory extends Model
{
    /**
     * flyable form
     * @var array
     */
    protected $fillable = [
        'admin_id',
        'activity',
        'detail',
        'ip',
        'last_access'
    ];

    public function admin(){
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}

