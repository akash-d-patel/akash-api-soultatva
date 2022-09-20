<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\CategoryProductResource;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;

class CategoryProductController extends BaseController
{
    /**
     * List
     * @group CategoryProduct
     */
    public function list(Request $request)
    {
        $categoryProducts = CategoryProduct::with(['creater'])->pimp()->paginate();
        $message = "All Records";
        CategoryProductResource::collection($categoryProducts);
        return $this->sendResponse(compact('categoryProducts'), $message);
    }

    /**
     * Show
     * @group CategoryProduct
     */
    public function show(CategoryProduct $categoryProduct, Request $request)
    {
        $message = 'Category product listed successfully';
        $categoryProduct = new CategoryProductResource($categoryProduct);
        return $this->sendResponse(compact('categoryProduct'), $message);
    }

}
