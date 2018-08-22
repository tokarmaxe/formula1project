<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Components\User\Services\UserServiceContract;
use App\Components\User\Models\UserContract;
USE App;


class UserController extends Controller
{
    /**
     * @param Request             $request
     * @param UserServiceContract $userService
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request, UserServiceContract $userService)
    {
        $result = $userService->login($request);
        return $this->sendResponse($result);
    }

    public function user(Request $request, UserContract $user)
    {
        $apiToken = $request->header('authorization');
        $apiToken = str_replace('Bearer ', '', $apiToken);
        return
            $this->sendResponse($user->where('api_token', $apiToken)->first()
                ->toArray());
    }
}
