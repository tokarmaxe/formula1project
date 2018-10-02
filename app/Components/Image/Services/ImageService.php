<?php

namespace App\Components\Image\Services;

use App\Components\File\Services\FileServiceContract;
use App\Components\Image\Models\Image;
use App\Components\Post\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Intervention\Image\ImageManagerStatic as InterventionImage;

class ImageService implements ImageServiceContract
{
    private $image;
    private $fileService;
    private $postService;

    public function __construct(Image $image, FileServiceContract $file, Post $post)
    {
        $this->image = $image;
        $this->fileService = $file;
        $this->postService = $post;
    }

    public function create($files, $postId)
    {
        if ($post = $this->postService->firstOrFail($postId)) {
            $result = null;
            $height = null;
            $types = ['full', 'large', 'thumbnail'];
            foreach ($files['images'] as $file) {
                foreach ($types as $type) {
                    $data['type'] = $type;
                    $data['name'] = $data['type'] . '-' . $file->getClientOriginalName();
                    $data['post_id'] = $postId;
                    $data['path'] = $this->fileService->put($file, $data['name']);
                    $result[] = $this->image->create($data);
                    if ($type == 'large') {
                        $height = 1200;
                    } elseif ($type == 'thumbnail') {
                        $height = 90;
                    } else {
                        $height = getimagesize($file)[1];
                    }
                    $image = InterventionImage::make(storage_path($data['path']))->heighten($height);
                    $image->save(storage_path($data['path']));
                }
            }
            return $result;
        }
    }

    public function destroy($imageId)
    {
        $this->image = $this->image->find($imageId)->firstOrFail();
        $this->fileService->remove($this->image['path']);
        return ['success' => $this->image->delete()];

    }
}
