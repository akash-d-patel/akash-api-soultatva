<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Requests\Country\CreateRequest;
use App\Http\Requests\Country\EditRequest;
use App\Http\Resources\CountryResource;

class CountryController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Country::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group Country
     */
    public function index(Request $request)
    {
        $countries = Country::with('creater')->pimp()->paginate();
        $message = "All Records";
        CountryResource::collection($countries);
        return $this->sendResponse(compact('countries'), $message);
    }

    /**
     * Add
     * @group Country
     */
    public function store(CreateRequest $request)
    {
        $country = Country::createUpdate(new Country, $request);
        $message = "Country added successfully";
        $country = new CountryResource($country);
        return $this->sendResponse(compact('country'), $message);
    }

    /**
     * Show
     * @group Country
     */
    public function show(Country $country, Request $request)
    {
        $message = 'Country listed successfully';
        $country = new CountryResource($country);
        return $this->sendResponse(compact('country'), $message);
    }

    /**
     * Update
     * @group Country
     */
    public function update(EditRequest $request, Country $country)
    {
        $country = Country::createUpdate($country, $request);
        $message = "Country updated successfully";
        $country = new CountryResource($country);
        return $this->sendResponse(compact('country'), $message);
    }

    /**
     * Delete
     * @group Country
     */
    public function destroy(Country $country, Request $request)
    {
        $country->delete();
        $message = "Country deleted successfully";
        $country = new CountryResource($country);
        return $this->sendResponse(compact('country'), $message);
    }
}
