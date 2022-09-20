<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\front\FeaturedProductResource;
use App\Http\Resources\ProductResource;
use App\Models\FeaturedProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class FeaturedProductController extends BaseController
{
    /**
     * List
     * @group FeaturedProduct
     */
    public function list(Request $request)
    {
        $products = Product::whereHas('featuredProducts')->paginate();
        $message = "All Records";
        ProductResource::collection($products);
        return $this->sendResponse(compact('products'), $message);
    }

    /**
     * Show
     * @group FeaturedProduct
     */
    public function show(FeaturedProduct $featuredProduct, Request $request)
    {
        $message = 'Featured product listed successfully';
        $featuredProduct = new FeaturedProductResource($featuredProduct);
        return $this->sendResponse(compact('featuredProduct'), $message);
    }
}
