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
    protected $appends = ['base'];

    public function post()
    {
        return $this->belongsTo('App\Components\Post\Models\Post');
    }

    public function getBaseAttribute()
    {
        $images = (app(Image::class))->where('type', 'thumbnail')->orWhere('type', 'large')->get()->groupBy([
            'uid',
            function ($item) {
                return $item['type'];
            },
        ], $preserveKeys = true)
            ->mapWithKeys(function ($item) use (&$cnt, &$str) {
                $i = $item->map(function ($subItems) use(&$str) {
                    return (app(FileServiceContract::class))->get($subItems->first()['path']);
                });

                $subResult = [$cnt => $i];
                $cnt++;
                return $subResult;
            });

        return $images;
    }
}
