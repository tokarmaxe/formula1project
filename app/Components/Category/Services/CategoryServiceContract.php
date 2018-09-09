<?php

namespace App\Components\Category\Services;


interface CategoryServiceContract
{
    public function categories();

    public function postsInCategory($categoryId);
}
