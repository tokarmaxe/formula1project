<?php

namespace App\Components\Post\Services;

use App\Components\Post\Models\Post;
use App\Http\Requests\PostValidationRequest;
use Illuminate\Http\Request as Request;

interface PostServiceContract
{
    public function list($categoryId);
    public function store(PostValidationRequest $request);
    public function destroy($postId);
    public function update(PostValidationRequest $request, $postId);
    public function show($postId);

}
