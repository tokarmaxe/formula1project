<?php


namespace App\Components\Post\Services;

use Illuminate\Http\Request as Request;
use App\Components\Post\Models\Post;
use App\Exceptions\ValidationExeption;
use Validator;

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

    public function list()
    {

        return $this->post->get()->toArray();
    }


    public function create(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $validator = Validator::make($data, [
            'title' => 'required|min:2',
            'description' => 'required|min:2',
            'price' => 'required',
            'category_id' => 'required',
            'user_id'=>'required'
        ]);

        if ($validator->fails()) {
          //  throw new ValidationExeption();
            throw new ValidationExeption('Unathorized: token_ID is incorrect!');
        }

        return $this->post->create($data)->toArray();
    }
}