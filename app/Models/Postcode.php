<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postcode extends Model
{
    // use SoftDeletes;
    protected $fillable = [
        'postcode',
        'prefecture_kana',
        'city_kana',
        'local_kana',
        'prefecture',
        'city',
        'local'
    ];
}
