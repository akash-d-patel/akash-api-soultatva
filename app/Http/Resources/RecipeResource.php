<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
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
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'title' => $this->title,
                'slug' => $this->slug,
                'description' => $this->description,
                'ingredient' => $this->ingredient,
                'method' => $this->method,
                'approval_status' => $this->approval_status,
                'approval_by' => $this->approval_by,
                'images' => ImageResource::collection($this->images),
                'ratings' => ReviewResource::collection($this->reviews),
                'meta' => new MetaResource($this->meta),
                'schema' => new SchemaResource($this->schema),
                'created_at' => $this->created_at,
                'created_by' => new UserResource($this->creater)
            ];
    }
}
