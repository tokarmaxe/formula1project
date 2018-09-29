<?php

namespace App\Http\Controllers;

use App\Components\Image\Services\ImageServiceContract;
use App\Http\Requests\ImageValidationRequest as Request;

class ImageController extends Controller
{
	public function upload(Request $request, ImageServiceContract $imageService)
	{
		$message = $imageService->create($request->allFiles(), $request->post_id);
		return $this->sendResponse($message);
	}
	
	public function destroy(ImageServiceContract $imageService, $imageId)
	{
		return $this->sendResponse($imageService->destroy($imageId));
	}
	
}
