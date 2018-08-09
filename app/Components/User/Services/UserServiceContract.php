<?php
/**
 * Created by PhpStorm.
 * User: sklyack
 * Date: 09.08.18
 * Time: 21:30
 */

namespace App\Components\User\Services;


interface UserServiceContract
{
    public function socialSignIn(Request $request, Response $response);

}