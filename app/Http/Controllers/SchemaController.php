<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Schema\CreateRequest;
use App\Http\Requests\Schema\EditRequest;
use App\Http\Resources\SchemaResource;
use App\Models\Schema;
use Illuminate\Http\Request;

class SchemaController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Schema::class);
        $this->getMiddleware();
    }
    /**
     * List
     * @group Schema
     */
    public function index(Request $request)
    {
        $schemas = Schema::with('creater')->pimp()->paginate();
        $message = "All records";
        SchemaResource::collection($schemas);
        return $this->sendResponse(compact('schemas'), $message);
    }

    /**
     * Add
     * @group Schema
     */
    public function store(CreateRequest $request)
    {
        $schema = Schema::createUpdate(new Schema, $request);
        $message = "Schema added successfully";
        $schema = new SchemaResource($schema);
        return $this->sendResponse(compact('schema'), $message);
    }

    /**
     * Show
     * @group Schema
     */
    public function show(Schema $schema)
    {
        $message = 'Schema listed successfully';
        $schema = new SchemaResource($schema);
        return $this->sendResponse(compact('schema'), $message);
    }

    /**
     * Update
     * @group Schema
     */
    public function update(EditRequest $request, Schema $schema)
    {
        $schema = Schema::createUpdate($schema, $request);
        $message = "Schema updated successfully";
        $schema = new SchemaResource($schema);
        return $this->sendResponse(compact('schema'), $message);
    }

    /**
     * Delete
     * @group Schema
     */
    public function destroy(Schema $schema)
    {
        $schema->delete();
        $message = "Schema deleted successfully";
        $schema = new SchemaResource($schema);
        return $this->sendResponse(compact('schema'), $message);
    }
}
