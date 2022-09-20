<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Brand\CreateRequest;
use App\Http\Requests\Brand\EditRequest;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Client;

class BrandController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Brand::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group Brand
     */
    public function index(Request $request)
    {
        $brands = Brand::with(['creater'])->pimp()->paginate();
        $message = "All Records";
        BrandResource::collection($brands);
        return $this->sendResponse(compact('brands'), $message);
    }

    /**
     * Add
     * @group Brand
     */
    public function store(CreateRequest $request)
    {
        $brand = Brand::addUpdatedBrands(new Brand, $request);
        $message = "Brand added successfully";
        $brand = new BrandResource($brand);
        return $this->sendResponse(compact('brand'), $message);
    }

    /**
     * show
     * @group Brand
     */
    public function show(Brand $brand, Request $request)
    {
        $message = 'Brand listed sucessfully';
        $brand = new BrandResource($brand);
        return $this->sendResponse(compact('brand'), $message);
    }

    /**
     * Update
     * @group Brand
     */
    public function update(EditRequest $request, Brand $brand)
    {
        $brand = Brand::addUpdatedBrands($brand, $request);
        $message = "Brand updated successfully";
        $brand = new BrandResource($brand);
        return $this->sendResponse(compact('brand'), $message);
    }

    /**
     * Delete
     * @group Brand
     */
    public function destroy(Brand $brand, Request $request)
    {
        $brand->delete();
        $message = "Brand deleted successfully";
        $brand = new BrandResource($brand);
        return $this->sendResponse(compact('brand'), $message);
    }
}
