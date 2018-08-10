<?php


namespace App\Components\User\Services;

use Illuminate\Http\Request as Request;


interface UserServiceContract
{
    public function socialSignIn(Request $request, Response $response);

}