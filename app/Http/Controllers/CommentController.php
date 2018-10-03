<?php

namespace App\Http\Controllers;

use App\Components\Comment\Services\CommentServiceContract;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, CommentServiceContract $commentService)
    {
        return $this->sendResponse($commentService->store());
    }

    public function show(Request $request, CommentServiceContract $commentService)
    {
        return $this->sendResponse($commentService->show());
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
