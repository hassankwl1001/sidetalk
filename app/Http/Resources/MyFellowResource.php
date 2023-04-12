<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MyFellowResource extends JsonResource
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
            'request_id'        =>  $this->id,
            'request_status'    =>  $this->is_accepted,
            'fellow'            =>  new UserLessResource($this->sender->id == auth()->id() ? $this->receiver : $this->sender)
        ];
    }
}
