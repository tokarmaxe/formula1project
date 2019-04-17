<?php

namespace App\Components\File\Services;


use App\Components\File\Services\StrategiesFactories\WriteStrategiesFactoryContract;
use App\Components\File\Services\StrategiesFactories\ReadStrategiesFactoryContract;
use Illuminate\Support\Facades\Storage;


class FileService implements FileServiceContract
{
    
    private $readStrategyFactory;
    
    private $writeStrategyFactory;
    
    
    public function __construct(
      ReadStrategiesFactoryContract $readStrategyFactory,
      WriteStrategiesFactoryContract $writeStrategyFactory
    ) {
        $this->readStrategyFactory  = $readStrategyFactory;
        $this->writeStrategyFactory = $writeStrategyFactory;
    }
    
    
    public function put($file, $path, $name)
    {
        return $this->writeStrategyFactory->writeStrategy($file)
                                          ->put($path, $name);
    }
    
    public function remove($fullFilePath)
    {
        return Storage::disk('local')->delete($fullFilePath);
    }
    
    public function get(string $path)
    {
        return $this->readStrategyFactory->readStrategy($path)->get();
    }
}
