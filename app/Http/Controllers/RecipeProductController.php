<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\RecipeProduct\CreateRequest;
use App\Http\Requests\RecipeProduct\EditRequest;
use App\Http\Resources\RecipeProductResource;
use App\Models\RecipeProduct;
use Illuminate\Http\Request;

class RecipeProductController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(RecipeProduct::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group RecipeProduct
     */
    public function index()
    {
        $recipeProducts = RecipeProduct::with(['recipe','product','creater'])->pimp()->paginate();
        $message = "All Records"; 
        RecipeProductResource::collection($recipeProducts); 
        return $this->sendResponse(compact('recipeProducts'), $message);
    }

    /**
     * Add
     * @group RecipeProduct
     */
    public function store(CreateRequest $request)
    {
        $recipeProduct = RecipeProduct::createUpdate(new RecipeProduct, $request);
        $message = "Recipe product added successfully";
        $recipeProduct = new RecipeProductResource($recipeProduct);
        return $this->sendResponse(compact('recipeProduct'), $message); 
    }

    /**
     * Show
     * @group RecipeProduct
     */
    public function show(RecipeProduct $recipeProduct)
    {
        $recipeProduct = $recipeProduct->load('recipe','product','creater');
        $message = 'Recipe product listed successfully';
        $recipeProduct = new RecipeProductResource($recipeProduct);
        return $this->sendResponse(compact('recipeProduct'), $message);
    }

    /**
     * Update
     * @group RecipeProduct
     */
    public function update(EditRequest $request, RecipeProduct $recipeProduct)
    {
        $recipeProduct = RecipeProduct::createUpdate($recipeProduct, $request);
        $message = "Recipe product updated successfully";
        $recipeProduct = new RecipeProductResource($recipeProduct);
        return $this->sendResponse(compact('recipeProduct'), $message);
    }

    /**
     * Delete
     * @group RecipeProduct
     */
    public function destroy(RecipeProduct $recipeProduct)
    {
        $recipeProduct->delete();
        $message = "Recipe product deleted successfully";
        $recipeProduct = new RecipeProductResource($recipeProduct);
        return $this->sendResponse(compact('recipeProduct'), $message);
    }
}
