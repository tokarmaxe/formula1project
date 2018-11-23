<?php


namespace App\Components\BlackMarketPost\Services;

use App\Components\BlackMarketPost\Models\BlackMarketPostContract;
use App\Exceptions\PermissionDeniedException;
use Illuminate\Support\Facades\Config;
use Auth;
use Illuminate\Support\Facades\DB;

class BlackMarketPostsService implements BlackMarketPostServiceContract
{
    private $blackMarketPost, $database;

    public function __construct(BlackMarketPostContract $blackMarketPost, DB $database)
    {
        $this->blackMarketPost = $blackMarketPost;
        $this->database = $database;
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
        $this->database::transaction(function () use ($data, &$blackPost) {
            $blackPost = $this->blackMarketPost->create($data);
        });
        return $blackPost->toArray();
    }

    public function update($data, $postId)
    {
        $this->isUserAdminOrCreator($postId);
        $this->database::transaction(function () use ($data, $postId) {
            $this->blackMarketPost->findOrFail($postId)->update($data);
        });
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