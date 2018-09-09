<?php

namespace App\Components\Category\Services;

use App\Components\Category\Models\Category;

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

    public function postsInCategory($categoryId)
    {
        return ['asad'=>'asd'];
    }
}
