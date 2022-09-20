<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests\Order\CreateRequest;
use App\Http\Requests\Order\EditRequest;
use App\Models\Address;
use App\Models\OrderItem;

use function App\Helpers\getSchedulerApiData;

class OrderController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Order::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group Order
     */
    public function index()
    {
        $orders = Order::with('creater')->pimp()->paginate();
        OrderResource::collection($orders);
        return $this->sendResponse(compact('orders'), "All Record");
    }

    /**
     * Add
     * @group Order
     */
    public function store(Request $request)
    {
        $order = Order::createUpdate(new Order, $request);
        $message = "Order added successfully";
        $order = new OrderResource($order);
            /*
            * Send email on order with scheduler
            */
            $arrTemplateConstant = [];
            /**  Variable need to be change in template*/
            $arrTemplateConstant['#WEBSITE#'] = "Soultatva";
            $arrTemplateConstant['#LOGO-PATH#'] = "https://www.soultatva.com/images/sharing-logo.png";
            $arrTemplateConstant['#USER-NAME#'] = $order->user->name;
            $arrTemplateConstant['#ORDER-NO#'] = $order->order_no;

            $order = Order::find($order->id);
            $orderShippingAddress = $order->shipping_address_id;
            $orderBillingAddress = $order->billing_address_id;
            $shipAddress = Address::find($orderShippingAddress);
            $billAddress = Address::find($orderBillingAddress);
            $shippingAddress = $shipAddress->address_line1;
            $billingAddress = $billAddress->address_line1;

            $arrTemplateConstant['#SHIPPING-ADDRESS#'] = $shippingAddress;
            $arrTemplateConstant['#BILLING-ADDRESS#'] = $billingAddress;

            $orderItems = OrderItem::where('order_id', $order->id)->get();
            $total = 0;
            foreach($orderItems as $value) {
                $total = $total + $value->amount;
            }
            $subTotal = $total;
            $promoCodeDiscount = 00;
            $shippingCharge = 00;
            $orderTotal = $subTotal + $shippingCharge;
            $arrTemplateConstant['#SUBTOTAL#'] = $subTotal;
            $arrTemplateConstant['#SUBTOTAL-TITLE#'] = 'Total';
            $arrTemplateConstant['#PROMO-DISCOUNT-TITLE#'] = 'Promo code';
            $arrTemplateConstant['#PROMO-DISCOUNT#'] = $promoCodeDiscount;
            $arrTemplateConstant['#SHIPPING-CHARGE#'] = $shippingCharge;
            $arrTemplateConstant['#ORDER-TOTAL#'] = $orderTotal;

            if($order->status == 1) {

                $request->request->add(['client_id' =>  $order->client_id]);
                $request->request->add(['project_id' =>  1]);
                $request->request->add(['status' =>  'Send']);
                $request->request->add(['from_email' =>  'admin@soultatva.com']);
                $request->request->add(['to_email' =>  $order->user->email]);
                $request->request->add(['subject' =>  'Order Paid']);
                if($order->client_id == 2) {
                    $request->request->add(['email_template_id' =>  32]);
                    $request->request->add(['template' =>  '32_order_paid']); 
                } else {
                    $request->request->add(['email_template_id' =>  9]);
                    $request->request->add(['template' =>  '09_order_paid']); 
                }    

            } else if($order->status == 2) {

                $request->request->add(['client_id' =>  $order->client_id]);
                $request->request->add(['project_id' =>  1]);
                $request->request->add(['status' =>  'Send']);
                $request->request->add(['from_email' =>  'admin@soultatva.com']);
                $request->request->add(['to_email' =>  $order->user->email]);
                $request->request->add(['subject' =>  'Order On Hold']);
                if($order->client_id == 2) {
                    $request->request->add(['email_template_id' =>  30]);
                    $request->request->add(['template' =>  '30_order_on_hold']);
                } else {
                    $request->request->add(['email_template_id' =>  7]);
                    $request->request->add(['template' =>  '07_order_on_hold']);
                }
            
            } else if($order->status == 3) {

                $request->request->add(['client_id' =>  $order->client_id]);
                $request->request->add(['project_id' =>  1]);
                $request->request->add(['status' =>  'Send']);
                $request->request->add(['from_email' =>  'admin@soultatva.com']);
                $request->request->add(['to_email' =>  $order->user->email]);
                $request->request->add(['subject' =>  'Order Cancelled']);
                if($order->client_id == 2) {
                    $request->request->add(['email_template_id' =>  28]);
                    $request->request->add(['template' =>  '28_order_cancelled']);
                } else {
                    $request->request->add(['email_template_id' =>  5]);
                    $request->request->add(['template' =>  '05_order_cancelled']);
                }
            
            } else if($order->status == 4) {

                $request->request->add(['client_id' =>  $order->client_id]);
                $request->request->add(['project_id' =>  1]);
                $request->request->add(['status' =>  'Send']);
                $request->request->add(['from_email' =>  'admin@soultatva.com']);
                $request->request->add(['to_email' =>  $order->user->email]);
                $request->request->add(['subject' =>  'Order Shipped']);
                if($order->client_id == 2) {
                    $request->request->add(['email_template_id' =>  31]);
                    $request->request->add(['template' =>  '31_order_shipped']);
                } else {
                    $request->request->add(['email_template_id' =>  8]);
                    $request->request->add(['template' =>  '08_order_shipped']);
                }

            } else if($order->status == 5){

                $request->request->add(['client_id' =>  $order->client_id]);
                $request->request->add(['project_id' =>  1]);
                $request->request->add(['status' =>  'Send']);
                $request->request->add(['from_email' =>  'admin@soultatva.com']);
                $request->request->add(['to_email' =>  $order->user->email]);
                $request->request->add(['subject' =>  'Order Completed']);
                if($order->client_id == 2) {
                    $request->request->add(['email_template_id' =>  29]);
                    $request->request->add(['template' =>  '29_order_completed']);
                } else{
                    $request->request->add(['email_template_id' =>  6]);
                    $request->request->add(['template' =>  '06_order_completed']);
                }    

            } else if($order->status == 6) {

                $request->request->add(['client_id' =>  $order->client_id]);
                $request->request->add(['project_id' =>  1]);
                $request->request->add(['status' =>  'Send']);
                $request->request->add(['from_email' =>  'admin@soultatva.com']);
                $request->request->add(['to_email' =>  $order->user->email]);
                $request->request->add(['subject' =>  'Order Failed']);
                if($order->client_id == 2) {
                    $request->request->add(['email_template_id' =>  33]);
                    $request->request->add(['template' =>  '33_order_failed']);
                } else {
                    $request->request->add(['email_template_id' =>  10]);
                    $request->request->add(['template' =>  '10_order_failed']);
                }

            } else if($order->status == 8) {

                $request->request->add(['client_id' =>  $order->client_id]);
                $request->request->add(['project_id' =>  1]);
                $request->request->add(['status' =>  'Send']);
                $request->request->add(['from_email' =>  'admin@soultatva.com']);
                $request->request->add(['to_email' =>  $order->user->email]);
                $request->request->add(['subject' =>  'Order Refund']);
                if($order->client_id == 2) {
                    $request->request->add(['email_template_id' =>  46]);
                    $request->request->add(['template' =>  '46_order_refund']);
                } else {
                    $request->request->add(['email_template_id' =>  23]);
                    $request->request->add(['template' =>  '23_order_refund']);
                }

            }

            $request->request->add(['template_var' =>  json_encode($arrTemplateConstant)]);
            getSchedulerApiData($request);

        return $this->sendResponse(compact('order'), $message);
    }

    /**
     * Show
     * @group Order
     */
    public function show(Order $order)
    {
        $message = 'Order listed successfully';
        $order = new OrderResource($order);
        return $this->sendResponse(compact('order'), $message);
    }

    /**
     * Update
     * @group Order
     */
    public function update(Request $request, Order $order)
    {
        $order = Order::createUpdate($order, $request);
        $message = "Order updated successfully";
        $order = new OrderResource($order);
       
            /*
            * Send email on order with scheduler
            */
            $arrTemplateConstant = [];
            /**  Variable need to be change in template*/
            $arrTemplateConstant['#WEBSITE#'] = "Soultatva";
            $arrTemplateConstant['#LOGO-PATH#'] = "https://www.soultatva.com/images/sharing-logo.png";
            $arrTemplateConstant['#USER-NAME#'] = $order->user->name;
            $arrTemplateConstant['#ORDER-NO#'] = $order->order_no;

            $order = Order::find($order->id);
            $orderShippingAddress = $order->shipping_address_id;
            $orderBillingAddress = $order->billing_address_id;
            $shipAddress = Address::find($orderShippingAddress);
            $billAddress = Address::find($orderBillingAddress);
            $shippingAddress = $shipAddress->address_line1;
            $billingAddress = $billAddress->address_line1;

            $arrTemplateConstant['#SHIPPING-ADDRESS#'] = $shippingAddress;
            $arrTemplateConstant['#BILLING-ADDRESS#'] = $billingAddress;

            $orderItems = OrderItem::where('order_id', $order->id)->get();
            $total = 0;
            foreach($orderItems as $value) {
                $total = $total + $value->amount;
            }
            $subTotal = $total;
            $promoCodeDiscount = 00;
            $shippingCharge = 00;
            $orderTotal = $subTotal + $shippingCharge;
            $arrTemplateConstant['#SUBTOTAL#'] = $subTotal;
            $arrTemplateConstant['#SUBTOTAL-TITLE#'] = 'Total';
            $arrTemplateConstant['#PROMO-DISCOUNT-TITLE#'] = 'Promo code';
            $arrTemplateConstant['#PROMO-DISCOUNT#'] = $promoCodeDiscount;
            $arrTemplateConstant['#SHIPPING-CHARGE#'] = $shippingCharge;
            $arrTemplateConstant['#ORDER-TOTAL#'] = $orderTotal;

            if($order->status == 1) {

                $request->request->add(['client_id' =>  $order->client_id]);
                $request->request->add(['project_id' =>  1]);
                $request->request->add(['status' =>  'Send']);
                $request->request->add(['from_email' =>  'admin@soultatva.com']);
                $request->request->add(['to_email' =>  $order->user->email]);
                $request->request->add(['subject' =>  'Order Paid']);
                if($order->client_id == 2) {
                    $request->request->add(['email_template_id' =>  32]);
                    $request->request->add(['template' =>  '32_order_paid']);  
                } else {
                    $request->request->add(['email_template_id' =>  9]);
                    $request->request->add(['template' =>  '09_order_paid']); 
                }   

            } else if($order->status == 2) {

                $request->request->add(['client_id' =>  $order->client_id]);
                $request->request->add(['project_id' =>  1]);
                $request->request->add(['status' =>  'Send']);
                $request->request->add(['from_email' =>  'admin@soultatva.com']);
                $request->request->add(['to_email' =>  $order->user->email]);
                $request->request->add(['subject' =>  'Order On Hold']);
                if($order->client_id == 2) {
                    $request->request->add(['email_template_id' =>  30]);
                    $request->request->add(['template' =>  '30_order_on_hold']);
                } else {
                    $request->request->add(['email_template_id' =>  7]);
                    $request->request->add(['template' =>  '07_order_on_hold']);
                }
            
            } else if($order->status == 3) {

                $request->request->add(['client_id' =>  $order->client_id]);
                $request->request->add(['project_id' =>  1]);
                $request->request->add(['status' =>  'Send']);
                $request->request->add(['from_email' =>  'admin@soultatva.com']);
                $request->request->add(['to_email' =>  $order->user->email]);
                $request->request->add(['subject' =>  'Order Cancelled']);
                if($order->client_id == 2) {
                    $request->request->add(['email_template_id' =>  28]);
                    $request->request->add(['template' =>  '28_order_cancelled']);
                } else {
                    $request->request->add(['email_template_id' =>  5]);
                    $request->request->add(['template' =>  '05_order_cancelled']);
                }
            
            } else if($order->status == 4) {

                $request->request->add(['client_id' =>  $order->client_id]);
                $request->request->add(['project_id' =>  1]);
                $request->request->add(['status' =>  'Send']);
                $request->request->add(['from_email' =>  'admin@soultatva.com']);
                $request->request->add(['to_email' =>  $order->user->email]);
                $request->request->add(['subject' =>  'Order Shipped']);
                if($order->client_id == 2) {
                    $request->request->add(['email_template_id' =>  31]);
                    $request->request->add(['template' =>  '31_order_shipped']);
                } else {
                    $request->request->add(['email_template_id' =>  8]);
                    $request->request->add(['template' =>  '08_order_shipped']);
                }

            } else if($order->status == 5){

                $request->request->add(['client_id' =>  $order->client_id]);
                $request->request->add(['project_id' =>  1]);
                $request->request->add(['status' =>  'Send']);
                $request->request->add(['from_email' =>  'admin@soultatva.com']);
                $request->request->add(['to_email' =>  $order->user->email]);
                $request->request->add(['subject' =>  'Order Completed']);
                if($order->client_id == 2) {
                    $request->request->add(['email_template_id' =>  29]);
                    $request->request->add(['template' =>  '29_order_completed']); 
                } else {
                    $request->request->add(['email_template_id' =>  6]);
                    $request->request->add(['template' =>  '06_order_completed']);
                } 

            } else if($order->status == 6) {

                $request->request->add(['client_id' =>  $order->client_id]);
                $request->request->add(['project_id' =>  1]);
                $request->request->add(['status' =>  'Send']);
                $request->request->add(['from_email' =>  'admin@soultatva.com']);
                $request->request->add(['to_email' =>  $order->user->email]);
                $request->request->add(['subject' =>  'Order Failed']);
                if($order->client_id == 2) {
                    $request->request->add(['email_template_id' =>  33]);
                    $request->request->add(['template' =>  '33_order_failed']);
                } else {
                    $request->request->add(['email_template_id' =>  10]);
                    $request->request->add(['template' =>  '10_order_failed']);
                }

            } else if($order->status == 8) {

                $request->request->add(['client_id' =>  $order->client_id]);
                $request->request->add(['project_id' =>  1]);
                $request->request->add(['status' =>  'Send']);
                $request->request->add(['from_email' =>  'admin@soultatva.com']);
                $request->request->add(['to_email' =>  $order->user->email]);
                $request->request->add(['subject' =>  'Order Refund']);
                if($order->client_id == 2) {
                    $request->request->add(['email_template_id' =>  46]);
                    $request->request->add(['template' =>  '46_order_refund']);
                } else {
                    $request->request->add(['email_template_id' =>  23]);
                    $request->request->add(['template' =>  '23_order_refund']);
                }

            }

            $request->request->add(['template_var' =>  json_encode($arrTemplateConstant)]);
            getSchedulerApiData($request);
         
        return $this->sendResponse(compact('order'), $message);
    }

    /**
     * Delete
     * @group Order
     */
    public function destroy(Order $order)
    {
        $order->delete();
        $message = "Order deleted successfully";
        $order = new OrderResource($order);
        return $this->sendResponse(compact('order'), $message);
    }
}
