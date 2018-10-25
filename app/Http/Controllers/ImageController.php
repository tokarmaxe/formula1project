<?php

namespace App\Http\Controllers;

use App\Components\Image\Services\ImageServiceContract;
use App\Http\Requests\ImageValidationRequest as Request;


class ImageController extends Controller
{
    public function upload(Request $request, ImageServiceContract $imageService)
    {
        $result = $imageService->createFromBase64($request->images, $request->post_id);
        return $this->sendResponse($result);
    }

    public function destroy(ImageServiceContract $imageService, $imageId)
    {
        return $this->sendResponse($imageService->destroy($imageId));
    }
}
