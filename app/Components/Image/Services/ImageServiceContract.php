<?php


namespace App\Components\Image\Services;


interface ImageServiceContract
{
	public function create($files, $postId);
	
	public function destroy($imageId);
	
}