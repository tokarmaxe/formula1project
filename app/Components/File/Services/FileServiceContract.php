<?php

namespace App\Components\File\Services;


use Illuminate\Http\UploadedFile;

interface FileServiceContract
{
    public function put($file);

    public function remove($fullFilePath);
}
