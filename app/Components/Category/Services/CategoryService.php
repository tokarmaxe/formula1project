<?php

namespace App\Components\Category\Services;

use App\Components\Category\Models\Category;
use App\Components\Post\Models\Post;

class CategoryService implements CategoryServiceContract
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function categories()
    {
        return $this->category->all()->toArray();
    }
}
