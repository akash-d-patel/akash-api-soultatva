<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Requests\City\CreateRequest;
use App\Http\Requests\City\EditRequest;
use App\Http\Resources\CityResource;

class CityController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(City::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group City
     */
    public function index(Request $request)
    {
        $cities = City::with('creater')->pimp()->paginate();
        $message = "All Records";
        CityResource::collection($cities);
        return $this->sendResponse(compact('cities'), $message);
    }

    /**
     * Add
     * @group City
     */
    public function store(CreateRequest $request)
    {
        $city = City::createUpdate(new City, $request);
        $message = "City added successfully";
        $city = new CityResource($city);
        return $this->sendResponse(compact('city'), $message);
    }

    /**
     * Show
     * @group City
     */
    public function show(City $city, Request $request)
    {
        $message = 'City listed successfully';
        $city = new CityResource($city);
        return $this->sendResponse(compact('city'), $message);
    }

    /**
     * Update
     * @group City
     */
    public function update(EditRequest $request, City $city)
    {
        $city = City::createUpdate($city, $request);
        $message = "City updated successfully";
        $city = new CityResource($city);
        return $this->sendResponse(compact('city'), $message);
    }

    /**
     * Delete
     * @group City
     */
    public function destroy(City $city, Request $request)
    {
        $city->delete();
        $message = "City deleted successfully";
        $city = new CityResource($city);
        return $this->sendResponse(compact('city'), $message);
    }

    public function getCityList(Request $request)
    {
        $cities = City::with('creater')->pimp()->get();
        $message = "All Records";
        CityResource::collection($cities);
        return $this->sendResponse(compact('cities'), $message);
    }
}
