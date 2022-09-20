<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Schema\CreateRequest;
use App\Http\Requests\Schema\EditRequest;
use App\Http\Resources\SchemaResource;
use App\Models\Schema;
use App\Models\SubProduct;
use Illuminate\Http\Request;

class SubProductSchemaController extends BaseController
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
    public function store(SubProduct $subProduct, Schema $schema, CreateRequest $request)
    {
        $schema = Schema::createUpdate(new Schema(), $request);
        $subProduct->schema()->save($schema);
        $message = "Sub product schema added successfully";
        $schema = new SchemaResource($schema);
        return $this->sendResponse(compact('schema'), $message);
    }

    /**
     * Show
     * @group Schema
     */
    public function show(SubProduct $subProduct, Schema $schema, Request $request)
    {
        $message = "Sub product schema listed successfully";
        $schema = $subProduct->schema;
        $schema = new SchemaResource($schema);
        return $this->sendResponse(compact('schema'), $message);
    }

    /**
     * Update
     * @group Schema
     */
    public function update(SubProduct $subProduct, Schema $schema, EditRequest $request)
    {
        $schema = Schema::createUpdate($schema, $request);
        $message = "Sub product schema updated successfully";
        $schema = new SchemaResource($schema);
        return $this->sendResponse(compact('schema'), $message);
    }
}
