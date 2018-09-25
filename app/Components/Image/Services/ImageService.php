<?php

namespace App\Components\Image\Services;

use App\Components\File\Services\FileService;
use App\Components\Image\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageService implements ImageServiceContract
{
    private $image;
    private $fileService;

    public function __construct(Image $image)
    {
        $this->image = $image;
        $this->fileService = new FileService();
    }

    public function create($files, $postId)
    {
        $filesPathes = $this->fileService->put($files['images']);
        $result = null;
        foreach ($filesPathes as $filePath) {
            $filePath = explode("/", $filePath);
            $data['name'] = $filePath[1];
            $data['post_id'] = $postId;
            $data['path'] = $filePath[0].'/'.$filePath[1];
            $result[] = $this->image->create($data);
        }

        return $result;
    }

    public function destroy()
    {
        // TODO: Implement destroy() method.
    }
}
