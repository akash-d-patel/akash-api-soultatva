<?php

namespace App\Http\Controllers\Api\Front;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
use App\Http\Requests\Review\CreateRequest;
use App\Http\Requests\Review\EditRequest;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\ReviewResource;

class ProductReviewController extends BaseController
{
    /**
     * Add
     * @group Product Review
     */
    public function storeProductReview(Product $product, Review $review, CreateRequest $request)
    {
        $review = Review::createUpdate($product, $review, $request);
        $message = "Product review added successfully";
        $review = new ReviewResource($review);
        return $this->sendResponse(compact('review'), $message);
    }
    /**
     * Update
     * @group Product Review
     */
    public function updateProductReview(Product $product, Review $review, EditRequest $request)
    {
        $review = Review::createUpdate($product, $review, $request);
        $message = "Product review updated successfully";
        $review = new ReviewResource($review);
        return $this->sendResponse(compact('review'), $message);
    }
}
