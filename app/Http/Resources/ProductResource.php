<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
                'brand' => new BrandResource($this->brand),
                'name' => $this->name,
                'slug' =>$this->slug,
                'images' => ImageResource::collection($this->images),
                'ratings' => ReviewResource::collection($this->reviews),
                'short_description' => $this->short_description,
                'country' => new CountryResource($this->country),
                'food_type' => $this->food_type,
                'link_type' => $this->link_type,
                'link_open_with' => $this->link_open_with,
                'upper_top' => $this->upper_top,
                'top' => $this->top,
                'bottom' => $this->bottom,
                'left' => $this->left,
                'right' => $this->right,
                'status' => $this->status,
                'meta' => new MetaResource($this->meta),
                'schema' => new SchemaResource($this->schema),
                'category_products' => CategoryProductResource::collection($this->whenLoaded('categoryProducts')),
                'sub_product' => SubProductResource::collection($this->sub_product),
                'created_at' => $this->created_at,
                'created_by' => new UserResource($this->creater)
            ];
    }
}
