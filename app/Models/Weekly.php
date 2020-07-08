<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Weekly extends Model
{
    protected $table = 'weeklys';

    protected $fillable = [
        'monday',
        'sunday'
    ];
}
