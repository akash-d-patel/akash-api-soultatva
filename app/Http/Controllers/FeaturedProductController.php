<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\FeaturedProduct\CreateRequest;
use App\Http\Requests\FeaturedProduct\EditRequest;
use App\Http\Resources\FeaturedProductResource;
use App\Models\FeaturedProduct;
use Illuminate\Http\Request;

class FeaturedProductController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(FeaturedProduct::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group FeaturedProduct
     */
    public function index()
    {
        $featuredProducts = FeaturedProduct::with(['creater'])->pimp()->paginate();
        $message = "All Records";
        FeaturedProductResource::collection($featuredProducts);
        return $this->sendResponse(compact('featuredProducts'), $message);
    }

    /**
     * Add
     * @group FeaturedProduct
     */
    public function store(CreateRequest $request)
    {
        $featuredProduct = FeaturedProduct::createUpdate(new FeaturedProduct, $request);
        $message = "Featured product added successfully";
        $featuredProduct = new FeaturedProductResource($featuredProduct);
        return $this->sendResponse(compact('featuredProduct'), $message);
    }

    /**
     * Show
     * @group FeaturedProduct
     */
    public function show(FeaturedProduct $featuredProduct)
    {
        $message = 'Featured product listed successfully';
        $featuredProduct = new FeaturedProductResource($featuredProduct);
        return $this->sendResponse(compact('featuredProduct'), $message);
    }

    /**
     * Update
     * @group FeaturedProduct
     */
    public function update(EditRequest $request, FeaturedProduct $featuredProduct)
    {
        $featuredProduct = FeaturedProduct::createUpdate($featuredProduct, $request);
        $message = "Featured product updated successfully";
        $featuredProduct = new FeaturedProductResource($featuredProduct);
        return $this->sendResponse(compact('featuredProduct'), $message);
    }

    /**
     * Delete
     * @group FeaturedProduct
     */
    public function destroy(FeaturedProduct $featuredProduct)
    {
        $featuredProduct->delete();
        $message = "Featured product deleted successfully";
        $featuredProduct = new FeaturedProductResource($featuredProduct);
        return $this->sendResponse(compact('featuredProduct'), $message);
    }
}
