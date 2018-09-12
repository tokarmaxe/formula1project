<?php

namespace App\Components\Category\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model implements CategoryContract
{
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    protected $fillable = ['name'];

    public function posts()
    {
        return $this->hasMany('App\Components\Post\Models\Post');
    }
}
