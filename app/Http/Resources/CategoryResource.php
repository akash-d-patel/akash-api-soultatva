<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
                'parent_id' => $this->parent_id,
                'name' => $this->name,
                'slug' =>$this->slug,
                'description' => $this->description,
                'link_type' => $this->link_type,
                'link_open_with' => $this->link_open_with,
                'upper_top' => $this->upper_top,
                'top' => $this->top,
                'bottom' => $this->bottom,
                'left' => $this->left,
                'right' => $this->right,
                'status' => $this->status,
                'category_products' => CategoryProductResource::collection($this->whenLoaded('categoryProducts')),
                'meta' => new MetaResource($this->meta),
                'schema' => new SchemaResource($this->schema),
                'created_at' => $this->created_at,
                'created_by' => new UserResource($this->creater)
            ];
    }
}
