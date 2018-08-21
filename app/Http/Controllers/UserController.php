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
//        $result = $this->login($request, $userService);
//        $result = json_decode($result['data']);
        $result = $userService->login($request);
        $user = User::where('api_token', $result['access_token'])->first()->toArray();

        return $this->sendResponse($user);
    }
}
