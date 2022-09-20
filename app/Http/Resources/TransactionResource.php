<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
                'user_id' => $this->user_id,
                'order_id' => $this->order_id,
                'total' => $this->total,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'phone' => $this->phone,
                'product_info' => $this->product_info,
                'service_provider' => $this->service_provider,
                'zipcode' => $this->zipcode,
                'city' => $this->city,
                'state' => $this->state,
                'country' => $this->country,
                'address1' => $this->address1,
                'address2' => $this->address2,
                'status' => $this->status,
                'created_at' => $this->created_at,
                'created_by' => new UserResource($this->creater)
            ];
    }
}
