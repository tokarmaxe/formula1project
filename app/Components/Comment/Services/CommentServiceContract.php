<?php

namespace App\Components\Comment\Services;

interface CommentServiceContract
{
    public function store($data);

    public function show();

    public function update();

    public function destroy();
}
