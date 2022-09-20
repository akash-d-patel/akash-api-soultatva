<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\OrderItemResource;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Requests\OrderItem\CreateRequest;
use App\Http\Requests\OrderItem\EditRequest;
use App\Models\Inventory;
use App\Models\InventoryHistory;
use App\Models\Order;

class OrderItemController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(OrderItem::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group OrderItem
     */
    public function index(Order $order, Request $request)
    {
        $orderItems = OrderItem::whereHas('order', function ($query) use ($order) {
            $query->where('id', $order->id);
            return $query;
        })->pimp()->paginate();
        $message = "All Records";
        OrderItemResource::collection($orderItems);
        return $this->sendResponse(compact('order', 'orderItems'), $message);
    }

    /**
     * Add
     * @group OrderItem
     */
    public function store(Order $order, OrderItem $orderItem, CreateRequest $request)
    {
        $orderItem = OrderItem::createUpdate($order, $orderItem, $request);
        $message = "Order item added successfully";
        $orderItem = new OrderItemResource($orderItem);
        return $this->sendResponse(compact('orderItem'), $message);
    }

    /**
     * Show
     * @group OrderItem
     */
    public function show(Order $order,OrderItem $orderItem, Request $request)
    {
        $message = 'Order item listed successfully';
        $orderItem = new OrderItemResource($orderItem);
        return $this->sendResponse(compact('orderItem'), $message);
    }

    /**
     * Update
     * @group OrderItem
     */
    public function update(Order $order, EditRequest $request, OrderItem $orderItem)
    {
        $orderItem = OrderItem::createUpdate($order, $orderItem, $request);
        $message = "Order item updated successfully";
        $orderItem = new OrderItemResource($orderItem);
        return $this->sendResponse(compact('orderItem'), $message);
    }

    /**
     * Delete
     * @group OrderItem
     */
    public function destroy(Order $order, OrderItem $orderItem)
    {
        $orderItemData = $order->order_item()->find($orderItem->id);
        $orderItemData->delete();
        $inventory = Inventory::where('sub_product_id',$orderItemData['sub_product_id'])->first();
        $inventory->stock = $inventory->stock + $orderItemData->quantity;
        $inventory->save();
        $inventoryHistory = InventoryHistory::where('inventory_id', $inventory->id)->where( 'order_id', $orderItemData->order_id)->first();
        // $inventoryHistory->stock = $inventoryHistory->stock - $orderItemData->quantity;
        // if( $inventoryHistory->stock < 0) {
        //     $inventoryHistory->stock = 0;
        // } 
        $inventoryHistory->delete();
        $inventoryHistory->save();
        $message = "Order item remove in cart successfully";
        $orderItem = new OrderItemResource($orderItem);
        return $this->sendResponse(compact('orderItem'), $message);
    }
}
