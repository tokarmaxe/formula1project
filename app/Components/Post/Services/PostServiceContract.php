<?php

namespace App\Components\Post\Services;



interface PostServiceContract
{
    public function list($categoryId);
    public function store($data);
    public function destroy($postId);
    public function update($data, $postId);
    public function show($postId);

}
