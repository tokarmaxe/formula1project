<?php

namespace App\Components\Image\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model implements ImageContract
{
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function post()
    {
        return $this->belongsTo('App\Components\Post\Models\Post');
    }
}