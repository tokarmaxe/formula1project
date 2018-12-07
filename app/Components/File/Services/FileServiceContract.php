<?php

namespace App\Components\File\Services;


interface FileServiceContract
{
    public function put ($file,$path,$name);
    public function remove($fullFilePath);
    public function get(string $path);


}