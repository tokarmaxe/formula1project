<?php

namespace App\Components\Image\Services;

use App\Components\File\Services\FileService;
use App\Components\Image\Models\Image;


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
            $filePath = explode(DIRECTORY_SEPARATOR, $filePath);
            $data['name'] = $filePath[1];
            $data['post_id'] = $postId;
            $data['path'] = $filePath[0] . '/' . $filePath[1];
            $result[] = $this->image->create($data);
        }

        return $result;
    }

    public function destroy($imageId)
    {
        if ($this->image->findOrFail($imageId)) {
            $this->image = $this->image->findOrFail($imageId)->first();
            $this->fileService->remove($this->image['path']);
            $this->image->delete();
            return ['success' => 'true'];
        }
        return ['success' => 'false'];
    }
}
