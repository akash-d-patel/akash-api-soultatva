<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Meta\CreateRequest;
use App\Http\Requests\Meta\EditRequest;
use App\Http\Resources\MetaResource;
use App\Models\Meta;
use App\Models\Page;
use Illuminate\Http\Request;

class PageMetaController extends BaseController
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
    public function store(Page $page, Meta $meta, CreateRequest $request)
    {
        $meta = Meta::createUpdate(new Meta, $request);
        $page->meta()->save($meta);
        $message = "Page meta added successfully";
        $meta = new MetaResource($meta);
        return $this->sendResponse(compact('meta'), $message);
    }

    /**
     * Show
     * @group Meta
     */
    public function show(Page $page, Meta $meta, Request $request)
    {
        $message = "Page meta listed successfully";
        $meta = $page->meta;
        $meta = new MetaResource($meta);
        return $this->sendResponse(compact('meta'), $message);
    }

    /**
     * Update
     * @group Meta
     */
    public function update(Page $page, Meta $meta, EditRequest $request)
    {
        $meta = Meta::createUpdate($meta, $request);
        $message = "Page meta updated successfully";
        $meta = new MetaResource($meta);
        return $this->sendResponse(compact('meta'), $message);
    }
}
