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

        $client = new Google_Client();

        $client->setScopes(array(
            "https://www.googleapis.com/auth/userinfo.email",
            "https://www.googleapis.com/auth/userinfo.profile",
        ));
        $client->addScope("profile");
        $client->addScope("email");

        $payload = $client->verifyIdToken($id_token);

        if ($payload) {
            if ($this->user->where('email', '=', $payload['email'])->exists()) {
                return [$this->user->api_token];
            }
            $newUser = new User();
            $newUser->first_name = $payload['given_name'];
            $newUser->last_name = $payload['family_name'];
            $newUser->avatar = $payload['picture'];
            $newUser->email = $payload['email'];
//            $newUser->phone_number=$payload['phone'];
            $date = date('Y-m-d h:i:s');
            $newUser->expired_at = $date;
            $newUser->api_token = $this->user->createToken()->api_token;
            $newUser->save();
            return [$newUser->api_token];
        } else {
            return response()->json(['failed'], 403);
        }
    }

    public function sendResponse(Request $request, $code)
    {
        return response()->json($request, $code);
    }
}
