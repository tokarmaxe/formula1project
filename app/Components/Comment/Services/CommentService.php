<?php

namespace App\Components\Comment\Services;

use App\Components\Comment\Models\Comment;
use App\Exceptions\PermissionDeniedException;
use Auth;

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

    public function show($commentId)
    {
        return $this->comment->findOrFail($commentId)->toArray();
    }

    public function update($data, $commentId)
    {
        $this->comment->findOrFail($commentId)->update($data);
        return $this->comment->findOrFail($commentId)->toArray();
    }

    public function destroy($commentId)
    {
        return ['success' => $this->comment->findOrFail($commentId)->delete()];
    }
}
