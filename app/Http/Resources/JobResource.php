<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
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
            'job_poster'    =>  $this->jobs->job_poster,
            'company'       =>  $this->jobs->company,
            'job_title'     =>  $this->jobs->job_title,
            'location'      =>  $this->jobs->location,
            'applicants'    =>  $this->user_applicant_count,
            'created_at'    =>  $this->created_at->diffForHumans()
        ];
    }
}
