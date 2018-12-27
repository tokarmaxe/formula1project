<?php


namespace App\Components\File\Services\Strategies;


interface WriteStrategyContract
{
    
    public function put($path, $name);
    
}