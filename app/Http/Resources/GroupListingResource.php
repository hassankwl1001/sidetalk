<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupListingResource extends JsonResource
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
            'name'          =>  $this->name,
            'profile_pic'   =>  $this->profile_pic,
            'banner'        =>  $this->banner,
            'about'         =>  $this->about,
            'created_at'    =>  $this->created_at,
            'updated_at'    =>  $this->updated_at,
            'members_count' =>  $this->members_count,
            'is_joined'     =>  isset($this->groupUser[0]) ? 1 : 0
        ];
    }
}
