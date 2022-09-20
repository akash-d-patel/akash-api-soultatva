<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\InventoryHistory\CreateRequest;
use App\Http\Requests\InventoryHistory\EditRequest;
use App\Http\Resources\InventoryHistoryResource;
use App\Models\InventoryHistory;
use Illuminate\Http\Request;

class InventoryHistoryController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(InventoryHistory::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group InventoryHistory
     */
    public function index()
    {

        $inventoryHistories = InventoryHistory::with('creater')->pimp()->paginate();
        $message = "All Records";
        InventoryHistoryResource::collection($inventoryHistories);
        return $this->sendResponse(compact('inventoryHistories'), $message);
    }

    /**
     * Add
     * @group InventoryHistory
     */
    public function store(CreateRequest $request)
    {
       //
    }

    /**
     * Show
     * @group InventoryHistory
     */
    public function show(InventoryHistory $inventoryHistory)
    {
        $message = 'Inventory History listed successfully';
        $inventoryHistory = new InventoryHistoryResource($inventoryHistory);
        return $this->sendResponse(compact('inventoryHistory'), $message);
    }

    /**
     * Update
     * @group InventoryHistory
     */
    public function update(EditRequest $request, InventoryHistory $inventoryHistory)
    {
       //
    }

    /**
     * Delete
     * @group InventoryHistory
     */
    public function destroy(InventoryHistory $inventoryHistory)
    {
        $inventoryHistory->delete();
        $message = "Inventory History deleted successfully";
        $inventoryHistory = new InventoryHistoryResource($inventoryHistory);
        return $this->sendResponse(compact('inventoryHistory'), $message);
    }
}
