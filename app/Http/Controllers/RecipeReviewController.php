<?php

namespace App\Http\Controllers;

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
     * List
     * @group Recipe Review
     */
    public function index(Recipe $recipe, Request $request)
    {
        $reviews = Review::whereHas('recipe', function ($query) use ($recipe) {
            $query->where('id', $recipe->id);
            return $query;
        })->pimp()->paginate();
        ReviewResource::collection($reviews);
        return $this->sendResponse(compact('recipe', 'reviews'), "All Record");
    }

    /**
     * Add
     * @group Recipe Review
     */
    public function store(Recipe $recipe, Review $review, CreateRequest $request)
    {
        $review = Review::createUpdateRecipeReview($recipe, $review, $request);
        $message = "Recipe review added successfully";
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
     * @group Recipe Review
     */
    public function update(Recipe $recipe, Review $review, EditRequest $request)
    {
        $review = Review::createUpdateRecipeReview($recipe, $review, $request);
        $message = "Recipe review updated successfully";
        $review = new ReviewResource($review);
        return $this->sendResponse(compact('review'), $message);
    }

    /**
     * Delete
     * @group Recipe Review
     */
    public function destroy(Recipe $recipe, Review $review, Request $request)
    {
        $review->delete();
        $message = "Recipe review deleted successfully";
        $review = new ReviewResource($review);
        return $this->sendResponse(compact('review'), $message);
    }
}
