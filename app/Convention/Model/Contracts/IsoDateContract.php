<?php
/**
 * Created by PhpStorm.
 * User: sklyack
 * Date: 31.10.18
 * Time: 15:21
 */

namespace App\Convention\Model\Contracts;


interface IsoDateContract
{
    public function getCreatedAtAttribute($date);
    public function getUpdatedAtAttribute($date);

}