<?php

namespace App\Components\User\Models;

//use App\Components\User\Services\Request;
//use App\Components\User\Services\Response;
use App\Components\User\Services\UserContract;
use App\Components\User\Services\UserServiceContract;
use Illuminate\Http\Request as Request;
use Illuminate\Http\Response as Response;


class UserService implements UserServiceContract
{
    private $user;


    public function __construct(UserContract $user)
    {
        $this->user=$user;
    }

    public function socialSignIn(Request $request, Response $response = null)
    {

    }

    public function sendResponse(Request $request=null)
    {
        if (!isset($request))
        return  $this->testResponse();
    }

    public function testResponse () {
        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA'
        ]);

    }
}