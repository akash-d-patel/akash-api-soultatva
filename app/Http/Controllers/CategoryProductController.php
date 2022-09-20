<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\CategoryProduct\CreateRequest;
use App\Http\Requests\CategoryProduct\EditRequest;
use App\Http\Resources\CategoryProductResource;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;

class CategoryProductController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(CategoryProduct::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group CategoryProduct
     */
    public function index()
    {
        $categoryProducts = CategoryProduct::with(['category','product','creater'])->pimp()->paginate();
        $message = "All Records"; 
        CategoryProductResource::collection($categoryProducts); 
        return $this->sendResponse(compact('categoryProducts'), $message);
    }

    /**
     * Add
     * @group CategoryProduct
     */
    public function store(CreateRequest $request)
    {
        $categoryProduct = CategoryProduct::createUpdate(new CategoryProduct, $request);
        $message = "Category product added successfully";
        $categoryProduct = new CategoryProductResource($categoryProduct);
        return $this->sendResponse(compact('categoryProduct'), $message);
    }

    /**
     * Show
     * @group CategoryProduct
     */
    public function show(CategoryProduct $categoryProduct)
    {
        $categoryProduct = $categoryProduct->load('category','product','creater');
        $message = 'Category product listed successfully';
        $categoryProduct = new CategoryProductResource($categoryProduct);
        return $this->sendResponse(compact('categoryProduct'), $message);
    }

    /**
     * Update
     * @group CategoryProduct
     */
    public function update(EditRequest $request, CategoryProduct $categoryProduct)
    {
        $categoryProduct = CategoryProduct::createUpdate($categoryProduct, $request);
        $message = "Category product updated successfully";
        $categoryProduct = new CategoryProductResource($categoryProduct);
        return $this->sendResponse(compact('categoryProduct'), $message);
    }

    /**
     * Delete
     * @group CategoryProduct
     */
    public function destroy(CategoryProduct $categoryProduct)
    {
        $categoryProduct->delete();
        $message = "Category product deleted successfully";
        $categoryProduct = new CategoryProductResource($categoryProduct);
        return $this->sendResponse(compact('categoryProduct'), $message);
    }
}
