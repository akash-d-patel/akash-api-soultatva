<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Meta\CreateRequest;
use App\Http\Requests\Meta\EditRequest;
use App\Http\Resources\MetaResource;
use App\Models\Blog;
use App\Models\Meta;
use Illuminate\Http\Request;

class BlogMetaController extends BaseController
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
    public function store(Blog $blog, Meta $meta, CreateRequest $request)
    {
        $meta = Meta::createUpdate(new Meta, $request);
        $blog->meta()->save($meta);
        $message = "Blog meta added successfully";
        $meta = new MetaResource($meta);
        return $this->sendResponse(compact('meta'), $message);
    }

    /**
     * Show
     * @group Meta
     */
    public function show(Blog $blog, Meta $meta, Request $request)
    {
        $message = "Blog meta listed successfully";
        $meta = $blog->meta;
        $meta = new MetaResource($meta);
        return $this->sendResponse(compact('meta'), $message);
    }

    /**
     * Update
     * @group Meta
     */
    public function update(Blog $blog, Meta $meta, EditRequest $request)
    {
        $meta = Meta::createUpdate($meta, $request);
        $message = "Blog meta updated successfully";
        $meta = new MetaResource($meta);
        return $this->sendResponse(compact('meta'), $message);
    }
}
