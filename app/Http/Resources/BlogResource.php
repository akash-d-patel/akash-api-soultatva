<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
                'title' => $this->title,
                'slug' => $this->slug,
                'short_description' => $this->short_description,
                'long_description' => $this->long_description,
                'status' => $this->status,
                'images' => ImageResource::collection($this->images),
                'meta' => new MetaResource($this->meta),
                'schema' => new SchemaResource($this->schema),
                'created_at' => $this->created_at,
                'created_by' => new UserResource($this->creater)
            ];
    }
}
