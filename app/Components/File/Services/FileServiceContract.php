<?php

namespace App\Components\File\Services;


interface FileServiceContract extends \App\Components\File\Services\Strategies\FileServiceStrategyContract
{
    public function remove($fullFilePath);


}