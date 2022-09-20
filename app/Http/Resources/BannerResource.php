<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
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
                'description' => $this->description,
                'constant' => $this->constant,
                'status' => $this->status,
                'images' => ImageResource::collection($this->images),
                'created_at' => $this->created_at,
                'created_by' => new UserResource($this->creater)
            ];
    }
}
