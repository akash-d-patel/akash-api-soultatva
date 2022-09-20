<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\SubProductResource;
use App\Models\SubProduct;
use Illuminate\Http\Request;
use App\Http\Requests\SubProduct\CreateRequest;
use App\Http\Requests\SubProduct\EditRequest;
use App\Models\Inventory;
use App\Models\Product;

class SubProductController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(SubProduct::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group SubProduct
     */
    public function index(Product $product, Request $request)
    {
        $subProducts = SubProduct::whereHas('product', function ($query) use ($product) {
            $query->where('id', $product->id);
            return $query;
        })->pimp()->paginate();
        $message = "All Records";
        SubProductResource::collection($subProducts);
        return $this->sendResponse(compact('product', 'subProducts'), $message);
    }

    /**
     * Add
     * @group SubProduct
     */
    public function store(Product $product, SubProduct $subProduct, CreateRequest $request)
    {
        $subProduct = SubProduct::createUpdate($product, $subProduct, $request);
        $message = "Sub Product added successfully";
        $subProduct = new SubProductResource($subProduct);
        return $this->sendResponse(compact('subProduct'), $message);
    }

    /**
     * Show
     * @group SubProduct
     */
    public function show(Product $product, SubProduct $subProduct, Request $request)
    {
        $message = "Sub Product listed successfully";
        // $subProduct = $product->subProduct;
        $subProduct = new SubProductResource($subProduct);
        return $this->sendResponse(compact('subProduct'), $message);
    }

    /**
     * Update
     * @group SubProduct
     */
    public function update(Product $product, EditRequest $request, SubProduct $subProduct)
    {
        $subProduct = SubProduct::createUpdate($product, $subProduct, $request);
        $message = "Sub Product updated successfully";
        $subProduct = new SubProductResource($subProduct);
        return $this->sendResponse(compact('subProduct'), $message);
    }

    /**
     * Delete
     * @group SubProduct
     */
    public function destroy(Product $product, SubProduct $subProduct)
    {
        // $subProduct->delete();
        $product->sub_product()->find($subProduct->id)->delete();
        $inventory = Inventory::where('sub_product_id',$subProduct->id)->delete();
        $message = "Sub Product deleted successfully";
        $subProduct = new SubProductResource($subProduct);
        return $this->sendResponse(compact('subProduct'),$inventory, $message);
    }

    public function getSubProduct(Request $request)
    {
        $subProducts = SubProduct::with('creater')->pimp()->paginate();
        $message = "All Records";
        SubProductResource::collection($subProducts);
        return $this->sendResponse(compact('subProducts'), $message);
    }
}
