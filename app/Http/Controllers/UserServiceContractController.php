<?php

namespace App\Http\Controllers;

use App\Components\User\Services\UserContract;
use App\Components\User\Services\UserServiceContract;
use Illuminate\Http\Request;
use App\Components\User\Models\UserService;
use App\Components\User\Models\User;
use Socialite;

class UserServiceContractController extends Controller
{
    public function singUpFromSocial(Request $request)
    {

        $userService = new UserService(new User());
        //$id_token=$request->header('Authorization');
        //$id_token=str_replace("Bearer ","", $id_token);

      return  $userService->socialSignIn($request);

    }


    public function testProviders(UserServiceContract $user) {
            return   $user->sendResponse();

    }
}
