<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Components\User\Services\UserServiceContract;
use App;

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
        $idToken = $request->header('Authorization');
        $idToken = str_replace('Bearer ', '', $idToken);
        $result = $userService->login($idToken);
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
        $apiToken = $request->header('authorization');
        $apiToken = str_replace('Bearer ', '', $apiToken);
        return
            $this->sendResponse($userService->getUserByApiToken($apiToken));
    }

    public function getUser(UserServiceContract $userService, $userId)
    {
        return $this->sendResponse($userService->getUserById($userId));
    }
}
