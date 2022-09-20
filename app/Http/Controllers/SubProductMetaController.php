<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Meta\CreateRequest;
use App\Http\Requests\Meta\EditRequest;
use App\Http\Resources\MetaResource;
use App\Models\Meta;
use App\Models\SubProduct;
use Illuminate\Http\Request;

class SubProductMetaController extends BaseController
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
    public function store(SubProduct $subProduct, Meta $meta, CreateRequest $request)
    {
        $meta = Meta::createUpdate(new Meta, $request);
        $subProduct->meta()->save($meta);
        $message = "Sub product meta added successfully";
        $meta = new MetaResource($meta);
        return $this->sendResponse(compact('meta'), $message);
    }

    /**
     * Show
     * @group Meta
     */
    public function show(SubProduct $subProduct, Meta $meta, Request $request)
    {
        $message = "Sub product meta listed successfully";
        $meta = $subProduct->meta;
        $meta = new MetaResource($meta);
        return $this->sendResponse(compact('meta'), $message);
    }

    /**
     * Update
     * @group Meta
     */
    public function update(SubProduct $subProduct, Meta $meta, EditRequest $request)
    {
        $meta = Meta::createUpdate($meta, $request);
        $message = "Sub product meta updated successfully";
        $meta = new MetaResource($meta);
        return $this->sendResponse(compact('meta'), $message);
    }

}
