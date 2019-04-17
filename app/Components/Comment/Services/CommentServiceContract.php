<?php

namespace App\Components\Comment\Services;

interface CommentServiceContract
{
    public function store($data);

    public function show($commentId);

    public function update($data, $commentId);

    public function destroy($commentId);

    public function list($postId);
}
