<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserLessResource extends JsonResource
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
            'id'                        =>  $this->id,
            'firstname'                 =>  $this->firstname,
            'lastname'                  =>  $this->lastname,
            'profile_pic'               =>  $this->profile_pic,
            'banner'                    =>  $this->banner,
            'current_position'          =>  $this->current_position,
            'heading'                   =>  $this->headline
        ];
    }
}
