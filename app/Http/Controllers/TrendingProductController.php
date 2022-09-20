<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\TrendingProduct\CreateRequest;
use App\Http\Requests\TrendingProduct\EditRequest;
use App\Http\Resources\TrendingProductResource;
use App\Models\TrendingProduct;
use Illuminate\Http\Request;

class TrendingProductController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(TrendingProduct::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group TrendingProduct
     */
    public function index()
    {
        $trendingProducts = TrendingProduct::with(['creater'])->pimp()->paginate();
        $message = "All Records";
        TrendingProductResource::collection($trendingProducts);
        return $this->sendResponse(compact('trendingProducts'), $message);
    }

    /**
     * Add
     * @group TrendingProduct
     */
    public function store(CreateRequest $request)
    {
        $trendingProduct = TrendingProduct::createUpdate(new TrendingProduct, $request);
        $message = "Trending product added successfully";
        $trendingProduct = new TrendingProductResource($trendingProduct);
        return $this->sendResponse(compact('trendingProduct'), $message);
    }

    /**
     * Show
     * @group TrendingProduct
     */
    public function show(TrendingProduct $trendingProduct)
    {
        $message = 'Trending product listed successfully';
        $trendingProduct = new TrendingProductResource($trendingProduct);
        return $this->sendResponse(compact('trendingProduct'), $message);
    }

    /**
     * Update
     * @group TrendingProduct
     */
    public function update(EditRequest $request, TrendingProduct $trendingProduct)
    {
        $trendingProduct = TrendingProduct::createUpdate($trendingProduct, $request);
        $message = "Trending product updated successfully";
        $trendingProduct = new TrendingProductResource($trendingProduct);
        return $this->sendResponse(compact('trendingProduct'), $message);
    }

    /**
     * Delete
     * @group TrendingProduct
     */
    public function destroy(TrendingProduct $trendingProduct)
    {
        $trendingProduct->delete();
        $message = "Recommended product deleted successfully";
        $trendingProduct = new TrendingProductResource($trendingProduct);
        return $this->sendResponse(compact('trendingProduct'), $message);
    }
}
