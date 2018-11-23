<?php

namespace App\Http\Controllers;

use App\Components\Image\Services\ImageServiceContract;
use App\Http\Requests\ImageValidationRequest as Request;


class ImageController extends Controller
{
    public function upload(Request $request, ImageServiceContract $imageService)
    {
        $result = $imageService->create($request->images, $request->post_id);
        return $this->sendResponse($result);
    }

    public function destroy(ImageServiceContract $imageService, $imageId)
    {
        return $this->sendResponse($imageService->destroy($imageId));
    }
    public function show($imageId, ImageServiceContract $imageService)
    {
        return $this->sendResponse($imageService->show($imageId));
    }

    public function imagesByPostId($postId, ImageServiceContract $imageService)
    {
        return $this->sendResponse($imageService->imagesByPostId($postId));
    }

    public function destroyImagesByPostId($postId, ImageServiceContract $imageService)
    {
        return $this->sendResponse($imageService->destroyImagesByPostId($postId));
    }
}
