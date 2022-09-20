<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    /**
     * List
     * @group Category
     */

    public function list(Request $request)
    {
        $categories = Category::with(['categoryProducts.product','creater'])->pimp()->paginate();
        $message = "All Records";
        CategoryResource::collection($categories);
        return $this->sendResponse(compact('categories'), $message);
    }

    /**
     * Show
     * @group Category
     */

    public function show($slug, Request $request, Category $category)
    {
        $category = Category::where('slug', $slug)->first();
        $category = $category->load('categoryProducts.product');
        $message = 'Category listed successfully';
        $category = new CategoryResource($category);
        return $this->sendResponse(compact('category'), $message);
    }
}
