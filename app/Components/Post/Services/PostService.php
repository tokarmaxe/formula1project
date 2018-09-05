<?php


namespace App\Components\Post\Services;


use App\Http\Requests\PostValidationRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        $this->post->findOrFail($postId)->delete();
        return ['success' => 'true'];
    }

    public function store(PostValidationRequest $request)
    {
        //working..
        $data = $request->all();
        return $this->post->create($data)->toArray();
    }

    public function update(PostValidationRequest $request, $postId)
    {
        //not wokring with new PostValdationRequest
        /*[2018-09-05 18:08:27] local.ERROR: Call to a member function call() on null {"exception":"[object] (Symfony\\Component\\Debug\\Exception\\FatalThrowableError(code: 0): Call to a member function call() on null at /var/www/vendor/laravel/framework/src/Illuminate/Foundation/Http/FormRequest.php:175)
        [stacktrace]*/
        $data = $request->validated();
        $this->post->update($data);
        return $this->post->findOrFail($postId)->toArray();

    }


}