<?php


namespace App\Components\File\Services;

use Illuminate\Support\Facades\Storage;


class FileService implements FileServiceContract
{
	public function put($file, $path)
	{
		$filename = $file->store($path);
		return $filename;
	}
	
	public function remove($fullFilePath)
	{
		return Storage::disk('local')->delete($fullFilePath);
	}
	
	
}