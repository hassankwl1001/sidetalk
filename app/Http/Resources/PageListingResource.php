<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PageListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'            =>  $this->id,
            'user_id'       =>  $this->user_id,
            'page_type_id'  =>  $this->page_type_id,
            'name'          =>  $this->name,
            'public_url'    =>  $this->public_url,
            'website'       =>  $this->website,
            'industry'      =>  $this->industry,
            'company_size'  =>  $this->company_size,
            'company_type'  =>  $this->company_type,
            'banner'        =>  $this->banner,
            'logo'          =>  $this->logo,
            'tagline'       =>  $this->tagline,
            'about'         =>  $this->about,
            'created_at'    =>  $this->created_at,
            'updated_at'    =>  $this->updated_at,
            'is_followed'   =>  isset($this->pageUser[0]) ? 1 : 0
        ];
    }
}
