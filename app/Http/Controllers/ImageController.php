<?php

namespace App\Http\Controllers;

use App\Components\Image\Services\ImageServiceContract;
use App\Http\Requests\ImageValidationRequest as Request;
use App\Http\Requests\TempImageValidationRequest as TempRequest;




class ImageController extends Controller
{
	public function upload(Request $request, ImageServiceContract $imageService)
	{
		$files = $request->allFiles();
		$result = $imageService->create($files, $request->post_id);
		return $this->sendResponse($result);
	}
	
	public function uploadToTempFolder(TempRequest $request, ImageServiceContract $imageService)
	{
		$files = $request->allFiles();
		$result = $imageService->createThumbnailSaveInTemp($files);
		return $this->sendResponse($result);
	}
	
	public function deleteFromUserFolder(ImageServiceContract $imageService, $tempId)
	{
		
		$result = $imageService->destroyTempSubfolder($tempId);
		return $this->sendResponse($result);
	}
	
	public function destroy(ImageServiceContract $imageService, $imageId)
	{
		return $this->sendResponse($imageService->destroy($imageId));
	}
}
