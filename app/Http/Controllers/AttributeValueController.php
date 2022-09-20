<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttributeValue;
use App\Models\Attribute;
use App\Http\Requests\AttributeValue\CreateRequest;
use App\Http\Requests\AttributeValue\EditRequest;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\AttributevalueResource;

class AttributeValueController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(AttributeValue::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group AttributeValue
     */
    public function index(Attribute $attribute, Request $request)
    {
        $attributeValues = AttributeValue::whereHas('attribute', function ($query) use ($attribute) {
            $query->where('id',  $attribute->id);
            return $query;
        })->pimp()->paginate();
        AttributevalueResource::collection($attributeValues);
        return $this->sendResponse(compact('attribute', 'attributeValues'), "All Record");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Attribute $attribute)
    {
        // 
    }

    /**
     * Add
     * @group AttributeValue
     */
    public function store(Attribute $attribute, CreateRequest $request)
    {
        // $validated = $request->validate([
        //     'value' => 'required|min:3|max:50'
        // ]);
        $attributevalue = AttributeValue::createUpdate($attribute, new AttributeValue, $request);
        $message = "Value added successfully";
        $attributevalue = new AttributevalueResource($attributevalue);
        return $this->sendResponse(compact('attributevalue'), $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute, AttributeValue $attributeValue)
    {
        // 
    }

    /**
     * Update
     * @group AttributeValue
     */
    public function update(Attribute $attribute, EditRequest $request, AttributeValue $attributeValue)
    {
        $attributeValue = AttributeValue::createUpdate($attribute, $attributeValue, $request);
        $message = "Value updated successfully";
        $attributeValue = new AttributevalueResource($attributeValue);
        return $this->sendResponse(compact('attributeValue'), $message);
    }

    /**
     * Delete
     * @group AttributeValue
     */
    public function destroy(Attribute $attribute, AttributeValue $attributeValue, Request $request)
    {
        $attributeValue->delete();
        $message = "Value deleted successfully";
        $attributeValue = new AttributevalueResource($attributeValue);
        return $this->sendResponse(compact('attributeValue'), $message);
    }
}
