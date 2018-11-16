<?php

namespace App\Convention\Model\Traits;

use Carbon\Carbon;

trait IsoDateTrait
{
    public function getCreatedAtAttribute($date)
    {
        $date = new Carbon($date);
        return $date->toIso8601String();
    }

    public function getUpdatedAtAttribute($date)
    {
        $date = new Carbon($date);
        return $date->toIso8601String();
    }

}