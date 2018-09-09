<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Components\Category\Services\CategoryServiceContract;

class CategoryController extends Controller
{
    public function categories(CategoryServiceContract $categoryService)
    {
        return $this->sendResponse($categoryService->categories());
    }

    public function postsInCategory(CategoryServiceContract $categoryService, $categoryId)
    {
        return $this->sendResponse($categoryService->postsInCategory($categoryId));
    }
}
