<?php

namespace App\Components\User\Models;

use App\Convention\Model\Contracts\IsoDateContract;

interface UserContract extends IsoDateContract
{
    public function createToken($length = 1024);
    public function getExpiredAtAttribute($date);

}
