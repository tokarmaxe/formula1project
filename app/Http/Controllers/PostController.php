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

    public function store(/*not working.. ( */
        PostValidationRequest $request,
        PostServiceContract $postService
    ) {
        return
            $this->sendResponse($postService->store($request));
    }

    public function destroy(PostServiceContract $postService, $postId)
    {
        return
            $this->sendResponse($postService->destroy($postId));
    }

    public function update(
        PostServiceContract $postService,
        $postId,/*not working.. ( */
        PostValidationRequest $request
    ) {
        //PostValidationRequest $request = new PostValidationRequest();
        return
            $this->sendResponse($postService->update($request, $postId));
    }

    public function show($postId, PostServiceContract $postService)
    {
        return $this->sendResponse($postService->show($postId));
    }
}
