<?php

namespace App\Components\Post\Models;


use App\Convention\Model\Contracts\IsoDateContract;

interface PostContract extends IsoDateContract
{
    public function routeNotificationForSlack();
}