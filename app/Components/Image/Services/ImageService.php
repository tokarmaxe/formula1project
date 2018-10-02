<?php

namespace App\Components\Image\Services;

use App\Components\File\Services\FileServiceContract;
use App\Components\Image\Models\Image;
use App\Components\Post\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Intervention\Image\ImageManagerStatic as InterventionImage;
use Illuminate\Support\Facades\Config;

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
        if ($this->postService->where('id', $postId)->exists()) {
            $result = null;
            $height = null;
            $types = Config::get('services.types');
            foreach ($files['images'] as $file) {
                $count = 0;
                foreach ($types as $type => $typeParams) {
                    $data['type'] = array_keys($types)[$count++];
                    $data['name'] = $data['type'] . '-' . $file->getClientOriginalName();
                    $data['post_id'] = $postId;
                    $data['path'] = $this->fileService->put($file, $data['name']);
                    $result[] = $this->image->create($data);
                    $height = (array_get($typeParams, 'height') == 0) ? getimagesize($file)[1] : array_get($typeParams, 'height');
                    $image = InterventionImage::make(storage_path($data['path']))->heighten($height);
                    $image->save(storage_path($data['path']));
                }
            }
            return $result;
        }
        throw new ModelNotFoundException('That post does not exist');
    }

    public function destroy($imageId)
    {
        $this->image = $this->image->find($imageId)->firstOrFail();
        $this->fileService->remove($this->image['path']);
        return ['success' => $this->image->delete()];

    }
}
