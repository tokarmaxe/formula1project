<?php

namespace App\Components\Image\Services;

use App\Components\File\Services\FileServiceContract;
use App\Components\Image\Models\Image;
use App\Components\Post\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;


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
                $data['name'] = $file->getClientOriginalName();
                $data['post_id'] = $postId;
                $data['path'] = $this->fileService->put($file, $data['name']);
                $result[] = $this->image->create($data);
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
