<?php

namespace App\Components\User\Services;

use App\Components\User\Models\User;
use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;
use Illuminate\Auth\AuthenticationException;

class UserService implements UserServiceContract
{
    /**
     * @var User
     */
    private $user;

    /**
     * UserService constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param Request $request
     * @return array
     * @throws AuthenticationException
     */
    public function login(Request $request)
    {
        $idToken = $request->header('Authorization');
        $idToken = str_replace('Bearer ', '', $idToken);

        if (empty ($idToken)) {
            throw new AuthenticationException('Unathorized: token_ID is incorrect!');
        }
        $client = new \Google_Client();

        $client->setDeveloperKey(Config::get('google.client_id'));

        $payload = $client->verifyIdToken($idToken);
        $this->checkPayloadEmail($payload);

        $clientEmail = $payload['email'];
        if ($this->user->where('email', $clientEmail)->exists()) {
            $this->user = $this->user->where('email', $clientEmail)
                ->first();
        } else {
            $this->user = $this->createUserFromGoogleData($payload);
        }

        return [
            'access_token' => $this->user->api_token,
        ];
    }

    /**
     * @param $payload
     * @throws AuthenticationException
     */
    private function checkPayloadEmail($payload)
    {
        //TODO array with allowed email domains '@provectus.com' + all emails from Baraholka doc
        $row = explode('@', $payload['email']);
        if (!(in_array($row[1], Config::get('services.allowed_email_domains')))) {
            if (!(in_array($row[0], Config::get('services.allowed_emails')))) {
                throw new AuthenticationException('E-mail domain is not allowed');
            }
        }
    }


    /**
     * @param $payload
     * @return User
     * @throws AuthenticationException
     */
    public function createUserFromGoogleData($payload): User
    {
        $this->checkPayloadEmail($payload);

        $data = [
            'email' => array_get($payload, 'email', ''),
            'first_name' => array_get($payload, 'given_name', ''),
            'last_name' => array_get($payload, 'family_name', ''),
            'avatar' => array_get($payload, 'picture', ''),
            'api_token' => $this->user->createToken(),
            'expired_at' => Carbon::now()
                ->addDays(Config::get('services.validity.access_token')),
        ];

        return $this->user->create($data);
    }

    public function user(Request $request)
    {
        $access_token = $request->header('Authorization');
        $access_token = str_replace('Bearer ', '', $access_token);
        if (is_null($user = User::where('api_token', $access_token)->first())) {
                throw new AuthenticationException('User has not found!');
        }
        $user = User::where('api_token', $access_token)->first()->toArray();

        return $user;
    }
}
