<?php

namespace App\Components\User\Services;

use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Request as Request;

interface UserServiceContract
{
    public function login($idToken);
    public function getUserByApiToken($apiToken);
}
