<?php

namespace App\Http\Resources;

use App\Models\InventoryHistory;
use Illuminate\Http\Resources\Json\JsonResource;

class InventoryResource extends JsonResource
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
                //'client_id' => $this->client_id,
                //'product' => $this->product,
                //'sub_product' => $this->sub_product,
                //'sub_product' => SubProductResource::collection($this->sub_product),
                'min_stock' => $this->min_stock,
                'max_stock' => $this->max_stock,
                'stock' => $this->stock,
                'created_at' => $this->created_at,
                'created_by' => new UserResource($this->creater),
                'inventory_history' => ($this->inventory_history)
            ];
    }
}
