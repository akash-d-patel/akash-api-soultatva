<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MetaResource extends JsonResource
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
                'meta_title' => $this->meta_title,
                'meta_description' => $this->meta_description,
                'meta_keywords' => $this->meta_keywords,
                'show_redirect_popup' => $this->show_redirect_popup,
                'p_domain_verify' => $this->p_domain_verify,
                'og_title' => $this->og_title,
                'og_url' => $this->og_url,
                'og_image' => $this->og_image,
                'og_image_secure_url' => $this->og_image_secure_url,
                'og_description' => $this->og_description,
                'og_site_name' => $this->og_site_name,
                'og_type' => $this->og_type,
                'og_price_amount' => $this->og_price_amount,
                'og_price_currency' => $this->og_price_currency,
                'ahrefs_site_verification' => $this->ahrefs_site_verification,
                'robots' => $this->robots,
                'google_site_verification' => $this->google_site_verification,
                'twitter_card' => $this->twitter_card,
                'twitter_title' => $this->twitter_title,
                'twitter_site' => $this->twitter_site,
                'twitter_description' => $this->twitter_description,
                'twitter_image' => $this->twitter_image,
                'twitter_creator' => $this->twitter_creator,
                'created_at' => $this->created_at,
                'created_by' => new UserResource($this->creater)
            ];
    }
}
