<?php

namespace App\Components\Category\Models;

use App\Convention\Model\Traits\IsoDateTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements CategoryContract
{
    use SoftDeletes;
    use IsoDateTrait;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    protected $fillable = ['name'];

    public function posts()
    {
        return $this->hasMany('App\Components\Post\Models\Post');
    }
}
