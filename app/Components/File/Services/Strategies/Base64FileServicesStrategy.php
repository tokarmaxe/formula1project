<?php


namespace App\Components\File\Services\Strategies;

use Intervention\Image\ImageManagerStatic as ImageManager;


class Base64FileServicesStrategy implements FileServiceStrategyContract
{
    public function put($file, $imagePath, $name)
    {
        if ((!is_dir(storage_path($imagePath))) && (!is_null($file))) {
            mkdir(storage_path($imagePath), 0777, true);
        }
        $fullFilePath = $imagePath . DIRECTORY_SEPARATOR . $name;
        $file->save(storage_path($fullFilePath));
        return $fullFilePath;
    }

    public function get($imagePath)
    {
        return ImageManager::make(storage_path($imagePath))->encode('data-url');
    }

}