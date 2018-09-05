<?php


namespace App\Components\Post\Services;


use App\Http\Requests\PostValidationRequest;


interface PostServiceContract
{
    public function list($categoryId);

    public function store(PostValidationRequest $request);

    public function destroy($postId);

    public function update(PostValidationRequest $request, $postId);

}