<?php

namespace App\Components\User\Models;

USE App;
use App\Components\User\Services\UserContract;
use App\Components\User\Services\UserServiceContract;
use Illuminate\Http\Request as Request;
use Illuminate\Http\Response as Response;
use Laravel\Socialite\Facades\Socialite;
use Google_Client;
use Illuminate\Support\Facades\Config;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements UserContract
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'token',
        'nickname',
        'name',
        'email',
        'avatar',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function login(Request $request, Response $response)
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
            if (User::all()->find($email)) {

            }
        }
    }
}
