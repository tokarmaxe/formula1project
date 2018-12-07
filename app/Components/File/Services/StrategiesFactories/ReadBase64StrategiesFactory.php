<?php
    
    
    namespace App\Components\File\Services\StrategiesFactories;
    
    use App\Components\File\Services\Strategies\ReadStrategyContract;
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Facades\Config;
    
    class ReadBase64StrategiesFactory implements ReadStrategiesFactoryContract
    {
        
        public function readStrategy($path): ReadStrategyContract
        {
            $instance = null;
            $instance = app(Config::get('services.fileservice_strategies.read.mime_types')[Storage::mimeType($path)],
              ['path' => $path]);
            if (!is_null($instance)) {
                return $instance;
            }
            
            
            throw new \InvalidArgumentException ('Your type is not supported to convert in Base64');
            
        }
        
        
    }