<?php

namespace App\Components\Image\Services;

use App\Components\File\Services\FileService;
use App\Components\Image\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageService implements ImageServiceContract
{
    private $image;

    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    public function create($files)
    {
        $fileService = new FileService();
        return $fileService->put($files);
    }

    public function destroy()
    {
        // TODO: Implement destroy() method.
    }
}
