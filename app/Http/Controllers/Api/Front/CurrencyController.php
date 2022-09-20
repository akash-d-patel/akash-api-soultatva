<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\CurrencyResource;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends BaseController
{
    /**
     * show
     * @group Currency
     */
    public function show(Request $request)
    {
        $currency = Currency::pimp()->first();
        $message = "Currency show successfully";
        $currency = new CurrencyResource($currency);
        return $this->sendResponse(compact('currency'), $message);
    }
}
