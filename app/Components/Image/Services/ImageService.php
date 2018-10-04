<?php

namespace App\Components\Image\Services;

use App\Components\File\Services\FileServiceContract;
use App\Components\Image\Models\Image;
use App\Components\Post\Models\Post;
use Intervention\Image\ImageManagerStatic as InterventionImage;
use Illuminate\Support\Facades\Config;

class ImageService implements ImageServiceContract
{
    private $image;
    private $fileService;
    private $postService;
    private $pathImages;

    public function __construct(Image $image, FileServiceContract $file, Post $post)
    {
        $this->image = $image;
        $this->fileService = $file;
        $this->postService = $post;
        $this->pathImages = Config::get('services.storage_images_path');
    }

    public function create($files, $postId)
    {
        $result = null;
        $height = null;
        $types = Config::get('services.types');
        foreach ($files['images'] as $file) {
            foreach ($types as $type => $typeParams) {
                $data['type'] = $type;
                $data['name'] = $file->getClientOriginalName();
                $data['post_id'] = $postId;
                $data['path'] = $this->fileService->put($file, $this->pathImages . $postId, $this->randString() . '.' . $file->getClientOriginalExtension());
                $result[] = $this->image->create($data);
                $height = (array_get($typeParams, 'height') == 0) ? getimagesize($file)[1] : array_get($typeParams, 'height');
                $image = InterventionImage::make(storage_path($data['path']))->heighten($height);
                $image->save(storage_path($data['path']));
            }
        }
        return $result;
    }

    public function destroy($imageId)
    {
        $this->image = $this->image->find($imageId)->firstOrFail();
        $this->fileService->remove($this->image['path']);
        return ['success' => $this->image->delete()];
    }

    private function randString(int $length = 64): string
    {
        return bin2hex(random_bytes($length));
    }
}
