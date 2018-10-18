<?php


namespace App\Components\Post\Services;

use App\Components\Image\Models\Image;
use App\Http\Requests\PostValidationRequest;
use App\Exceptions\PermissionDeniedException;
use App\Components\Post\Models\Post;
use Illuminate\Support\Facades\Config;
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
			return $this->post->orderBy('id', 'DESC')->with('user', 'comments')->where('category_id',
				$categoryId)->paginate(Config::get('services.pagination_items'))->toArray();
		} else {
			return $this->post->orderBy('id', 'DESC')->with('user', 'comments')->paginate(Config::get('services.pagination_items'))->toArray();
		}
	}
	
	/**
	 * @throws \HttpRequestException
	 */
	public function destroy($postId)
	{
		$this->isUserAdminOrCreator($postId);
		$this->post->findOrFail($postId)->delete();
		return ['success' => 'true'];
	}
	
	public function store($data)
	{
		return $this->post->create($data)->toArray();
	}
	
	public function update($data, $postId)
	{
		
		$this->isUserAdminOrCreator($postId);
		$this->post->findOrFail($postId)->update($data);
		return $this->post->findOrFail($postId)->toArray();
		
	}
	
	public function show($postId)
	{
		return $this->post->findOrFail($postId)->toArray();
	}
	
	private function isUserAdminOrCreator($postId)
	{
		if (!Auth::user()->is_admin && Auth::user()->id !== $this->post->findOrFail($postId)->user_id) {
			throw new PermissionDeniedException ('This action is not allowed for you!');
		}
	}
	
	
}
