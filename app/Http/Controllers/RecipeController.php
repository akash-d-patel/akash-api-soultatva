<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Recipe\CreateRequest;
use App\Http\Requests\Recipe\EditRequest;
use App\Http\Resources\RecipeResource;
use Illuminate\Http\Request;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;

use function App\Helpers\getSchedulerApiData;

class RecipeController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Recipe::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group Recipe
     */
    public function index()
    {
        $recipes = Recipe::with('creater')->pimp()->paginate();
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
        $message = "recipe added successfully";
        $recipe = new RecipeResource($recipe);
        return $this->sendResponse(compact('recipe'), $message);
    }

    /**
     * Show
     * @group Recipe
     */
    public function show(Recipe $recipe)
    {
        $message = "recipe listed successfully";
        $recipe = new RecipeResource($recipe);
        return $this->sendResponse(compact('recipe'), $message);
    }

    /**
     * Update
     * @group Recipe
     */
    public function update(Request $request, Recipe $recipe)
    {
        $recipe = Recipe::addUpdatedRecipes($recipe, $request);
        $message = "recipe updated successfully";
        $recipe = new RecipeResource($recipe);
        if($recipe->approval_status == "approved") {
            $recipe->approval_by = Auth::user()->id;
            /*
            * Send email on recipe approved with scheduler
            */
            $arrTemplateConstant = [];
            /**  Variable need to be change in template*/
            $arrTemplateConstant['#WEBSITE#'] = "Soultatva";
            $arrTemplateConstant['#LOGO-PATH#'] = "https://www.soultatva.com/images/sharing-logo.png";
            $arrTemplateConstant['#USER-NAME#'] = $recipe->name;
            
            $request->request->add(['client_id' =>  $recipe->client_id]);
            $request->request->add(['project_id' =>  1]);
            $request->request->add(['from_email' =>  'admin@soultatva.com']);
            $request->request->add(['to_email' =>  $recipe->email]);
            $request->request->add(['subject' =>  'Recipe Approved']);
            $request->request->add(['status' =>  'Send']);
            if($recipe->client_id == 2) {
                $request->request->add(['email_template_id' =>  42]);
                $request->request->add(['template' =>  '42_recipe_approved']);
            } else {
                $request->request->add(['email_template_id' =>  19]);
                $request->request->add(['template' =>  '19_recipe_approved']);
            }
            $request->request->add(['template_var' =>  json_encode($arrTemplateConstant)]);

            getSchedulerApiData($request);
        }
        return $this->sendResponse(compact('recipe'), $message);
    }

    /**
     * Delete
     * @group Recipe
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        $message = "recipe deleted successfully";
        $recipe = new RecipeResource($recipe);
        return $this->sendResponse(compact('recipe'), $message);
    }

    /**
     * Product List
     * @group Recipe
     */
    public function getProductList(Request $request)
    {
        $recipes = Recipe::with('creater')->pimp()->get();
        $message = "All Records";
        RecipeResource::collection($recipes);
        return $this->sendResponse(compact('recipes'), $message);
    }
}
