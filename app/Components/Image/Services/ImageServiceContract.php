<?php


namespace App\Components\Image\Services;


interface ImageServiceContract
{
    public function uploadImages($files, $postId);

    public function saveModel($imageNames, $postId);

}