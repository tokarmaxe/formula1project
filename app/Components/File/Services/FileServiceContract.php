<?php

namespace App\Components\File\Services;

use Intervention\Image\Image as InterventionImage;

interface FileServiceContract
{
    public function put($file, $path, $name);

    public function remove($fullFilePath);

    public function get(String $imagePath);
}
