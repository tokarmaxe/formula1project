<?php

namespace App\Http\Controllers\Auth;

use App\Components\User\Models\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Components\User\Services\UserServiceContract;
use Socialite;




class UserServiceContractController extends Controller
{
    public function singUpFromSocial(Request $request)
    {
        //temporary realization: UserService model creation with strong connetion
        $userService = new UserService();
        $id_token=$request->header('Authorization');
        $id_token=str_replace("Bearer ","", $id_token);

        $userService->socialSignIn($id_token,null);

    }


}