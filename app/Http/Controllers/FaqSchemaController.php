<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Schema\CreateRequest;
use App\Http\Requests\Schema\EditRequest;
use App\Http\Resources\SchemaResource;
use App\Models\Faq;
use App\Models\Schema;
use Illuminate\Http\Request;

class FaqSchemaController extends BaseController
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
    public function store(Faq $faq, Schema $schema, CreateRequest $request)
    {
        $schema = Schema::createUpdate(new Schema(), $request);
        $faq->schema()->save($schema);
        $message = "Faq schema added successfully";
        $schema = new SchemaResource($schema);
        return $this->sendResponse(compact('schema'), $message);
    }

    /**
     * Show
     * @group Schema
     */
    public function show(Faq $faq, Schema $schema, Request $request)
    {
        $message = "Faq schema listed successfully";
        $schema = $faq->schema;
        $schema = new SchemaResource($schema);
        return $this->sendResponse(compact('schema'), $message);
    }

    /**
     * Update
     * @group Schema
     */
    public function update(Faq $faq, Schema $schema, EditRequest $request)
    {
        $schema = Schema::createUpdate($schema, $request);
        $message = "Faq schema updated successfully";
        $schema = new SchemaResource($schema);
        return $this->sendResponse(compact('schema'), $message);
    }

}
