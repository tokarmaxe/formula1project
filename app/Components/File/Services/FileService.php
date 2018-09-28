<?php

namespace App\Components\File\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService implements FileServiceContract
{
    public function put(UploadedFile $file)
    {
        return $file->store('images');
    }

    public function remove($fullFilePath)
    {
        return Storage::disk('local')->delete($fullFilePath);
    }
}
