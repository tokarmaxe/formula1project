<?php

namespace App\Components\User\Models;

use App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Components\Comment\Models\Comment;
use App\Convention\Model\Traits\IsoDateTrait;
use Carbon\Carbon;
use Auth;

class User extends Authenticatable implements UserContract
{
    use Notifiable;
    use SoftDeletes;
    use IsoDateTrait;

    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'email',
        'avatar',
        'is_admin',
        'api_token',
        'phone_number',
        'skype',
        'telegram',
        'room_location',
        'avatar',
        'expired_at',

    ];

    protected $dates = ['deleted_at'];

    public function createToken($length = 1024)
    {
        $this->api_token = \Hash::make(\random_bytes($length));
        return $this->api_token;
    }

    public function comments()
    {
        return $this->hasMany('App\Components\Comment\Models\Comment');
    }

    public function posts()
    {
        return $this->hasMany('App\Components\Post\Models\Post');
    }

    public function isAdministrator()
    {
        return Auth::user()->is_admin;
    }

    public function isCreator($commentId)
    {
        return Auth::user()->id == Comment::findOrFail($commentId)->user_id;
    }

    public function getExpiredAtAttribute($date){
        $date = new Carbon($date);
        return $date->toIso8601String();
    }
}
