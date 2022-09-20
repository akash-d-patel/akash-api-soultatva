<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\OrderAddressResource;
use App\Models\OrderAddress;
use App\Http\Requests\OrderAddress\CreateRequest;
use App\Http\Requests\OrderAddress\EditRequest;

class OrderAddressController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(OrderAddress::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group OrderAddress
     */
    public function index()
    {
        $orderAddresses = OrderAddress::with('creater')->pimp()->paginate();
        OrderAddressResource::collection($orderAddresses);
        return $this->sendResponse(compact('orderAddresses'), "All Record");
    }

    /**
     * Add
     * @group OrderAddress
     */
    public function store(CreateRequest $request)
    {
        $orderAddress = OrderAddress::createUpdate(new OrderAddress, $request);
        $message = "Order Address added successfully";
        $orderAddress = new OrderAddressResource($orderAddress);
        return $this->sendResponse(compact('orderAddress'), $message);
    }

    /**
     * Show
     * @group OrderAddress
     */
    public function show(OrderAddress $orderAddress)
    {
        $message = 'Order Address listed successfully';
        $orderAddress = new OrderAddressResource($orderAddress);
        return $this->sendResponse(compact('orderAddress'), $message);
    }

    /**
     * Update
     * @group OrderAddress
     */
    public function update(EditRequest $request, OrderAddress $orderAddress)
    {
        $orderAddress = OrderAddress::createUpdate($orderAddress, $request);
        $message = "Order Address updated successfully";
        $orderAddress = new OrderAddressResource($orderAddress);
        return $this->sendResponse(compact('orderAddress'), $message);
    }

    /**
     * Delete
     * @group OrderAddress
     */
    public function destroy(OrderAddress $orderAddress)
    {
        $orderAddress->delete();
        $message = "Order Address deleted successfully";
        $orderAddress = new OrderAddressResource($orderAddress);
        return $this->sendResponse(compact('orderAddress'), $message);
    }
}
