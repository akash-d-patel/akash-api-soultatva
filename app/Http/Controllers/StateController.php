<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Models\State;
use Illuminate\Http\Request;
use App\Http\Requests\State\CreateRequest;
use App\Http\Requests\State\EditRequest;
use App\Http\Resources\StateResource;

class StateController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(State::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group State
     */
    public function index(Request $request)
    {
        $states = State::with('creater')->pimp()->paginate();
        $message = "All records";
        StateResource::collection($states);
        return $this->sendResponse(compact('states'), $message);
    }

    /**
     * Add
     * @group State
     */
    public function store(CreateRequest $request)
    {
        $state = State::createUpdate(new State, $request);
        $message = "State added successfully";
        $state = new StateResource($state);
        return $this->sendResponse(compact('state'), $message);
    }

    /**
     * Show
     * @group State
     */
    public function show(State $state)
    {
        $message = 'State listed successfully';
        $state = new StateResource($state);
        return $this->sendResponse(compact('state'), $message);
    }

    /**
     * Update
     * @group State
     */
    public function update(EditRequest $request, State $state)
    {
        $state = State::createUpdate($state, $request);
        $message = "State updated successfully";
        $state = new StateResource($state);
        return $this->sendResponse(compact('state'), $message);
    }

    /**
     * Delete
     * @group State
     */
    public function destroy(State $state, Request $request)
    {
        $state->delete();
        $message = "State deleted successfully";
        $state = new StateResource($state);
        return $this->sendResponse(compact('state'), $message);
    }

    public function getStateList(Request $request)
    {
        $states = State::with('creater')->pimp()->get();
        $message = "All records";
        StateResource::collection($states);
        return $this->sendResponse(compact('states'), $message);
    }
}
