<?php


namespace App\Components\Image\Services;


class FileService
{
    public function upload($files, $path=null)
    {
        $filenames= null;
      //  dd($path);
        foreach ($files as $file) {
            $filenames[] =basename($file->store($path));
        }
        return $filenames;
    }

}