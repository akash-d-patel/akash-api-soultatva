<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Meta\CreateRequest;
use App\Http\Requests\Meta\EditRequest;
use App\Http\Resources\MetaResource;
use App\Models\Meta;
use Illuminate\Http\Request;

class MetaController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Meta::class);
        $this->getMiddleware();
    }

   /**
     * List
     * @group Meta
     */
    public function index()
    {
        $metas = Meta::with('creater')->pimp()->paginate();
        $message = "All Records";
        MetaResource::collection($metas);
        return $this->sendResponse(compact('metas'),$message);
    }

    /**
    * Add
    * @group Meta
    */
    public function store(CreateRequest $request)
    {
        $meta = Meta::createUpdate(new Meta, $request);
        $message = "meta added successfully";
        $meta = new MetaResource($meta);
        return $this->sendResponse(compact('meta'),$message);
    }

    /**
     * Show
     * @group Meta
     */
    public function show(Meta $meta)
    {
        $message = "meta listed successfully";
        $meta = new MetaResource($meta);
        return $this->sendResponse(compact('meta'),$message);
    }

    /**
     * Update
     * @group Meta
     */
    public function update(EditRequest $request, Meta $meta)
    {
        $meta = Meta::createUpdate($meta, $request);
        $message = "meta updated successfully";
        $meta = new MetaResource($meta);
        return $this->sendResponse(compact('meta'),$message);
    }

    /**
     * Delete
     * @group Meta
     */
    public function destroy(Meta $meta)
    {
        $meta->delete();
        $message = "meta deleted successfully";
        $meta = new MetaResource($meta);
        return $this->sendResponse(compact('meta'),$message);
    }
}
