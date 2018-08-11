<?php

namespace App\Components\User\Services;

use App\Components\User\Models\UserContract;
use App\Components\User\Services\UserServiceContract;
use Illuminate\Http\Request as Request;
use Illuminate\Http\Response as Response;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Google_Client;
use App\Components\User\Models\User;
use Illuminate\Support\Facades\Config;

class UserService implements UserServiceContract
{
    private $user;

    public function __construct(UserContract $user)
    {
        $this->user = $user;
    }


    public function socialSignIn(Request $request)
    {
        //TODO logic
        //if something wrong throw new AuthorizationExeption

        $id_token = $request->header('Authorization');
        $id_token = str_replace("Bearer ", "", $id_token);

        $CLIENT_ID = Config::get('google.client_id');

        $apiToken = $this->user->createToken()->api_token;
        $client = Socialite::driver('google');
        $client = $client->userFromToken($apiToken);
        $client_email = $client->getEmail();

        $user = new User;

        return [
            'email' => $client_email,
        ];

    }

    public function sendResponse(Request $request, $code)
    {
        return response()->json($request, $code);
    }
}
