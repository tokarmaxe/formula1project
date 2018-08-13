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

    /*
    1) geting Email from idToken
    2)check is email in base
    3)if in base check gets acces_token from user model and check isOVERDUE,
    if true - generate new acces_token if false - return current
    4)if user is not in base - user registration and acces_token generation
    */
    public function socialSignIn(Request $request)
    {
        $idToken = $request->header('Authorization');
        $idToken = str_replace('Beare', '', str_replace(" ", "", $idToken));
        //secure code ???
        if (isset($idToken)) {
            $googleClientID = Config::get('google.client_id');
            $client = new \Google_Client();
            $client->setDeveloperKey($googleClientID);
            //   $client->addScope("profile");
            $client->addScope('email');
            $payload = $client->verifyIdToken($idToken);
            if ($payload['email']) {
                $clienEmail = $payload['email'];
                if (User::where('email', '=', $clienEmail)->exists()) {
                    $user = User::Where('email', '=', $clienEmail)->first();
                    $currentAccessToken = $user->api_token;
                    if ($this->isOverdueApiToken($user)) {
                        $currentAccessToken = $user->createToken();
                    }
                    return response()->json([
                        "acces_token" => "" . $currentAccessToken . "",
                    ], 200);
                }
                //user creation
            }
        }
    }

    protected function isOverdueApiToken(UserContract $user): Bollean
    {
        return false;
    }
}
