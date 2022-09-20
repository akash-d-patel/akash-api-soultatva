<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\BaseController;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;

class ProductController extends BaseController
{

    /**
     * List
     * @group Product
     */

    public function list(Request $request)
    {
        $products = Product::with(['categoryProducts.category'])->where('status', 'Active')->pimp()->paginate();
        $message = "All Records";
        ProductResource::collection($products);
        return $this->sendResponse(compact('products'), $message);
    }

    /**
     * Show
     * @group Product
     */

    public function show($slug, Request $request, Product $product)
    {
        $product = Product::where('slug', $slug)->first();
        $product = $product->load('categoryProducts.category');
        $message = 'Product listed successfully';
        $product = new ProductResource($product);
        return $this->sendResponse(compact('product'), $message);
    }

}
