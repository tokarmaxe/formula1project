<?php

namespace App\Convention\Model\Traits;

use App\Components\File\Services\FileServiceContract;
use App\Components\Image\Models\Image;

trait ImageTrait
{
    public function getDeleteImages($postId, $str)
    {
        $cnt = 0;
        if($str == "getThumb")
            $method = Image::where('post_id', $postId)->orderBy('type', 'DESC')->where('type', 'thumbnail');
        else if($str == "getWithOutOrigin")
            $method = Image::where('post_id', $postId)->orderBy('type', 'DESC')->where('type', "!=", 'origin');
        else if($str == "getAll" || $str == "remove")
            $method = Image::where('post_id', $postId);
        $images = $method->get()->groupBy([
            'uid',
            function ($item) {
                return $item['type'];
            },
        ], $preserveKeys = true)
            ->mapWithKeys(function ($item) use (&$cnt, &$str) {
                $i = $item->map(function ($subItems) use(&$str) {
                    switch ($str){
                        case ($str == "get" || $str == "getWithOutOrigin" || $str == "getAll" || $str == "getThumb"):
                            return (app(FileServiceContract::class))->get($subItems->first()['path']);
                            break;
                        case "remove":
                            $subItems->first()->delete();
                            return (app(FileServiceContract::class))->remove($subItems->first()['path']);
                            break;
                    }
                });
                $subResult = [$cnt => $i];
                $cnt++;
                return $subResult;
            })->toArray();
        return $images;
    }
}
