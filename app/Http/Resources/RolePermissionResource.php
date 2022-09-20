<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RolePermissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'role' => new RoleResource($this->whenLoaded('role')),
            'permission' => new PermissionResource($this->whenLoaded('permission')),
            'created_at' => $this->created_at,
            'created_by' => new UserResource($this->whenLoaded('creater'))

        ];
    }
}
