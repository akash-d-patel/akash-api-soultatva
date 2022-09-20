<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Http\Requests\Attribute\CreateRequest;
use App\Http\Requests\Attribute\EditRequest;
use App\Http\Resources\AttributeResource;


class AttributeController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Attribute::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group Attribute
     */
    public function index(Request $request)
    {
        $attributes = Attribute::with(['creater'])->pimp()->paginate();
        $message = "All Records";
        AttributeResource::collection($attributes);
        return $this->sendResponse(compact('attributes'), $message);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
    }

    /**
     * Add
     * @group Attribute
     */
    public function store(CreateRequest $request)
    {
        $attribute = Attribute::createUpdate(new Attribute, $request);
        $message = "Attribute added successfully";
        $attribute = new AttributeResource($attribute);
        return $this->sendResponse(compact('attribute'), $message);
    }

    /**
     * Show
     * @group Attribute
     */
    public function show(Attribute $attribute, Request $request)
    {
        $message = 'Attribute listed successfully';
        $attribute = new AttributeResource($attribute);
        return $this->sendResponse(compact('attribute'), $message);
    }

    public function edit(Attribute $attribute)
    {
        // 
    }

    /**
     * Update
     * @group Attribute
     */
    public function update(EditRequest $request, Attribute $attribute)
    {
        $attribute = Attribute::createUpdate($attribute, $request);
        $message = "Attribute updated successfully";
        $attribute = new AttributeResource($attribute);
        return $this->sendResponse(compact('attribute'), $message);
    }

    /**
     * Delete
     * @group Attribute
     */
    public function destroy(Attribute $attribute, Request $request)
    {
        $attribute->delete();
        $message = "Attribute deleted successfully";
        $attribute = new AttributeResource($attribute);
        return $this->sendResponse(compact('attribute'), $message);
    }
}
