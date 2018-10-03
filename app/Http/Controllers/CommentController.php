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

    public function show(CommentServiceContract $commentService, $commentId)
    {
        return $this->sendResponse($commentService->show($commentId));
    }

    public function update(Request $request, CommentServiceContract $commentService, $commentId)
    {
        return $this->sendResponse($commentService->update($request->validated(), $commentId));
    }

    public function destroy(Request $request, CommentServiceContract $commentService)
    {
        return $this->sendResponse($commentService->destroy());
    }
}
