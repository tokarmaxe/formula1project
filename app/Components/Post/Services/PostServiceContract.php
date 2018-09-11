<?php

namespace App\Components\Post\Services;

use App\Components\Post\Models\Post;
use App\Http\Requests\PostValidationRequest;
use Illuminate\Http\Request as Request;

interface PostServiceContract
{
    public function list($categoryId);
    public function store($data);
    public function destroy($postId);
    public function update($data, $postId);
    public function show($postId);

}
