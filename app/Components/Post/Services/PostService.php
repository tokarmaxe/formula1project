<?php


namespace App\Components\Post\Services;

use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    public function list($categoryId = null)
    {
        if (!is_null($categoryId)) {
            return $this->post->where('category_id', $categoryId)->get()->toArray();
        } else {
            return $this->post->get()->toArray();
        }
    }

    /**
     * @throws ModelNotFoundException
     */
    public function destroy($postId)
    {

        if (is_null($this->post->find($postId))) {
            throw new ModelNotFoundException('Could not find post by id');
        }
        $this->post->find($postId)->delete();
        return ['success' => 'true'];

    }


    public function store(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $this->validatePost($data);
        return $this->post->create($data)->toArray();
    }

    /**
     * @throws ModelNotFoundException
     */
    public function update(Request $request, $postId)
    {
        $data = json_decode($request->getContent(), true);
        $this->validatePost($data);
        $this->post = $this->post->find($postId);
        if (is_null($this->post)) {
            throw new ModelNotFoundException('Could not find post by id');
        }
        $this->post->update($data);
        return $this->post->find($postId)->toArray();

    }

    /*
     private function checkJSONToJustOneColumnBelongsToPostModel ($data) {
     //if we have just one column name in JSON - we have something to update
     $modelColums = array_keys($this->post->attributesToArray());
     foreach ($modelColums as $colum) {
         if (array_key_exists($colum, $data)) {
             return;
         }
     throw new ModelNotFoundException('Wrong JSON');
     }*/

    /**
     * @param $data - post data
     *
     * @throws ValidationExeptionException
     */
    protected function validatePost($data)
    {
        $validator = Validator::make($data, [
            'title' => 'required|min:2',
            'description' => 'required|min:2',
            'price' => 'required',
            'category_id' => 'required',
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            //  throw new ValidationExeption();
            throw new ValidationExeption('Unathorized: token_ID is incorrect!');
        }

    }


}