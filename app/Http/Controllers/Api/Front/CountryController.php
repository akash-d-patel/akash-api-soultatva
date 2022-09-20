<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\BaseController;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Resources\CountryResource;

class CountryController extends BaseController
{
    /**
     * List
     * @group Country
     */
    public function getCountryList(Request $request)
    {
        $countries = Country::with('creater')->pimp()->get();
        $message = "All Records";
        CountryResource::collection($countries);
        return $this->sendResponse(compact('countries'), $message);
    }
}
