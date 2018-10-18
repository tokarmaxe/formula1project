<?php

namespace App\Components\File\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;

class FileService implements FileServiceContract
{
    public function put(UploadedFile $file, $imagePath, $name)
    {
        return $file->storeAs($imagePath, $name);
    }

    public function remove($fullFilePath)
    {
        return Storage::disk('local')->delete($fullFilePath);
    }
	
	public function removeDirectory($path)
	{
		return Storage::deleteDirectory($path);
	}
}
