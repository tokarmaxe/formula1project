<?php

namespace App\Components\User\Models;

use App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements UserContract
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'email',
        'avatar',
        'is_admin',
        'api_token',
        'phone_number',
        'avatar',
        'expired_at',

    ];


    public function createToken($length = 1024)
    {
        $this->api_token = \Hash::make(\random_bytes($length));
        return $this->api_token;
    }
}
