<?php

namespace App\Components\Category\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model implements CategoryContract
{
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function posts()
    {
        return $this->hasMany('App\Components\Post\Models\Post');
    }
}
