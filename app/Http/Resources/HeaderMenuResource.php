<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HeaderMenuResource extends JsonResource
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
                'parent_id' => $this->parent_id,
                'name' => $this->name,
                'label' => $this->label,
                'url' => $this->url,
                'order' => $this->order,
                'link_type' => $this->link_type,
                'link_open_with' => $this->link_open_with,
                'upper_top' => $this->upper_top,
                'top' => $this->top,
                'bottom' => $this->bottom,
                'left' => $this->left,
                'right' => $this->right,
                'is_authentication' => $this->is_authentication,
                'status' => $this->status,
                'created_at' => $this->created_at,
                'created_by' => new UserResource($this->creater)
            ];
    }
}
