<?php

namespace App\Components\User\Serives;


use App\Components\User\Services\UserServiceContract;
use Illuminate\Http\Request as Request;
use Illuminate\Http\Response as Response;
use Laravel\Socialite\Facades\Socialite;
use Google_Client;
use App\Components\User\Models\User;
use Illuminate\Support\Facades\Config;

class UserService implements UserServiceContract
{
    private $dependency;

    public function __construct(User $dependency)
    {
        $this->dependency = $dependency;
    }

    public function login()
    {
        function login(Request $request, Response $response)
        {
            $id_token = $request->header('Authorization');
            $id_token = str_replace("Bearer ", "", $id_token);

            $CLIENT_ID = Config::get('google.client_id');

            $email = $request->input('email');
            $name = $request->input('name');

            $client = new Google_Client();
            $client->setDeveloperKey($CLIENT_ID);
            $payload = $client->verifyIdToken($id_token);
            if ($payload) {
                if (User::where('email', '=', $email)) {
                    echo "";
                }
            }
        }
    }
}
