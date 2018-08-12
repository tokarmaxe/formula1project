<?php

namespace App\Components\User\Models;

USE App;
use App\Components\User\Models\UserContract;
use App\Components\User\Services\UserServiceContract;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements UserContract
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'token',
        'nickname',
        'name',
        'email',
        'avatar',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @inheritdoc
     */
    public function createToken($length = 1024)
    {
        $this->api_token = \Hash::make(\random_bytes($length));
        return $this;
    }
}
