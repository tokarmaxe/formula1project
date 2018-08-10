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
    public function singUpFromSocial(Request $request, UserServiceContract $userService)
    {

   
        //$id_token=$request->header('Authorization');
        //$id_token=str_replace("Bearer ","", $id_token);

      return  $userService->sendResponse();

    }


    public function testProviders(UserServiceContract $user) {
            return   $user->sendResponse();

    }
}
