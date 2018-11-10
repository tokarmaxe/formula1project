<?php

namespace App\Http\Controllers;

use App\Components\Post\Services\PostServiceContract;
use App\Http\Requests\PostValidationRequest;

class PostController extends Controller
{


    /**
     * PostController constructor.
     */


    public function list(PostServiceContract $postService, $categoryId = null)
    {
        return
            $this->sendResponse($postService->list($categoryId));
    }

    public function store(PostValidationRequest $request, PostServiceContract $postService)
    {
        return
            $this->sendResponse($postService->store($request->validated()));
    }

    public function destroy(PostServiceContract $postService, $postId)
    {
        return
            $this->sendResponse($postService->destroy($postId));
    }

    public function update(
        PostServiceContract $postService,
        $postId,
        PostValidationRequest $request
    )
    {

        return
            $this->sendResponse($postService->update($request->validated(), $postId));
    }

    public function show($postId, PostServiceContract $postService)
    {
        return $this->sendResponse($postService->show($postId));
    }

    public function usersAds(PostServiceContract $postService, $userId)
    {
        return $this->sendResponse($postService->usersAds($userId));
    }
}
