<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Weekly extends Model
{
    protected $fillable = [
        'monday',
        'sunday'
    ];
}
