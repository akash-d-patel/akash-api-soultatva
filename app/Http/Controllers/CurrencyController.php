<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Requests\Currency\CreateRequest;
use App\Http\Requests\Currency\EditRequest;
use App\Http\Resources\CurrencyResource;
use App\Http\Controllers\Api\BaseController;

class CurrencyController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Currency::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group Currency
     */
    public function index(Request $request, Currency $currency)
    {
        $currencies = $currency->pimp()->paginate();
        CurrencyResource::collection($currencies);
        return $this->sendResponse(compact('currencies'), "All Record");
    }

    /**
     * Add
     * @group Currency
     */
    public function store(CreateRequest $request)
    {
        $currency = Currency::addUpdate(new Currency, $request);
        $message = "Currency added successfully";
        $currency = new CurrencyResource($currency);
        return $this->sendResponse(compact('currency'), $message);
    }

    /**
     * Show
     * @group Currency
     */
    public function show(Currency $currency, Request $request)
    {
        $message = 'Currency listed successfully';
        $currency = new CurrencyResource($currency);
        return $this->sendResponse(compact('currency'), $message);
    }

    /**
     * Update
     * @group Currency
     */
    public function update(EditRequest $request, Currency $currency)
    {
        $currency = Currency::addUpdate($currency, $request);
        $message = "Currency updated successfully";
        $currency = new CurrencyResource($currency);
        return $this->sendResponse(compact('currency'), $message);
    }

    /**
     * Delete
     * @group Currency
     */
    public function destroy(Currency $currency, Request $request)
    {
        $currency->delete();
        $message = "Currency deleted successfully";
        $currency = new CurrencyResource($currency);
        return $this->sendResponse(compact('currency'), $message);
    }
}
