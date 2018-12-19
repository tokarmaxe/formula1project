<?php


namespace App\Components\Post\Services;

use App\Exceptions\PermissionDeniedException;
use App\Components\Post\Models\Post;
use Illuminate\Support\Facades\Config;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Components\User\Models\User;


class PostService implements PostServiceContract
{
    
    
    private $post;
    
    private $database;
    
    /**
     * PostService constructor.
     *
     * @param $post
     */
    public function __construct(Post $post, DB $database)
    {
        $this->post     = $post;
        $this->database = $database;
    }
    
    public function list($categoryId = null)
    {
        
        if (!is_null($categoryId)) {
            return $this->post->orderBy('created_at', 'DESC')
                              ->with('user', 'comments', 'images', 'category')
                              ->where('category_id',
                                $categoryId)
                              ->paginate(Config::get('services.pagination_items'))
                              ->toArray();
        } else {
            return $this->post->orderBy('created_at', 'DESC')
                              ->with('user', 'comments', 'images', 'category')
                              ->paginate(Config::get('services.pagination_items'))
                              ->toArray();
        }
    }
    
    /**
     * @throws \HttpRequestException
     */
    public function destroy($postId)
    {
        $this->isUserAdminOrCreator($postId);
        $this->database::transaction(function () use ($postId) {
            $this->post->findOrFail($postId)->delete();
        });
        
        return ['success' => 'true'];
    }
    
    public function store($data)
    {
        $this->database::transaction(function () use ($data) {
            $this->post = $this->post->create($data);
        });
        
        
        
        return $this->post->toArray();
    }
    
    public function update($data, $postId)
    {
        $this->isUserAdminOrCreator($postId);
        $this->database::transaction(function () use ($data, $postId) {
            $this->post->findOrFail($postId)->update($data);
        });
        
        return $this->post->findOrFail($postId)->toArray();
    }
    
    public function show($postId)
    {
        return $this->post->with('user', 'comments', 'images')
                          ->findOrFail($postId)
                          ->toArray();
    }
    
    private function isUserAdminOrCreator($postId)
    {
        if (!Auth::guard('api')->user()->is_admin && Auth::guard('api')
                                                         ->user()->id !== $this->post->findOrFail($postId)->user_id) {
            throw new PermissionDeniedException ('This action is not allowed for you!');
        }
    }
    
    public function usersAds($userId)
    {
        return $this->post->orderBy('created_at', 'DESC')
                          ->where('user_id', $userId)
                          ->with('category')
                          ->paginate(Config::get('services.pagination_items'))
                          ->toArray();
    }
    
    public function search($data)
    {
        $searchedStr = $data['search'];
        
        return $this->post->orderBy('created_at', 'DESC')
                          ->with('user', 'comments', 'images', 'category')
                          ->where('title', 'LIKE', '%' . $searchedStr . '%')
                          ->paginate(Config::get('services.pagination_items'))
                          ->toArray();
        
    }
    
    public function sendToSlack(array $data)
    {
        $user = app(\App\Components\User\Models\UserContract::class)->find($data['user_id']);
        
        $user = $user->first_name.' '.$user->last_name;
    
        $sendData['title'] = 'A new adv has been created';
        $sendData['content']=[
          'Title:' => $data['title'],
          'User:' => $user
        ];
        $this->post->notify(app(\App\Notifications\NotifyToSlackChannel::class, ['data'=>$sendData]));
        
    }
    
    
}
