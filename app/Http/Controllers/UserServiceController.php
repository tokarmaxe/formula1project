<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Components\User\Services\UserServiceContract;
USE App;
use App\Components\User\Models\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use League\Flysystem\Config;

class UserServiceController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function singUpFromSocial(Request $request, UserServiceContract $userService)
    {
        $result = $userService->socialSignIn($request);
        return $result;
    }

}
