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
use Carbon\Carbon;

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
            $client->addScope("profile");
            $client->addScope('email');
            $payload = $client->verifyIdToken($idToken);
            if ($payload['email']) {
                $clienEmail = $payload['email'];
                if (User::where('email', '=', $clienEmail)->exists()) {
                    $this->user = User::Where('email', '=', $clienEmail)
                        ->first();
                    if ($this->isOverdueApiToken($this->user)) {
                        $this->user->api_token = $this->user->createToken();
                        $this->user->expired_at = Carbon::now()
                            ->addDays(Config::get('services.validity.access_token'));
                        $this->user->save();
                    }
                } //user registration
                else {
                    $this->createUserFromGoogleData($payload);
                }
                return response()->json([
                    "acces_token" => "" . $this->user->api_token . "",
                ], 200);
            }
        }
    }

    public function isOverdueApiToken(UserContract $user): bool
    {

        return false;
    }

    public function createUserFromGoogleData($payload):String
    {
        $creationMessage = '';
        $data = [];
        if ($payload) {
            if ($payload['email']) {
                $data['email'] = $payload['email'];
            } else {
                $creationMessage = 'Error: incorrect email';
                return $creationMessage;
            }
            /* we don'return if theese fields are empty...
         the fields should be null = true */
            $payload['given_name'] ?
                $data['first_name'] = $payload['given_name']
                : $creationMessage .= 'Warning: First name are empty\n';
            $payload['family_name'] ?
                $data['last_name'] = $payload['family_name']
                : $creationMessage .= 'Warning: Last name are empty\n';
            $payload['picture'] ? $data['avatar'] = $payload['picture']
                : $creationMessage .= 'Warning: No avatar\n';
             //phone is skiped
          //  $data['first_name'] = 'test';
            $data['api_token'] = $this->user->createToken();
            $data['expired_at'] = Carbon::now()
                ->addDays(Config::get('services.validity.access_token'));
            $this->user = User::create($data);
        }
        return $creationMessage = 'Ok';

    }
}
