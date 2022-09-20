<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
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
                'description' => $this->description,
                'types' => $this->types,
                'is_authentication' => $this->is_authentication,
                'status' => $this->status,
                'meta' => new MetaResource($this->meta),
                'schema' => new SchemaResource($this->schema),
                'created_at' => $this->created_at,
                'created_by' => new UserResource($this->creater)
            ];
    }
}
