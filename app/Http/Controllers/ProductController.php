<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Product\CreateRequest;
use App\Http\Requests\Product\EditRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;

class ProductController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Product::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group Product
     */
    public function index(Request $request)
    {
        $products = Product::with(['categoryProducts.category','creater'])->pimp()->paginate();
        $message = "All Records";
        ProductResource::collection($products);
        return $this->sendResponse(compact('products'), $message);
    }

    /**
     * Add
     * @group Product
     */
    public function store(CreateRequest $request)
    {
        $product = Product::createUpdate(new Product, $request);
        $message = "Product added successfully";
        $product = new ProductResource($product);
        return $this->sendResponse(compact('product'), $message);
    }

    /**
     * Show
     * @group Product
     */
    public function show(Product $product, Request $request)
    {
        $product = $product->load('categoryProducts.category');
        $message = 'Product listed successfully';
        $product = new ProductResource($product);
        return $this->sendResponse(compact('product'), $message);
    }

    /**
     * Update
     * @group Product
     */
    public function update(EditRequest $request, Product $product)
    {
        $product = Product::createUpdate($product, $request);
        $message = "Product updated successfully";
        $product = new ProductResource($product);
        return $this->sendResponse(compact('product'), $message);
    }

    /**
     * Delete
     * @group Product
     */
    public function destroy(Product $product, Request $request)
    {
        $product->delete();
        $message = "Product deleted successfully";
        $product = new ProductResource($product);
        return $this->sendResponse(compact('product'), $message);
    }

    /**
     * Product List
     * @group Product
     */
    public function getProductList(Request $request)
    {
        $products = Product::with('creater')->pimp()->get();
        $message = "All Records";
        ProductResource::collection($products);
        return $this->sendResponse(compact('products'), $message);
    }
}
