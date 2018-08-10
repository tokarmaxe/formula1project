<?php

namespace App\Components\User\Models;

//use App\Components\User\Services\Request;
use App\Components\User\Services\Response;
use App\Components\User\Services\UserContract;
use App\Components\User\Services\UserServiceContract;
use Illuminate\Http\Request as Request;

class UserService implements UserServiceContract
{
    private $user;


    public function __construct(UserContract $user)
    {
        $this->user=$user;
    }

    public function socialSignIn(Request $request, Response $response = null)
    {
        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA'
        ]);
    }
}