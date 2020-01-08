<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'admin_id',
        'company_id',
        'title',
        'body',
        'image',
        'pdf_file',
        'radius',
        'publish_date',
        'status',
    ];

    public function admin(){
        return $this->belongsTo('App\Models\Admin');
    }

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
}
