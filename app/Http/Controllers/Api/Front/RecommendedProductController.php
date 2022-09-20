<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\front\RecommendedProductResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\RecommendedProduct;
use Illuminate\Http\Request;

class RecommendedProductController extends BaseController
{
    /**
     * List
     * @group RecommendedProduct
     */
    public function list(Request $request)
    {
        $products = Product::whereHas('recommendedProducts')->paginate();
        $message = "All Records";
        ProductResource::collection($products);
        return $this->sendResponse(compact('products'), $message);
    }

    /**
     * Show
     * @group RecommendedProduct
     */
    public function show(RecommendedProduct $recommendedProduct, Request $request)
    {
        $message = 'Recommended product listed successfully';
        $recommendedProduct = new RecommendedProductResource($recommendedProduct);
        return $this->sendResponse(compact('recommendedProduct'), $message);
    }
}
