<?php

namespace App\Components\User\Models;

USE App;
use App\Components\User\Models\UserContract;
use App\Components\User\Services\UserServiceContract;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements UserContract
{
    use Notifiable;

    public function createToken($length = 1024)
    {
        $this->api_token = \Hash::make(\random_bytes($length));
        $this->expired_at = Carbon::now();
        return $this->api_token;
    }
    public function createUserFromGoogleData($payload)
    {
        // TODO: Implement createUserFromGoogleData() method.
    }
}
