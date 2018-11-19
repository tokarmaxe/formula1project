<?php

namespace App\Components\File\Services;


use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image as InterventionImage;
use Intervention\Image\ImageManagerStatic as ImageManager;


class FileService implements FileServiceContract
{
    public function put(InterventionImage $file, $imagePath, $name)
    {
        if ((!is_dir(storage_path($imagePath))) && (!is_null($file))) {
            mkdir(storage_path($imagePath), 0777, true);
        }
        $fullFilePath = $imagePath . DIRECTORY_SEPARATOR . $name;
        $file->save(storage_path($fullFilePath));
        return $fullFilePath;
    }

    public function remove($fullFilePath)
    {
        return Storage::disk('local')->delete($fullFilePath);
    }

    public function get(String $imagePath)
    {
        return ImageManager::make(storage_path($imagePath))->encode('data-url');

    }
}
