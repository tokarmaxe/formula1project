<?php

namespace App\Components\User\Models;

interface UserContract
{
    public function createToken($length = 1024);

}
