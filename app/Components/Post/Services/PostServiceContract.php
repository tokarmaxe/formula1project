<?php


namespace App\Components\Post\Services;

use Illuminate\Http\Request as Request;


interface PostServiceContract
{
    public function list($categoryId);

    public function store(Request $request);

    public function destroy($postId);

    public function update(Request $request, $postId);

}