<?php

namespace App\Components\User\Services;

use App\Components\User\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;
use Illuminate\Auth\AuthenticationException;
use App\Exceptions\PermissionDeniedException;
use Auth;
use GuzzleHttp\Client;

class UserService implements UserServiceContract
{
    /**
     * @var User
     */
    private $user;
    private $database;

    /**
     * UserService constructor.
     *
     * @param User $user
     */
    public function __construct(User $user, DB $database)
    {
        $this->user = $user;
        $this->database = $database;
    }

    /**
     * @param Request $request
     *
     * @return array
     * @throws AuthenticationException
     */
    public function login($idToken)
    {
        if ($idToken == 'Bearer')
            $idToken = null;

        if (empty ($idToken)) {
            throw new AuthenticationException('token_ID is empty!');
        }

        $client = new \Google_Client();

        $client->setDeveloperKey(Config::get('google.client_id'));

        if ($payload = $client->verifyIdToken($idToken)) {

            $this->checkPayloadEmail($payload);

            $clientEmail = $payload['email'];
            if ($this->user->where('email', $clientEmail)->exists()) {
                $this->user = $this->user->where('email', $clientEmail)
                    ->first();
                $this->user->api_token = $this->user->createToken();
                $this->user->expired_at = Carbon::now()
                    ->addDays(Config::get('services.validity.access_token'));
                if (!is_null($payload['picture'])) {
                    if (is_null($this->user->avatar)) {
                        $this->user->avatar = $payload['picture'];
                    } elseif ($this->user->avatar != $payload['picture']) {
                        $this->user->avatar = $payload['picture'];
                    }
                }
                if(!is_null($payload['email'])) {
                    if(is_null($this->user->slack)){
                        $this->user->slack = $this->createSlackLink(array_get($payload, 'email', ''));
                    }
                }
                $this->database::transaction(function () {
                    $this->user->save();
                });
            } else {
                $this->database::transaction(function () use ($payload) {
                    $this->user = $this->createUserFromGoogleData($payload);
                });
            }

            return [
                'access_token' => $this->user->api_token,
            ];
        }
        throw new AuthenticationException('token_ID is incorrect!');
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
            'slack' => $this->createSlackLink(array_get($payload, 'email', '')),
        ];
        $this->database::transaction(function () use($data) {
            $this->user->create($data);
        });

        return $this->user;
    }

    private function createSlackLink($email)
    {
        if(!is_null($email)) {
            $slack = new Client();
            $response = $slack->post(
                'https://slack.com/api/users.lookupByEmail',
                array(
                    'form_params' => array(
                        'email' => $email,
                        'token' => Config::get('services.slackBotAccessToken'),
                    )
                )
            )->getBody()->getContents();

            $response = (array)json_decode($response, true);

            if($response['ok'] === true)  return "slack://user?team=" . $response['user']['team_id'] . "&id=" . $response['user']['id'];
            else return null;
        }
    }

    public function getUserByApiToken($apiToken)
    {
        $user = $this->user->where('api_token', $apiToken)->first();
        if (is_null($user)) {
            throw new AuthenticationException('User has not found!');
        }
        return $user->toArray();
    }

    public function getUserById($id)
    {
        return $this->user->where('id', $id)->select(array('id', 'first_name', 'last_name', 'avatar', 'skype', 'phone_number', 'room_location', 'telegram'))->firstOrFail()->toArray();
    }

    public function update($data, $userId)
    {
        if ($this->user->isAdministrator() || Auth::guard('api')->user()->id == User::findOrFail($userId)->id) {
            $this->database::transaction(function () use ($data, $userId) {
                $this->user->findOrFail($userId)->update($data);
            });
            return $this->user->findOrFail($userId)->toArray();
        } else {
            throw new PermissionDeniedException ('This action is not allowed for you!');
        }
    }

    public function logOut($userId)
    {
        $user = $this->user->findOrFail($userId);
        $user->api_token = null;
        $user->save();
        return ['success' => 'true'];
    }
}
