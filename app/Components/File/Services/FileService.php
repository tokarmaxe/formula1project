<?php

namespace App\Components\File\Services;

use Illuminate\Support\Facades\Storage;

class FileService implements FileServiceContract
{
    private $file;

    public function put($files)
    {
        foreach ($files as $file) {
            $fullFilesPath[] = $file->store('images');
        }
        return $fullFilesPath;
    }

    public function remove($fullFilePath)
    {
        if (Storage::disk('local')->delete($fullFilePath)) {
            return true;
        } else
            return false;
    }
}
