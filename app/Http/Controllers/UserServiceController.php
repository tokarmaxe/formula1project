<?php

namespace App\Http\Controllers;

use App\Components\User\Services\UserContract;
use App\Components\User\Services\UserServiceContract;
use Illuminate\Http\Request;
use App\Components\User\Models\UserService;
use App\Components\User\Models\User;
use Socialite;


class UserServiceController extends Controller
{
    public function singUpFromSocial(Request $request, UserServiceContract $userService)
    {
        $result = $userService->socialSignIn($request);





        return  $result;

    }
}
