<?php

namespace App\Components\File\Services;


use Illuminate\Support\Facades\Storage;


class FileService implements FileServiceContract
{
    private $strategyFactory;

    public function __construct(StrategyFactory $strategyFactory)
    {
        $this->strategyFactory = $strategyFactory;
    }


    public function put($file, $path, $name)
    {
        return $this->strategyFactory->createPutStrategy($file)->put($file, $path, $name);
    }

    public function remove($fullFilePath)
    {
        return Storage::disk('local')->delete($fullFilePath);
    }

    public function get(String $path)
    {
        return $this->strategyFactory->createGetBase64Strategy($path)->get($path);

    }
}
