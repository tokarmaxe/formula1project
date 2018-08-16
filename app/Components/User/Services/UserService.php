<?php

namespace App\Components\User\Services;

use App\Components\User\Models\UserContract;
use App\Components\User\Services\UserServiceContract;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Http\Request as Request;
use Illuminate\Http\Response as Response;
use Google_Client;
use App\Components\User\Models\User;
use Illuminate\Support\Facades\Validator;

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

        $client = new Google_Client();

        $payload = $client->verifyIdToken($id_token);

        try {
            if (!empty($payload['email'])) {
                if ($this->user->where('email', $payload['email'])->exists()) {
                    $existedUser = $this->user->where('email', $payload['email'])->first();
                    $existedUser->expired_at = date('Y-m-d h:i:s');
                    $existedUser->api_token = $this->user->createToken()->api_token;
                    $existedUser->save();
                    $this->user = $existedUser;
                } else {
                    if ($this->emailValidate([$payload['email']])) {
                        $newUser = $this->createUserFromGoogleData($payload);
                        $this->user = $newUser;
                    } else {
                        throw new AuthenticationException('Email is not available');
                    }
                }
            } else {
                throw new AuthenticationException('Authentication error');
            }
        } catch (\Exception $exception) {
        }
        return ['access_token' => $this->user->api_token];
//        return $payload;
    }

    public function createUserFromGoogleData($payload): User
    {
        $newUser = new User();
        $newUser->first_name = $payload['given_name'];
        $newUser->last_name = $payload['family_name'];
        $newUser->avatar = $payload['picture'];
        $newUser->email = $payload['email'];
        $date = date('Y-m-d h:i:s');
        $newUser->expired_at = $date;
        $newUser->api_token = $this->user->createToken()->api_token;
        $newUser->save();
        return $newUser;
    }

    private function emailValidate($email)
    {
        return Validator::make($email, [
            'email' => 'required|email|max:255|unique:users|regex:/(.*)@provectus.com$/i'
        ]);
    }

}
