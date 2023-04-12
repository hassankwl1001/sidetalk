<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EngagementResource extends JsonResource
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
            'engagement_id'             =>  $this->id,
            'date'                      =>  $this->date,
            'time'                      =>  $this->time,
            'user'                      =>  new UserLessResource($this->consultFrom->id == auth()->id() ? $this->consultWith : $this->consultFrom)
        ];
    }
}
