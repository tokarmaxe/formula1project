<?php
    
    
    namespace App\Components\File\Services\Strategies;

    use Intervention\Image\ImageManagerStatic as ImageManager;
    
    class Base64ReadImageStrategy implements ReadStrategyContract
    {
        
        private $path;
    
     public function __construct($path)
     {
         $this->path = $path;
     }
    
        public function get()
        {
            return ImageManager::make(storage_path($this->path))->encode('data-url');
        }
    }