<?php

namespace App\Convention\Model\Contracts;


interface IsoDateContract
{
    public function getCreatedAtAttribute($date);

    public function getUpdatedAtAttribute($date);

}