<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Recipe\CreateRequest;
use App\Http\Resources\RecipeResource;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends BaseController
{
    /**
     * List
     * @group Recipe
     */

    public function list(Request $request)
    {
        $recipes = Recipe::with(['creater'])
                          ->where('approval_status','approved')  
                          ->pimp()->paginate();
        $message = "All Records";
        RecipeResource::collection($recipes);
        return $this->sendResponse(compact('recipes'), $message);
    }

    /**
     * Add
     * @group Recipe
     */
    public function store(CreateRequest $request)
    {
        $recipe = Recipe::addUpdatedRecipes(new Recipe, $request);
        $message = "front recipe added successfully";
        $recipe = new RecipeResource($recipe);
        return $this->sendResponse(compact('recipe'), $message);
    }

    /**
     * Show
     * @group Recipe
     */

    public function show($slug, Request $request)
    {
        $message = 'Recipe listed successfully';
        $recipeDetails = Recipe::where('slug', $slug)->first();
        $recipe = new RecipeResource($recipeDetails);
        return $this->sendResponse(compact('recipe'), $message);
    }
}
