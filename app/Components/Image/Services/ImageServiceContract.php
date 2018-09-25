<?php

namespace App\Components\Image\Services;


use Illuminate\Http\UploadedFile;

interface ImageServiceContract
{
    public function create($file);
    public function destroy();
}
