<?php

namespace App\Components\User\Serives;


use App\Components\User\Services\UserContract;
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
        $email = $request->input('email');
        $name = $request->input('name');
        $client = new Google_Client();
        $client->setDeveloperKey($CLIENT_ID);
        $payload = $client->verifyIdToken($id_token);
        if ($payload) {
            if ($this->user->where('email', '=', $email)) {
                echo "";
            }
        }
        $accessToken = $this->user->createToken('access_token')->accessToken;
        return [
            'access_token' => $accessToken,
            ''
        ];
    }

    public function login(Request $request, Response $response)
    {

    }
}
