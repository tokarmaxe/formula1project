<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Components\User\Services\UserServiceContract;
use App;
use app\Components\User\Models\User;


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

    public function user(Request $request, UserServiceContract $userService)
    {
        $result = $userService->user($request);


        return $this->sendResponse($result);
    }
}
