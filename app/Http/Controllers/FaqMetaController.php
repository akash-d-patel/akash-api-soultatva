<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Meta\CreateRequest;
use App\Http\Requests\Meta\EditRequest;
use App\Http\Resources\MetaResource;
use App\Models\Faq;
use App\Models\Meta;
use Illuminate\Http\Request;

class FaqMetaController extends BaseController
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
    public function store(Faq $faq, Meta $meta, CreateRequest $request)
    {
        $meta = Meta::createUpdate(new Meta, $request);
        $faq->meta()->save($meta);
        $message = "Faq meta added successfully";
        $meta = new MetaResource($meta);
        return $this->sendResponse(compact('meta'), $message);
    }

    /**
     * Show
     * @group Meta
     */
    public function show(Faq $faq, Meta $meta, Request $request)
    {
        $message = "Faq meta listed successfully";
        $meta = $faq->meta;
        $meta = new MetaResource($meta);
        return $this->sendResponse(compact('meta'), $message);
    }

    /**
     * Update
     * @group Meta
     */
    public function update(Faq $faq, Meta $meta, EditRequest $request)
    {
        $meta = Meta::createUpdate($meta, $request);
        $message = "Faq meta updated successfully";
        $meta = new MetaResource($meta);
        return $this->sendResponse(compact('meta'), $message);
    }
}
