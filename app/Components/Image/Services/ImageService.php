<?php


namespace App\Components\Image\Services;

use App\Components\Image\Models\Image;

class ImageService implements ImageServiceContract
{
    const BASE_PATH = '/images';
    private $fileServices;
    private $image;


    /**
     * ImageService constructor.
     * @param $files
     */
    public function __construct(Image $image)
    {
        $this->image = $image;
        $this->fileServices = new FileService();
    }

    public function uploadImages($files, $postId)
    {
        $path = $this::BASE_PATH . '/' . $postId;
        return $this->fileServices->upload($files['Files'], $path);

    }

    public function saveModel($imageNames, $postId)
    {
        $data = null;
        foreach ($imageNames as $imageName) {
          $data['name'] = $imageName;
            $data['post_id']= $postId;
            $data['path']= $this::BASE_PATH . '/' . $postId;
            $this->image->create($data);


        }

        return ['success' => 'true'];
    }


}