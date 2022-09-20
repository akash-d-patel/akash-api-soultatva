<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\RelatedRecipeResource;
use App\Models\Recipe;
use App\Models\RelatedRecipe;
use Illuminate\Http\Request;

class RelatedRecipeController extends BaseController
{
    /**
     * List
     * @group RelatedRecipe
     */
    public function list(Recipe $recipe, Request $request)
    {
        $relatedRecipes = RelatedRecipe::whereHas('recipe', function ($query) use ($recipe) {
            $query->where('id', $recipe->id);
            return $query;
        })->pimp()->paginate();
        $message = "All Records";
        RelatedRecipeResource::collection($relatedRecipes);
        return $this->sendResponse(compact('recipe', 'relatedRecipes'), $message);
    }
}
