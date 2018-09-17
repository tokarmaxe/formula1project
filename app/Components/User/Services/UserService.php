<?php

namespace App\Components\User\Services;


use App\Components\User\Models\User;
use App\Http\Requests\CreateUserRequest;
use http\Env\Response;
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
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param Request $request
     *
     * @return array
     * @throws AuthenticationException
     */
    public function login($idToken)
    {

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
            $this->user->api_token = $this->user->createToken();
            $this->user->expired_at = Carbon::now()
                ->addDays(Config::get('services.validity.access_token'));
            $this->user->save();
            if (!is_null($payload['picture'])) {
                if (is_null($this->user->avatar)) {
                    $this->user->avatar = $payload['picture'];
                    $this->user->save();
                }
            }
        } else {
            $this->user = $this->createUserFromGoogleData($payload);
        }

        return [
            'access_token' => $this->user->api_token,
        ];
    }

    /**
     * @param $payload
     *
     * @throws AuthenticationException
     */
    private function checkPayloadEmail($payload)
    {
        $userEmail = array_get($payload, 'email');
        $row = explode('@', $userEmail);
        if (!(in_array($row[1],
                Config::get('services.allowed_email_domains'))
            || in_array($userEmail,
                Config::get('services.admin_emails')))

        ) {
            throw new AuthenticationException('E-mail domain is not allowed');
        }
    }


    /**
     * @param $payload
     *
     * @return User
     * @throws AuthenticationException
     */
    protected function createUserFromGoogleData($payload): User
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

    /**
     * @param Request $request
     * gets apiToken from header: 'Bearer apiToken
     *
     * @return user->toArray()
     * @throws AuthenticationException
     */

    public function getUserByApiToken($apiToken)
    {
        $user = $this->user->where('api_token', $apiToken)->first();
        if (is_null($user)) {
            throw new AuthenticationException('User has not found!');
        }
        return $user->toArray();
    }
}
