<?php

namespace App\Components\User\Models;


use App\Components\User\Services\UserServiceContract;

class UserService implements UserServiceContract
{
    private $dependency;

    public function __construct(User $dependency)
    {
        $this->dependency=$dependency;
    }
}
