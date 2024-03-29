<?php

namespace App\Components\Image\Services;


use Illuminate\Http\UploadedFile;

interface ImageServiceContract
{
    public function create($file, $postId);
    public function destroy($imageId);
    public function imagesByPostId($postId);
    public function destroyImagesByPostId($postId);
}
