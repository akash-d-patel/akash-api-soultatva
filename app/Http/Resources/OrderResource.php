<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return
            [
                'id' => $this->id,
                'client_id' => $this->client_id,
                'user' => new UserResource($this->user),
                'order_no' => $this->order_no,
                'billing_address_id' => $this->billing_address_id,
                'shipping_address_id' => $this->shipping_address_id,
                'currency' => $this->currency,
                'payment_mode' => $this->payment_mode,
                'order_item' => OrderItemResource::collection($this->order_item),
                'status' => $this->status,
                'created_at' => $this->created_at,
                'created_by' => new UserResource($this->creater)
            ];
    }
}
