<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Components\User\Services\UserServiceContract;
USE App;


class UserController extends Controller
{
    /**
     * @param Request $request
     * @param UserServiceContract $userService
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request, UserServiceContract $userService)
    {
        $result = $userService->login($request);

        return $this->sendResponse($result);
    }

    public function user()
    {
        dd('hello');
        return $this->sendResponse(['some data']);
    }
}
