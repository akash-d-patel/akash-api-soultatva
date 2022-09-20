<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Schema\CreateRequest;
use App\Http\Requests\Schema\EditRequest;
use App\Http\Resources\SchemaResource;
use App\Models\Category;
use App\Models\Schema;
use Illuminate\Http\Request;

class CategorySchemaController extends BaseController
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
    public function store(Category $category, Schema $schema, CreateRequest $request)
    {
        $schema = Schema::createUpdate(new Schema(), $request);
        $category->schema()->save($schema);
        $message = "Category schema added successfully";
        $schema = new SchemaResource($schema);
        return $this->sendResponse(compact('schema'), $message);
    }

    /**
     * Show
     * @group Schema
     */
    public function show(Category $category, Schema $schema, Request $request)
    {
        $message = "Category schema listed successfully";
        $schema = $category->schema;
        $schema = new SchemaResource($schema);
        return $this->sendResponse(compact('schema'), $message);
    }

    /**
     * Update
     * @group Schema
     */
    public function update(Category $category, Schema $schema, EditRequest $request)
    {
        $schema = Schema::createUpdate($schema, $request);
        $message = "Category schema updated successfully";
        $schema = new SchemaResource($schema);
        return $this->sendResponse(compact('schema'), $message);
    }
}
