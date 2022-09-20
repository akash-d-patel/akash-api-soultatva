<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Category\CreateRequest;
use App\Http\Requests\Category\EditRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Category::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group Category
     */
    public function index(Request $request)
    {
        $categories = Category::with(['categoryProducts.product','creater'])->pimp()->paginate();
        $message = "All Records";
        CategoryResource::collection($categories);
        return $this->sendResponse(compact('categories'), $message);
    }

    /**
     * Add
     * @group Category
     */
    public function store(CreateRequest $request)
    {
        $category = Category::createUpdate(new Category, $request);
        $message = "Category added successfully";
        $category = new CategoryResource($category);
        return $this->sendResponse(compact('category'), $message);
    }

    /**
     * Show
     * @group Category
     */
    public function show(Category $category, Request $request)
    {
        $category = $category->load('categoryProducts.product');
        $message = 'Category listed successfully';
        $category = new CategoryResource($category);
        return $this->sendResponse(compact('category'), $message);
    }

    /**
     * Update
     * @group Category
     */
    public function update(EditRequest $request, Category $category)
    {
        $category = Category::createUpdate($category, $request);
        $message = "Category updated successfully";
        $category = new CategoryResource($category);
        return $this->sendResponse(compact('category'), $message);
    }

    /**
     * Delete
     * @group Category
     */
    public function destroy(Category $category, Request $request)
    {
        $category->delete();
        $message = "Category deleted successfully";
        $category = new CategoryResource($category);
        return $this->sendResponse(compact('category'), $message);
    }

    public function getCategoryList(Request $request)
    {
        $categories = Category::with(['creater'])->pimp()->get();
        $message = "All Records";
        CategoryResource::collection($categories);
        return $this->sendResponse(compact('categories'), $message);
    }
}
