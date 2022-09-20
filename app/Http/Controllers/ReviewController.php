<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
use App\Http\Requests\Review\CreateRequest;
use App\Http\Requests\Review\EditRequest;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\ReviewResource;

class ReviewController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Review::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group Product Review
     */
    public function index(Product $product, Request $request)
    {
        $reviews = Review::whereHas('product', function ($query) use ($product) {
            $query->where('id', $product->id);
            return $query;
        })->pimp()->paginate();
        ReviewResource::collection($reviews);
        return $this->sendResponse(compact('product', 'reviews'), "All Record");
    }

    /**
     * Add
     * @group Product Review
     */
    public function store(Product $product, Review $review, CreateRequest $request)
    {
        $review = Review::createUpdate($product, $review, $request);
        $message = "Product review added successfully";
        $review = new ReviewResource($review);
        return $this->sendResponse(compact('review'), $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update
     * @group Review
     */
    public function update(Product $product, Review $review, EditRequest $request)
    {
        $review = Review::createUpdate($product, $review, $request);
        $message = "Product review updated successfully";
        $review = new ReviewResource($review);
        return $this->sendResponse(compact('review'), $message);
    }

    /**
     * Delete
     * @group Product Review
     */
    public function destroy(Product $product, Review $review, Request $request)
    {
        $review->delete();
        $message = "Product review deleted successfully";
        $review = new ReviewResource($review);
        return $this->sendResponse(compact('review'), $message);
    }
}
