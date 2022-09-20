<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\RelatedProductResource;
use App\Models\Product;
use App\Models\RelatedProduct;
use Illuminate\Http\Request;

class RelatedProductController extends BaseController
{
    /**
     * List
     * @group RelatedProduct
     */
    public function list(Product $product, Request $request)
    {
        $relatedProducts = RelatedProduct::whereHas('product', function ($query) use ($product) {
            $query->where('id', $product->id);
            return $query;
        })->pimp()->paginate();
        $message = "All Records";
        RelatedProductResource::collection($relatedProducts);
        return $this->sendResponse(compact('product', 'relatedProducts'), $message);
    }
}
