<?php


namespace App\Components\Post\Services;


use App\Components\Post\Models\Post;

class PostService implements PostServiceContract
{
    private $post;

    /**
     * PostService constructor.
     * @param $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }


}