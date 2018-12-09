<?php


namespace App\Components\File\Services\StrategiesFactories;

use App\Components\File\Services\Strategies\WriteStrategyContract;


interface WriteStrategiesFactoryContract
{
    
    public function writeStrategy(object $item): WriteStrategyContract;
}