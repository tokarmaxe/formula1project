<?php

namespace App\Components\Comment\Services;

use App\Components\Comment\Models\Comment;

class CommentService implements CommentServiceContract
{
    private $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function store($data)
    {
        return $this->comment->create($data)->toArray();
    }

    public function show()
    {
        // TODO: Implement show() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function destroy()
    {
        // TODO: Implement delete() method.
    }
}
