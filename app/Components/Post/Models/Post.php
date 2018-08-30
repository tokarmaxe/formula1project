<?php

namespace App\Components\Post\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model implements PostContract
{
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo('App\Components\Category\Models\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\Components\User\Models\User');
    }

    public function images()
    {
        return $this->hasMany('App\Components\Image\Models\Image');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment\Post\Models\Comment');
    }
}
