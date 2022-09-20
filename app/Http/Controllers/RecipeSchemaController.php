<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Schema\CreateRequest;
use App\Http\Requests\Schema\EditRequest;
use App\Http\Resources\SchemaResource;
use App\Models\Recipe;
use App\Models\Schema;
use Illuminate\Http\Request;

class RecipeSchemaController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Schema::class);
        $this->getMiddleware();
    }

    /**
     * Add
     * @group Schema
     */
    public function store(Recipe $recipe, Schema $schema, CreateRequest $request)
    {
        $schema = Schema::createUpdate(new Schema(), $request);
        $recipe->schema()->save($schema);
        $message = "Recipe schema added successfully";
        $schema = new SchemaResource($schema);
        return $this->sendResponse(compact('schema'), $message);
    }

    /**
     * Show
     * @group Schema
     */
    public function show(Recipe $recipe, Schema $schema, Request $request)
    {
        $message = "Recipe schema listed successfully";
        $schema = $recipe->schema;
        $schema = new SchemaResource($schema);
        return $this->sendResponse(compact('schema'), $message);
    }

    /**
     * Update
     * @group Schema
     */
    public function update(Recipe $recipe, Schema $schema, EditRequest $request)
    {
        $schema = Schema::createUpdate($schema, $request);
        $message = "Recipe schema updated successfully";
        $schema = new SchemaResource($schema);
        return $this->sendResponse(compact('schema'), $message);
    }

}
