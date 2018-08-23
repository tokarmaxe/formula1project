<?php

namespace App\Components\User\Services;

use Illuminate\Http\Request as Request;

interface UserServiceContract
{
    public function login(Request $request);
    public function getUserByApiToken(Request $request);
}
