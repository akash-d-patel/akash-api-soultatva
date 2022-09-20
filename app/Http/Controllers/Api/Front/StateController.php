<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\BaseController;
use App\Models\State;
use Illuminate\Http\Request;
use App\Http\Resources\StateResource;

class StateController extends BaseController
{
    /**
     * List
     * @group State
     */
    public function getStateList(Request $request)
    {
        $states = State::with('creater')->pimp()->get();
        $message = "All records";
        StateResource::collection($states);
        return $this->sendResponse(compact('states'), $message);
    }
}
