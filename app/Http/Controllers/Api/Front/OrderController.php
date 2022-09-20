<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Order\EditRequest;
use App\Http\Resources\OrderItemResource;
use App\Http\Resources\OrderResource;
use App\Models\Inventory;
use App\Models\InventoryHistory;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends BaseController
{
    public function myOrder()
    {
        $orders = Order::where('client_id', Auth::user()->client->id)
                        ->where('user_id', Auth::user()->id)
                        ->pimp()->paginate();
        OrderResource::collection($orders);
        return $this->sendResponse(compact('orders'), "My all orders");
    }

    public function cartOrder()
    {
        $order = Order::where('client_id', Auth::user()->client->id)
                        ->where('user_id', Auth::user()->id)
                        ->where('status', '7')->first();
        $order = new OrderResource($order);
        return $this->sendResponse(compact('order'), "My cart Record");
    }

    public function addToCart(Request $request)
    {
        $query = Order::where('user_id', Auth::user()->id)
                        ->where('status', '7')->first();
        if($query) {
            $order = Order::frontOrderCreateUpdate($query, $request);
        } else {
            $order = Order::frontOrderCreateUpdate(new Order, $request);
        }
        $message = "Product is added to cart successfully";
        $order = new OrderResource($order);
        return $this->sendResponse(compact('order'), $message);
    }

    public function removeCart(Order $order, OrderItem $orderItem)
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

    public function badge()
    {
        $order = Order::where('client_id', Auth::user()->client->id)
                        ->where('user_id', Auth::user()->id)
                        ->where('status', '7')->first();
        if($order == null) {
            $badge = 0;
        } else {
            $badge = OrderItem::where('order_id', $order->id)->count();
        }
        return $this->sendResponse(compact('badge'));
    }

    public function MyOrderSearch(Request $request)
    {
        $data = $request->get('search_txt');
        /**
         * Search multiple words and full text
         */
        $search = preg_split('/\s+/', $data, -1, PREG_SPLIT_NO_EMPTY); 

        $order = new Order;
                       
        $order = $order->with('order_item.product.images','order_item.sub_product.images','order_item.user'); 
        /**
         * Searching Logic 
         * */
        $order = $order->where(function($query)  use ($search) {

            foreach ($search as $search_txt) {
                $query->orWhere('user_id', 'LIKE', '%'. $search_txt . '%');
                $query->orWhereHas('order_item.product', function($query) use($search_txt) {
                    $query->where('name', 'LIKE', '%' . $search_txt . '%');
                });
                $query->orWhereHas('order_item.sub_product', function($query) use($search_txt) {
                    $query->where('price', 'LIKE', '%' . $search_txt . '%');
                });
            }
        });
        $order = $order->where('client_id', Auth::user()->client->id)
                       ->where('user_id', Auth::user()->id)
                       ->paginate();  
        return $this->sendResponse(compact('order'));
    }

    public function myOrderDelete(Order $order)
    {
        $order->delete();
        $message = "My order deleted successfully";
        $order = new OrderResource($order);
        return $this->sendResponse(compact('order'), $message);
    }

    /** Order status update api */
    public function orderStatusUpdate(Request $request, Order $order)
    {
        $order->status = 1;
        $order->save();
        $message = 'order status updated successfully..';
        return $this->sendResponse(compact('order'), $message);
    }

    /** Order Update api */
    public function orderUpdate(EditRequest $request, Order $order)
    {
        $order = Order::createUpdate($order, $request);
        $message = "Order updated successfully";
        $order = new OrderResource($order);
        return $this->sendResponse(compact('order'), $message);
    }
}
