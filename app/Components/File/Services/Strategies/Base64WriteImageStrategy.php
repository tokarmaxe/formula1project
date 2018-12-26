<?php


namespace App\Components\File\Services\Strategies;

use Intervention\Image\Image as InterventionImage;


class Base64WriteImageStrategy implements WriteStrategyContract
{
    
    private $image;
    
    public function __construct(InterventionImage $image)
    {
        $this->image = $image;
    }
    
    public function put($imagePath, $name)
    {
        if ((!is_dir(storage_path($imagePath))) && (!is_null($this->image))) {
            mkdir(storage_path($imagePath), 0777, true);
        }
        $fullFilePath = $imagePath . DIRECTORY_SEPARATOR . $name;
        $this->image->save(storage_path($fullFilePath));
        
        return $fullFilePath;
    }
}