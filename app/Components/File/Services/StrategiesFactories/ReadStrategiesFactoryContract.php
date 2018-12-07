<?php
    
    
    namespace App\Components\File\Services\StrategiesFactories;
    
    use App\Components\File\Services\Strategies\ReadStrategyContract;
    
    interface ReadStrategiesFactoryContract
    {
        
        public function readStrategy($path): ReadStrategyContract;
    }