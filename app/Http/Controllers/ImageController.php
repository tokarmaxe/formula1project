<?php

namespace App\Http\Controllers;

use App\Components\Image\Services\ImageServiceContract;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(Request $request, ImageServiceContract $imageService)
    {
        $files = $request->file('images');
        $result = $imageService->create($files);
        return $this->sendResponse($result);
    }
}
