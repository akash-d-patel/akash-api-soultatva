<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Description\CreateRequest;
use App\Http\Requests\Description\EditRequest;
use App\Http\Resources\DescriptionResource;
use App\Models\Brand;
use App\Models\Description;
use Illuminate\Http\Request;

class BrandDescriptionController extends BaseController
{
    /**
     * List
     * @group BrandDescription
     */
    public function index(Brand $brand, Request $request)
    {
        $descriptions = Description::whereHas('brand', function ($query) use ($brand) {
            $query->where('id', $brand->id);
            return $query;
        })->pimp()->paginate();
        $message = "All Records";
        DescriptionResource::collection($descriptions);
        return $this->sendResponse(compact('brand', 'descriptions'), $message);
    } 

    /**
     * Add
     * @group BrandDescription
     */
    public function store(Brand $brand, Description $description, CreateRequest $request)
    {
        $description = Description::createUpdateBrand($brand, $description, $request);
        $message = "brand description added successfully";
        $description = new DescriptionResource($description);
        return $this->sendResponse(compact('description'),$message);
    }

    /**
     * Show
     * @group BrandDescription
     */
    public function show(Brand $brand, Description $description, Request $request)
    {
        $message = "brand description listed successfully";
        $description = new DescriptionResource($description);
        return $this->sendResponse(compact('description'),$message);
    }

    /**
     * Update
     * @group BrandDescription
     */
    public function update(Brand $brand, Description $description, EditRequest $request)
    {
        $description = Description::createUpdateBrand($brand, $description, $request);
        $message = "brand description updated successfully";
        $description = new DescriptionResource($description);
        return $this->sendResponse(compact('description'),$message);
    }

    /**
     * Delete
     * @group BrandDescription
     */
    public function destroy(Brand $brand, Description $description, Request $request)
    {
        $description->delete();
        $message = "brand description deleted successfully";
        $description = new DescriptionResource($description);
        return $this->sendResponse(compact('description'), $message);
    }
}
