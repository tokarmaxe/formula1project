<?php

namespace App\Components\User\Models;

use App\Components\User\Services\UserContract;
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

//    private $dependency;

//    public function __construct(UserServiceContract $dependency)
//    {
//        $this->dependency = $dependency;
//    }
}
