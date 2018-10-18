<?php

namespace App\Components\Image\Services;

use App\Components\File\Services\FileServiceContract;
use App\Components\Image\Models\Image;
use App\Components\Post\Models\Post;
use Intervention\Image\ImageManagerStatic as InterventionImage;
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
		foreach ($files['images'] as $file) {
			foreach ($types as $type => $typeParams) {
				$data['type'] = $type;
				$data['name'] = $file->getClientOriginalName();
				$data['post_id'] = $postId;
				$data['path'] = $this->fileService->put($file, $this->pathImages . $postId, $this->randString() . '.' . $file->getClientOriginalExtension());
				$result[] = $this->imageModel->create($data);
				$height = (array_get($typeParams, 'height') == 0) ? getimagesize($file)[1] : array_get($typeParams, 'height');
				$image = InterventionImage::make(storage_path($data['path']))->heighten($height);
				$image->save(storage_path($data['path']));
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
	public function createThumbnailSaveInTemp($files)
	{
		$paths = null;
		$tempId=$this->randString(30);
		$type = Config::get('services.types.thumbnail');
		$storagePath = Config::get('services.storage_temporary_images_path') . $tempId;
		foreach ($files['images'] as $file) {
			$path = $this->fileService->put($file, $storagePath,
				$this->randString() . '.' . $file->getClientOriginalExtension());
			$height = (array_get($type, 'height') == 0) ? getimagesize($file)[1] : array_get($type, 'height');
			$image = InterventionImage::make(storage_path($path))->heighten($height);
			$image->save(storage_path($path));
			$paths['images'][] = $path;
		}
		$paths['temp_id'] = $tempId;
		return $paths;
		
	}
	public function destroyTempSubfolder($tempId)
	{
		$storagePath = Config::get('services.storage_temporary_images_path') . $tempId . DIRECTORY_SEPARATOR;
		
		
		return ['success' => $this->fileService->removeDirectory($storagePath)];
	}
	
}

