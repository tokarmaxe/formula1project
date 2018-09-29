<?php

namespace App\Components\Image\Services;

use App\Components\File\Services\FileService;
use App\Components\Image\Models\Image;


class ImageService implements ImageServiceContract
{
    private $image;
    private $fileService;

    public function __construct(Image $image, FileService $file)
    {
        $this->image = $image;
        $this->fileService = $file;
    }

    public function create($files, $postId)
    {
        $result = null;

        foreach ($files['images'] as $file)
        {
            $data['name']=$file->getClientOriginalName();
            $data['post_id']=$postId;
            $data['path']=$this->fileService->put($file);
            $result[] = $this->image->create($data);
        }

        return $result;
    }

    public function destroy($imageId)
    {
            $this->image = $this->image->find($imageId)->firstOrFail();
            $this->fileService->remove($this->image['path']);
            return ['success' => $this->image->delete()];

    }
}
