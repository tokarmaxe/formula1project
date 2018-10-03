<?php

namespace App\Components\Comment\Services;

interface CommentServiceContract
{
    public function store();

    public function show();

    public function update();

    public function destroy();
}
