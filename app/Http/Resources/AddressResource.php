<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return
            [
                'id' => $this->id,
                'client_id' => $this->client_id,
                'name' => $this->name,
                'mobile_no' => $this->mobile_no,
                'address_line1' => $this->address_line1,
                'address_line2' => $this->address_line2,
                'landmark' => $this->landmark,
                'country' => new CountryResource($this->country),
                'state' => new StateResource($this->state),
                'city' => new CityResource($this->city),
                'pin_code' => $this->pin_code,
                'type' => $this->type,
                'status' => $this->status,
                'created_at' => $this->created_at,
                'created_by' => new UserResource($this->creater)
            ];
    }
}
