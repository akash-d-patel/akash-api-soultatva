<?php

namespace App\Http\Resources\front;

use Illuminate\Http\Resources\Json\JsonResource;

class FeaturedProductResource extends JsonResource
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
                'product_name' => $this->product->name,
                'slug' => $this->product->slug,
                'images' => $this->product->images,
                'subProducts' => $this->product->sub_product,
                'status' => $this->status,
            ];
    }
}
