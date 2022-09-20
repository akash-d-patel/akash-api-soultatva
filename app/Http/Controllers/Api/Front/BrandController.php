<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends BaseController
{
    /**
     * List
     * @group Brand
     */
    public function list(Request $request)
    {
        $brands = Brand::with(['creater'])->pimp()->paginate();
        $message = "All Records";
        BrandResource::collection($brands);
        return $this->sendResponse(compact('brands'), $message);
    }

    /**
     * Show
     * @group Brand
     */
    public function show(Brand $brand, Request $request)
    {
        $message = 'Brand listed successfully';
        $brand = new BrandResource($brand);
        return $this->sendResponse(compact('brand'), $message);
    }
}
