<?php

namespace App\Components\Comment\Services;

interface CommentServiceContract
{
    public function store($data);

    public function show($commentId);

    public function update();

    public function destroy();
}
