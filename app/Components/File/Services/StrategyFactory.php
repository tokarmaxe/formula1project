<?php


namespace App\Components\File\Services;


use App\Components\File\Services\Strategies\Base64FileServicesStrategy;
use App\Components\File\Services\Strategies\FileServiceStrategyContract;
use Illuminate\Support\Facades\Config;

class StrategyFactory
{
    public function createPutStrategy($file): FileServiceStrategyContract
    {
        if ($file instanceof \Intervention\Image\Image) {
            return new Base64FileServicesStrategy();
        }
        else{
            throw new \InvalidArgumentException ('Your type is not supported to save');
        }
    }

    public function createGetBase64Strategy($path): FileServiceStrategyContract
    {
        $info =  pathinfo(storage_path($path));
        if (in_array($info['extension'], Config::get('services.supported_image_extensions'))) {
            return new Base64FileServicesStrategy();
        }
        else{
            throw new \InvalidArgumentException ('Your type is not supported to convert in Base64');
        }
    }

}