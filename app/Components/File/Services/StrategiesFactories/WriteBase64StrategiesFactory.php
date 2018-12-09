<?php


namespace App\Components\File\Services\StrategiesFactories;

use App\Components\File\Services\Strategies\WriteStrategyContract;
use Illuminate\Support\Facades\Config;

class WriteBase64StrategiesFactory implements WriteStrategiesFactoryContract
{
    
    public function writeStrategy(object $item): WriteStrategyContract
    {
        $instance = null;
        $instance = app(Config::get('services.fileservice_strategies.write')[get_class($item)],
          ['image' => $item]);
        if (!is_null($instance)) {
            return $instance;
        }
        
        
        throw new \InvalidArgumentException ('Your type is not supported');
    }
}