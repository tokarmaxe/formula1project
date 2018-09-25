<?php

namespace App\Components\File\Services;


use App\Components\File\Models\File;
use Illuminate\Http\UploadedFile;

class FileService implements FileServiceContract
{
    private $file;

//    public function __construct(File $file)
//    {
//        $this->file = $file;
//    }

    public function put(UploadedFile $file)
    {
        $fullFilesPath = null;

        if (!empty($file)) {
                $fullFilesPath = $file->store('images');
        }
        return $fullFilesPath;

    }

    public function remove($fullFilePath)
    {
        // TODO: Implement remove() method.
    }
}
