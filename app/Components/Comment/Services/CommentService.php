<?php

namespace App\Components\Comment\Services;

use App\Components\Comment\Models\Comment;
use App\Components\Post\Models\Post;
use App\Components\User\Models\User;
use App\Exceptions\PermissionDeniedException;
use Auth;
use Illuminate\Support\Facades\DB;

class CommentService implements CommentServiceContract
{
    private $comment, $user, $post, $database;

    public function __construct(Comment $comment, User $user, Post $post, DB $database)
    {
        $this->comment = $comment;
        $this->user = $user;
        $this->post = $post;
        $this->database = $database;
    }

    public function store($data)
    {
        $this->database::transaction(function () use ($data, &$comment) {
            $comment = $this->comment->create($data);
        });
        return $comment->toArray();
    }

    public function show($commentId)
    {
        return $this->comment->orderBy('created_at', 'asc')->with('user')->findOrFail($commentId)->toArray();
    }

    public function update($data, $commentId)
    {
        if ($this->user->isAdministrator()) {
            $this->database::transaction(function () use ($data, $commentId){
                $this->comment->findOrFail($commentId)->update($data);
            });
            return $this->comment->findOrFail($commentId)->toArray();
        } else {
            throw new PermissionDeniedException ('This action is not allowed for you!');
        }
    }

    public function destroy($commentId)
    {
        if ($this->user->isAdministrator()) {
            $this->database::transaction(function () use ($commentId, &$comment) {
                $comment = $this->comment->findOrFail($commentId)->delete();
            });
            return ['success' => $comment];
        } else {
            throw new PermissionDeniedException ('This action is not allowed for you!');
        }
    }

    public function list($postId)
    {
        $this->post->findOrFail($postId);
        return $this->comment->orderBy('created_at', 'asc')->with('user')->where('post_id', $postId)->get()->toArray();
    }
}
