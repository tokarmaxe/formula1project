<?php

namespace App\Components\Image\Models;

use App\Convention\Model\Traits\IsoDateTrait;
use Illuminate\Database\Eloquent\Model;
use App\Components\File\Services\FileServiceContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model implements ImageContract
{
    use IsoDateTrait;
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function post()
    {
        return $this->belongsTo('App\Components\Post\Models\Post');
    }
}
