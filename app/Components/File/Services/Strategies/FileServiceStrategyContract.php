<?php


namespace App\Components\File\Services\Strategies;


interface FileServiceStrategyContract
{
    public function put($file, $path, $name);

    public function get($path);

}