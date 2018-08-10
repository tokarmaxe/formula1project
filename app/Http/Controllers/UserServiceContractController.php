<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Components\User\Services\UserServiceContract;
use Socialite;

class UserServiceContractController extends Controller
{
    public function singUpFromSocial(Request $request)
    {
        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA'
        ]);
        //temporary realization: UserService model creation with strong connetion
        $userService = new UserService();
        $id_token=$request->header('Authorization');
        $id_token=str_replace("Bearer ","", $id_token);

        $userService->socialSignIn($id_token,null);

    }
}
