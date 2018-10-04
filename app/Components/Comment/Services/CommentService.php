<?php

namespace App\Components\Comment\Services;

use App\Components\Comment\Models\Comment;
use App\Components\User\Models\User;
use App\Exceptions\PermissionDeniedException;
use Auth;

class CommentService implements CommentServiceContract
{
    private $comment, $user;

    public function __construct(Comment $comment, User $user)
    {
        $this->comment = $comment;
        $this->user = $user;
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
        if ($this->user->isAdministrator() || $this->user->isCreator($commentId)) {
            $this->comment->findOrFail($commentId)->update($data);
            return $this->comment->findOrFail($commentId)->toArray();
        } else {
            throw new PermissionDeniedException ('This action is not allowed for you!');
        }
    }

    public function destroy($commentId)
    {
        if ($this->user->isAdministrator() || $this->user->isCreator($commentId)) {
            return ['success' => $this->comment->findOrFail($commentId)->delete()];
        } else {
            throw new PermissionDeniedException ('This action is not allowed for you!');
        }
    }

    public function list($postId)
    {
        return $this->comment->where('post_id', $postId)->get()->toArray();
    }
}
