<?php

namespace App\Components\User\Models;

use App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable implements UserContract
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'email',
        'avatar',
        'is_admin',
        'api_token',
        'phone_number',
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
}
