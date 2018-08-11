<?php


namespace App\Components\User\Services;

use Illuminate\Http\Request as Request;
use Illuminate\Http\Response as Response;


interface UserServiceContract
{
    public function socialSignIn(Request $request, Response $response);


}