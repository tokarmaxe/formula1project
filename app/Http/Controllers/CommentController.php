<?php

namespace App\Http\Controllers;

use App\Components\Comment\Services\CommentServiceContract;
use App\Http\Requests\CommentValidationRequest as Request;

class CommentController extends Controller
{
    public function store(Request $request, CommentServiceContract $commentService)
    {
        return $this->sendResponse($commentService->store($request->validated()));
    }

    public function show($commentId, CommentServiceContract $commentService)
    {
        return $this->sendResponse($commentService->show($commentId));
    }

    public function update(Request $request, CommentServiceContract $commentService)
    {
        return $this->sendResponse($commentService->update());
    }

    public function destroy(Request $request, CommentServiceContract $commentService)
    {
        return $this->sendResponse($commentService->destroy());
    }
}
