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
}
