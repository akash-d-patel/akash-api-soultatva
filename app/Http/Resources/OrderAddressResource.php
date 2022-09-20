<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderAddressResource extends JsonResource
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
                'country' => new CountryResource($this->country),
                'state' => new StateResource($this->state),
                'city' => new CityResource($this->city),
                'order' => new OrderAddressResource($this->order),
                'address1' => $this->address1,
                'address2' => $this->address2,
                'zip_code' => $this->zip_code,
                'created_at' => $this->created_at,
                'created_by' => new UserResource($this->creater)
            ];
    }
}
