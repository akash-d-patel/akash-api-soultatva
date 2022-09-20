<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\front\TrendingProductResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\TrendingProduct;
use Illuminate\Http\Request;

class TrendingProductController extends BaseController
{
    /**
     * List
     * @group TrendingProduct
     */
    public function list(Request $request)
    {
        $products = Product::whereHas('trendingProducts')->paginate();
        $message = "All Records";
        ProductResource::collection($products);
        return $this->sendResponse(compact('products'), $message);
    }

    /**
     * Show
     * @group TrendingProduct
     */
    public function show(TrendingProduct $trendingProduct, Request $request)
    {
        $message = 'Trending product listed successfully';
        $trendingProduct = new TrendingProductResource($trendingProduct);
        return $this->sendResponse(compact('trendingProduct'), $message);
    }
}
