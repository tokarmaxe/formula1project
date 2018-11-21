<?php

namespace App\Components\Image\Services;

use App\Components\File\Services\FileServiceContract;
use App\Components\Image\Models\Image;
use Intervention\Image\ImageManagerStatic as InterventionImageStatic;
use Intervention\Image\Image as InterventionImage;
use Illuminate\Support\Facades\Config;


class ImageService implements ImageServiceContract
{
    private $imageModel;
    private $fileService;
    private $pathImages;

    public function __construct(Image $image, FileServiceContract $file)
    {
        $this->imageModel = $image;
        $this->fileService = $file;
        $this->pathImages = Config::get('services.storage_images_path');
    }

    public function create($files, $postId)
    {
        $result = null;
        $height = null;
        $types = Config::get('services.types');
        $path = $this->pathImages . $postId;
        foreach ($files as $file) {
            $extension = explode('/', $file['type'])[1];
            $data['post_id'] = $postId;
            $data['name'] = $file['name'] . '.' . $extension;
            $image = InterventionImageStatic::make($file['file']);
            foreach ($types as $type => $typeParams) {
                $data['type'] = $type;
                $image = $this->crop($image, $typeParams);
                $data['path']=$this->fileService->put($image, $path, $this->randString() . '.' . $extension);
                $result[] = $this->imageModel->create($data);
            }
        }
        return $result;
    }

    public function destroy($imageId)
    {
        $this->imageModel = $this->imageModel->findOrFail($imageId);
        $this->fileService->remove($this->imageModel['path']);
        return ['success' => $this->imageModel->delete()];
    }

    private function randString(int $length = 64): string
    {
        return bin2hex(random_bytes($length));
    }

    public function show(int $imageId){
        $this->imageModel = $this->imageModel->findOrFail($imageId);
        return ['image'=>$this->fileService->get($this->imageModel['path'])];
    }

    private function crop(InterventionImage $image, array $typeParams): InterventionImage
    {
        $height = (array_get($typeParams, 'height') == 0) ? null : array_get($typeParams, 'height');
        $width = (array_get($typeParams, 'width') == 0) ? null : array_get($typeParams, 'width');
        $originHeight = $image->height();
        $originWidth = $image->width();
        if ($originHeight > $originWidth) {
            if ((!is_null($height)) && ($height < $originHeight)) {
                $image = $image->heighten($height);
            }

        } else {
            if ((!is_null($width)) && ($width < $originWidth)) {
                $image = $image->widen($width);
            }

        }
        return $image;
    }

    public function imagesByPostId($postId)
    {
        return ['seccuess' => 'true'];
    }
}

