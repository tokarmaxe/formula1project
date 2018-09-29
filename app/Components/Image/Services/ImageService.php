<?php


namespace App\Components\Image\Services;

use App\Components\File\Services\FileServiceContract;
use App\Components\Image\Models\Image;
use App\Components\File\Services\FileService;
use Illuminate\Support\Facades\Config;

class ImageService implements ImageServiceContract
{
    private $imageStoragePath;
    private $fileService;
    private $image;


    /**
     * ImageService constructor.
     * @param $files
     */
    public function __construct(Image $image, FileServiceContract $fileService)
    {
        $this->image = $image;
        $this->fileService = $fileService;
        $this->imageStoragePath = Config::get('services.image_storage') . DIRECTORY_SEPARATOR;
    }

    public function create($files, $postId)
    {
        $pathToStorageDirectory = $this->imageStoragePath . $postId;
        foreach ($files['images'] as $file) {
            $data['name'] = $file->getClientOriginalName();
            $data['post_id'] = $postId;
            $data['path'] = $this->fileService->put($file, $pathToStorageDirectory);
            $result[] = $this->image->create($data);
        }
        return $result;
    }
	
	public function destroy($imageId)
    {
        $this->image = $this->image->findOrFail($imageId)->first();
        $this->fileService->remove($this->image['path']);
        return ['success' => $this->image->delete()];

    }


}