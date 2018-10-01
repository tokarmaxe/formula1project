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
        if ($this->postService->where('id', $postId)->exists()) {
            $result = null;

            foreach ($files['images'] as $file) {
                $data['type'] = 'full';
                $data['name'] = $data['type'].'-'.$file->getClientOriginalName();
                $data['post_id'] = $postId;
                $data['path'] = $this->fileService->put($file, $data['name']);
                $result[] = $this->image->create($data);
                $data['type'] = 'thumbnail';
                $data['name'] = $data['type'].'-'.$file->getClientOriginalName();
                $data['path'] = $this->fileService->put($file, $data['name']);
                $result[] = $this->image->create($data);
                $image = InterventionImage::make(storage_path($data['path']))->heighten(90);
                $image->save(storage_path($data['path']));
                $data['type'] = 'large';
                $data['name'] = $data['type'].'-'.$file->getClientOriginalName();
                $data['path'] = $this->fileService->put($file, $data['name']);
                $result[] = $this->image->create($data);
                $image = InterventionImage::make(storage_path($data['path']))->heighten(1200);
                $image->save(storage_path($data['path']));
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
