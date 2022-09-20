<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\RelatedRecipe\CreateRequest;
use App\Http\Resources\RelatedRecipeResource;
use App\Models\Recipe;
use App\Models\RelatedRecipe;
use Illuminate\Http\Request;

class RelatedRecipeController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(RelatedRecipe::class);
        $this->getMiddleware();
    }

     /**
     * List
     * @group RelatedRecipe
     */
    public function index(Recipe $recipe, Request $request)
    {
        $relatedRecipes = RelatedRecipe::whereHas('recipe', function ($query) use ($recipe) {
            $query->where('id', $recipe->id);
            return $query;
        })->pimp()->paginate();
        $message = "All Records";
        RelatedRecipeResource::collection($relatedRecipes);
        return $this->sendResponse(compact('recipe', 'relatedRecipes'), $message);
    }

    /**
     * Add
     * @group RelatedRecipe
     */
    public function store(Recipe $recipe, RelatedRecipe $relatedRecipe, CreateRequest $request)
    {
        $relatedRecipe = RelatedRecipe::createUpdate($recipe, $relatedRecipe, $request);
        $message = "Related Recipe added successfully";
        $relatedRecipe = new RelatedRecipeResource($relatedRecipe);
        return $this->sendResponse(compact('relatedRecipe'), $message);
    }

    /**
     * Delete
     * @group RelatedRecipe
     */
    public function destroy(Recipe $recipe, RelatedRecipe $relatedRecipe)
    {
        // $relatedRecipe->delete();
        $recipe->relatedRecipes()->find($relatedRecipe->id)->delete();
        $message = "Related Recipe deleted successfully";
        $relatedRecipe = new RelatedRecipeResource($relatedRecipe);
        return $this->sendResponse(compact('relatedRecipe'), $message);
    }
}
