<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Schema\CreateRequest;
use App\Http\Requests\Schema\EditRequest;
use App\Http\Resources\SchemaResource;
use App\Models\Product;
use App\Models\Schema;
use Illuminate\Http\Request;

class ProductSchemaController extends BaseController
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
    public function store(Product $product, Schema $schema, CreateRequest $request)
    {
        $schema = Schema::createUpdate(new Schema(), $request);
        $product->schema()->save($schema);
        $message = "Product schema added successfully";
        $schema = new SchemaResource($schema);
        return $this->sendResponse(compact('schema'), $message);
    }

    /**
     * Show
     * @group Schema
     */
    public function show(Product $product, Schema $schema, Request $request)
    {
        $message = "Product schema listed successfully";
        $schema = $product->schema;
        $schema = new SchemaResource($schema);
        return $this->sendResponse(compact('schema'), $message);
    }

    /**
     * Update
     * @group Schema
     */
    public function update(Product $product, Schema $schema, EditRequest $request)
    {
        $schema = Schema::createUpdate($schema, $request);
        $message = "Product schema updated successfully";
        $schema = new SchemaResource($schema);
        return $this->sendResponse(compact('schema'), $message);
    }

}
