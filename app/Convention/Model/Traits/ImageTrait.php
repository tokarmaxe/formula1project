<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 26.11.18
 * Time: 22:45
 */

namespace App\Convention\Model\Traits;


use App\Components\File\Services\FileService;
use App\Components\Image\Models\Image;

trait ImageTrait
{
    public function getDeleteImages($postId, $str)
    {
        $cnt = 0;
        $images = Image::where('post_id', $postId)->get()->groupBy([
            'uid',
            function ($item) {
                return $item['type'];
            },
        ], $preserveKeys = true)
            ->mapWithKeys(function ($item) use (&$cnt, &$str) {
                $i = $item->map(function ($subItems) use(&$str) {
                    switch ($str){
                        case "get":
                            return (new FileService())->get($subItems->first()['path']);
                            break;
                        case "remove":
                            $subItems->first()->delete();
                            return (new FileService())->remove($subItems->first()['path']);
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