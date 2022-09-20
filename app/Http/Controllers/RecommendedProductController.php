<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\RecommendedProduct\CreateRequest;
use App\Http\Requests\RecommendedProduct\EditRequest;
use App\Http\Resources\RecommendedProductResource;
use App\Models\RecommendedProduct;
use Illuminate\Http\Request;

class RecommendedProductController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(RecommendedProduct::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group RecommendedProduct
     */
    public function index()
    {
        $recommendedProducts = RecommendedProduct::with(['creater'])->pimp()->paginate();
        $message = "All Records";
        RecommendedProductResource::collection($recommendedProducts);
        return $this->sendResponse(compact('recommendedProducts'), $message);
    }

    /**
     * Add
     * @group RecommendedProduct
     */
    public function store(CreateRequest $request)
    {
        $recommendedProduct = RecommendedProduct::createUpdate(new RecommendedProduct, $request);
        $message = "Recommended product added successfully";
        $recommendedProduct = new RecommendedProductResource($recommendedProduct);
        return $this->sendResponse(compact('recommendedProduct'), $message);
    }

    /**
     * Show
     * @group RecommendedProduct
     */
    public function show(RecommendedProduct $recommendedProduct)
    {
        $message = 'Recommended product listed successfully';
        $recommendedProduct = new RecommendedProductResource($recommendedProduct);
        return $this->sendResponse(compact('recommendedProduct'), $message);
    }

    /**
     * Update
     * @group RecommendedProduct
     */
    public function update(EditRequest $request, RecommendedProduct $recommendedProduct)
    {
        $recommendedProduct = RecommendedProduct::createUpdate($recommendedProduct, $request);
        $message = "Recommended product updated successfully";
        $recommendedProduct = new RecommendedProductResource($recommendedProduct);
        return $this->sendResponse(compact('recommendedProduct'), $message);
    }

    /**
     * Delete
     * @group RecommendedProduct
     */
    public function destroy(RecommendedProduct $recommendedProduct)
    {
        $recommendedProduct->delete();
        $message = "Recommended product deleted successfully";
        $recommendedProduct = new RecommendedProductResource($recommendedProduct);
        return $this->sendResponse(compact('recommendedProduct'), $message);
    }
}
