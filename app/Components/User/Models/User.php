<?php

namespace App\Components\User\Models;

use Illuminate\Notifications\Notifiable;
use App\Components\User\Services\UserContract as UserContract;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable implements UserContract
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];
}
