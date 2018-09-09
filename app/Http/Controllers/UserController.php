<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Components\User\Services\UserServiceContract;
use App;
use App\Http\Requests\CreateUserRequest;



class UserController extends Controller
{

    /**
     * @param Request $request
     * @param UserServiceContract $userService
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request, UserServiceContract $userService)
    {
        $result = $userService->login($request);
        return $this->sendResponse($result);
    }

    /**
     * @param Request $request
     * @param UserServiceContract $userService
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user(Request $request, UserServiceContract $userService)
    {
        return
            $this->sendResponse($userService->getUserByApiToken($request));
    }
}
