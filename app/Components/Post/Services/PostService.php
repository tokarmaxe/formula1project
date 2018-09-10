<?php


namespace App\Components\Post\Services;

use App\Http\Requests\PostValidationRequest;
use App\Exceptions\PermissionDeniedException;
use App\Components\Post\Models\Post;
use Auth;


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

    public function list($categoryId = null)
    {
        if (!is_null($categoryId)) {
            return $this->post->where('category_id', $categoryId)->get()->toArray();
        } else {
            return $this->post->get()->toArray();
        }
    }

    /**
     * @throws \HttpRequestException
     */
    public function destroy($postId)
    {
        $this->checkAuthorIsAdminOrCreator($postId);
        $this->post->findOrFail($postId)->delete();
        return ['success' => 'true'];
    }

    public function store(PostValidationRequest $request)
    {
        $data = $request->validated();
        return $this->post->create($data)->toArray();
    }

    public function update(PostValidationRequest $request, $postId)
    {

        $this->checkAuthorIsAdminOrCreator($postId);
        $data = $request->validated();
        $this->post->findOrFail($postId)->update($data);
        return $this->post->findOrFail($postId)->toArray();

    }

    public function show($postId)
    {
        return $this->post->findOrFail($postId)->toArray();
    }

    private function checkAuthorIsAdminOrCreator($postId)
    {
        if (!Auth::user()->is_admin && Auth::user()->id !== $this->post->findOrFail($postId)->user_id) {
            throw new PermissionDeniedException ('This action is not allowed for you!');
        }
    }


}
