<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\RelatedProduct\CreateRequest;
use App\Http\Resources\RelatedProductResource;
use App\Models\Product;
use App\Models\RelatedProduct;
use Illuminate\Http\Request;

class RelatedProductController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(RelatedProduct::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group RelatedProduct
     */
    public function index(Product $product, Request $request)
    {
        $relatedProducts = RelatedProduct::whereHas('product', function ($query) use ($product) {
            $query->where('id', $product->id);
            return $query;
        })->pimp()->paginate();
        $message = "All Records";
        RelatedProductResource::collection($relatedProducts);
        return $this->sendResponse(compact('product', 'relatedProducts'), $message);
    }

    /**
     * Add
     * @group RelatedProduct
     */
    public function store(Product $product, RelatedProduct $relatedProduct, CreateRequest $request)
    {
        $relatedProduct = RelatedProduct::createUpdate($product, $relatedProduct, $request);
        $message = "Related Product added successfully";
        $relatedProduct = new RelatedProductResource($relatedProduct);
        return $this->sendResponse(compact('relatedProduct'), $message);
    }

    /**
     * Delete
     * @group RelatedProduct
     */
    public function destroy(Product $product, RelatedProduct $relatedProduct)
    {
        // $relatedProduct->delete();
        $product->relatedProducts()->find($relatedProduct->id)->delete();
        $message = "Related Product deleted successfully";
        $relatedProduct = new RelatedProductResource($relatedProduct);
        return $this->sendResponse(compact('relatedProduct'), $message);
    }
}
