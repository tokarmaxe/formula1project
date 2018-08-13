<?php

namespace App\Components\User\Models;

USE App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements UserContract
{
    use Notifiable;

    public function createToken($length = 1024)
    {
        $this->api_token = \Hash::make(\random_bytes($length));
        $this->Carbon::now()
            ->addDays(Config::get('services.validity.access_token'));
        return $this->api_token;
    }

    public function createUserFromGoogleData($payload)
    {
        // TODO: Implement createUserFromGoogleData() method.
    }
}
