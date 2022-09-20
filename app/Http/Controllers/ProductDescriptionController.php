<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Description\CreateRequest;
use App\Http\Requests\Description\EditRequest;
use App\Http\Resources\DescriptionResource;
use App\Models\Description;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductDescriptionController extends BaseController
{
    /**
     * List
     * @group ProductDescription
     */
    public function index(Product $product, Request $request)
    {
        $descriptions = Description::whereHas('product', function ($query) use ($product) {
            $query->where('id', $product->id);
            return $query;
        })->pimp()->paginate();
        $message = "All Records";
        DescriptionResource::collection($descriptions);
        return $this->sendResponse(compact('product', 'descriptions'), $message);
    }

    /**
     * Add
     * @group ProductDescription
     */
    public function store(Product $product, Description $description, CreateRequest $request)
    {
        $description = Description::createUpdateProduct($product, $description, $request);
        $message = "product description added successfully";
        $description = new DescriptionResource($description);
        return $this->sendResponse(compact('description'),$message);  
    }

    /**
     * Show
     * @group ProductDescription
     */
    public function show(Product $product, Description $description, Request $request)
    {
        $message = "product description listed successfully";
        $description = new DescriptionResource($description);
        return $this->sendResponse(compact('description'),$message);
    }

    /**
     * Update
     * @group ProductDescription
     */
    public function update(Product $product, EditRequest $request, Description $description)
    {
        $description = Description::createUpdateProduct($product,$description, $request);
        $message = "product description updated successfully";
        $description = new DescriptionResource($description);
        return $this->sendResponse(compact('description'),$message);
    }

    /**
     * Delete
     * @group ProductDescription
     */
    public function destroy(Product $product, Description $description, Request $request)
    {
        $description->delete();
        $message = "product description deleted successfully";
        $description = new DescriptionResource($description);
        return $this->sendResponse(compact('description'), $message);
    }
}
