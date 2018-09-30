<?php

namespace App\Components\File\Services;

use Illuminate\Http\UploadedFile;

interface FileServiceContract
{
    public function put(UploadedFile $file, $imageName);

    public function remove($fullFilePath);
}
