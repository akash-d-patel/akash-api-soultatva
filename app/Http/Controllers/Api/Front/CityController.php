<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\BaseController;
use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Resources\CityResource;

class CityController extends BaseController
{
    /**
     * List
     * @group City
     */
    public function getCityList(Request $request)
    {
        $cities = City::with('creater')->pimp()->get();
        $message = "All Records";
        CityResource::collection($cities);
        return $this->sendResponse(compact('cities'), $message);
    }
}
