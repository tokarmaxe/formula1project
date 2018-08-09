<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
USE App;
use App\Components\User\Models\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use League\Flysystem\Config;

class UserController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function logging(Request $request)
    {
    }
}
