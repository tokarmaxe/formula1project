<?php

namespace App\Components\File\Services;


use Illuminate\Http\UploadedFile;

interface FileServiceContract
{
    public function put(UploadedFile $file);

    public function remove($fullFilePath);
}
