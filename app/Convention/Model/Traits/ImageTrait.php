<?php

namespace App\Convention\Model\Traits;

use App\Components\File\Services\FileServiceContract;
use App\Components\Image\Models\Image;

trait ImageTrait
{
    /*
     * this method can work with files connected with post -
     *  1) returns files array by post id
     * -only all thumnails,
     * - all files without origin,
     * - only one thumbnail by post
     * - all files
     * 2)delete files by post id
     */
    public function getDeleteImages($postId, $str, bool $lazy = true)
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
            ->mapWithKeys(function ($item) use (&$cnt, &$str, &$lazy) {
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
                //we returned only one thumbnail for every post if $lasy is true - not ,more need to build list of posts
                if ($lazy&&$str=='getThumb'&&!is_null($subResult))
                    return $subResult;
                $cnt++;
                return $subResult;
            })->toArray();
        return $images;
    }
}
