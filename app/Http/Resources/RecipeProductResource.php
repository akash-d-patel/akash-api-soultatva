<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecipeProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'client_id' => $this->client_id,
            'recipe' => new RecipeResource($this->whenLoaded('recipe')),
            'product' => new ProductResource($this->whenLoaded('product')),
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => new UserResource($this->whenLoaded('creater'))
        ];
    }
}
