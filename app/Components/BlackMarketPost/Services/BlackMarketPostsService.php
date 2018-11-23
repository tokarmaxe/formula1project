<?php


namespace App\Components\BlackMarketPost\Services;

use App\Components\BlackMarketPost\Models\BlackMarketPostContract;
use App\Exceptions\PermissionDeniedException;
use Illuminate\Support\Facades\Config;
use Auth;

class BlackMarketPostsService implements BlackMarketPostServiceContract
{
    private $blackMarketPost;

    public function __construct(BlackMarketPostContract $blackMarketPost)
    {
        $this->blackMarketPost = $blackMarketPost;
    }

    public function list()
    {
        return $this->blackMarketPost->orderBy('created_at',
            'DESC')->with('user')->paginate(Config::get('services.pagination_items'))->toArray();

    }

    public function destroy($postId)
    {
        $this->isUserAdminOrCreator($postId);
        $this->blackMarketPost->findOrFail($postId)->delete();
        return ['success' => 'true'];
    }

    public function store($data)
    {
        return $this->blackMarketPost->create($data)->toArray();
    }

    public function update($data, $postId)
    {
        $this->isUserAdminOrCreator($postId);
        $this->blackMarketPost->findOrFail($postId)->update($data);
        return $this->blackMarketPost->findOrFail($postId)->toArray();
    }

    public function usersAds($userId)
    {
        return $this->blackMarketPost->orderBy('created_at', 'DESC')->where('user_id',
            $userId)->paginate(Config::get('services.pagination_items'))->toArray();
    }

    private function isUserAdminOrCreator($postId)
    {
        if (!Auth::guard('api')->user()->is_admin && Auth::guard('api')->user()->id !== $this->post->findOrFail($postId)->user_id) {
            throw new PermissionDeniedException ('This action is not allowed for you!');
        }
    }

    public function show($postId)
    {
        return $this->blackMarketPost->with('user')->findOrFail($postId)->toArray();
    }


}