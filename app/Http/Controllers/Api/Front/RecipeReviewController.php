<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Review\CreateRequest;
use App\Http\Requests\Review\EditRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Recipe;
use App\Models\Review;
use Illuminate\Http\Request;

class RecipeReviewController extends BaseController
{
    /**
     * Add
     * @group Recipe Review
     */
    public function storeRecipeReview(Recipe $recipe, Review $review, CreateRequest $request)
    {
        $review = Review::createUpdateRecipeReview($recipe, $review, $request);
        $message = "Recipe review added successfully";
        $review = new ReviewResource($review);
        return $this->sendResponse(compact('review'), $message);
    }
    /**
     * Update
     * @group Recipe Review
     */
    public function updateRecipeReview(Recipe $recipe, Review $review, EditRequest $request)
    {
        $review = Review::createUpdateRecipeReview($recipe, $review, $request);
        $message = "Recipe review updated successfully";
        $review = new ReviewResource($review);
        return $this->sendResponse(compact('review'), $message);
    }
}
