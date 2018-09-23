<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Components\Image\Services\ImageServiceContract;

class ImageController extends Controller
{
    public function upload(Request $request, ImageServiceContract $imageService)
    {
        $message = null;
        $filenames = $imageService->uploadImages($request->allFiles(), $request->post_id);
        if (!is_null($filenames)) {
            $message = $imageService->saveModel($filenames, $request->post_id);
        }
        return $this->sendResponse($message);

    }
}
