<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Meta\CreateRequest;
use App\Http\Requests\Meta\EditRequest;
use App\Http\Resources\MetaResource;
use App\Models\Meta;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeMetaController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Meta::class);
        $this->getMiddleware();
    }

    /**
     * Add
     * @group Meta
     */
    public function store(Recipe $recipe, Meta $meta, CreateRequest $request)
    {
        $meta = Meta::createUpdate(new Meta, $request);
        $recipe->meta()->save($meta);
        $message = "Recipe meta added successfully";
        $meta = new MetaResource($meta);
        return $this->sendResponse(compact('meta'), $message);
    }

    /**
     * Show
     * @group Meta
     */
    public function show(Recipe $recipe, Meta $meta, Request $request)
    {
        $message = "Recipe meta listed successfully";
        $meta = $recipe->meta;
        $meta = new MetaResource($meta);
        return $this->sendResponse(compact('meta'), $message);
    }

    /**
     * Update
     * @group Meta
     */
    public function update(Recipe $recipe, Meta $meta, EditRequest $request)
    {
        $meta = Meta::createUpdate($meta, $request);
        $message = "Recipe meta updated successfully";
        $meta = new MetaResource($meta);
        return $this->sendResponse(compact('meta'), $message);
    }
}
