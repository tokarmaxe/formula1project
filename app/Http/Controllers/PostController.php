<?php

namespace App\Http\Controllers;

use App\Components\Post\Services\PostServiceContract;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function list(PostServiceContract $postService, $categoryId = null)
    {
        return
            $this->sendResponse($postService->list($categoryId));
    }

    public function store(Request $request, PostServiceContract $postService)
    {
        return
            $this->sendResponse($postService->store($request));
    }

    public function destroy(PostServiceContract $postService, $postId)
    {
        return
            $this->sendResponse($postService->destroy($postId));
    }
    public function update (Request $request, PostServiceContract $postService, $postId) {
        return
            $this->sendResponse($postService->update($request,$postId));
    }

}
