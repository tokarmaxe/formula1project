<?php

namespace App\Components\User\Models;

interface UserContract
{
    /**
     * @param int $length
     * @return $this
     * @throws \Exception
     */
    public function createToken($length = 1024);
}
