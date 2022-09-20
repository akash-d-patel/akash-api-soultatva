<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubProductResource extends JsonResource
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
                'product_id' => $this->product_id,
                'product_txt' => $this->product['name'] . ' ' . $this->attribute_value['value'] . ' ' . $this->attribute['name'],
                'attribute' => new AttributeResource($this->attribute),
                'attribute_value' => new AttributevalueResource($this->attribute_value),
                'sku_code' => $this->sku_code,
                'asin_code' => $this->asin_code,
                'gtin_code' => $this->gtin_code,
                'hsn_code' => $this->hsn_code,
                'gst' => $this->gst,
                'price' => $this->price,
                'mrp' => $this->mrp,
                'images' => ImageResource::collection($this->images),
                'website_url' => SubProductWebsiteResource::collection($this->subProductWebsites),
                'inventory' => new InventoryResource($this->inventory),
                'meta' => new MetaResource($this->meta),
                'schema' => new SchemaResource($this->schema),
                'status' => $this->status,
                'created_at' => $this->created_at,
                'created_by' => new UserResource($this->creater)
            ];
    }
}
