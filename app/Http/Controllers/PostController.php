<?php

namespace App\Http\Controllers;

use App\Components\Post\Services\PostServiceContract;
use Illuminate\Http\Request;



class PostController extends Controller
{
    public function list(Request $request, PostServiceContract $postService)
    {

        return
            $this->sendResponse($postService->list());
    }

    public function create(Request $request, PostServiceContract $postService)
    {
        return
            $this->sendResponse($postService->create($request));
    }

}
