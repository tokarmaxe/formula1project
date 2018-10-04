<?php

namespace App\Components\File\Services;

use Illuminate\Http\UploadedFile;

interface FileServiceContract
{
    public function put(UploadedFile $file, $path, $name);

    public function remove($fullFilePath);
}
