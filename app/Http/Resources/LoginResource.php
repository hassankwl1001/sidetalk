<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
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
            'id'                =>  $this->id,
            'token'             =>  $this->token,
            'firstname'         =>  $this->firstname,
            'lastname'          =>  $this->lastname,
            'email'             =>  $this->email,
            'experience'        =>  $this->experience,
            'profile_pic'       =>  $this->profile_pic,
            'banner'            =>  $this->banner,
            'rating'            =>  $this->rating,
            'headline'          =>  $this->headline,
            'current_position'  =>  $this->current_position,
            'education'         =>  $this->education,
            'country'           =>  $this->country,
            'city'              =>  $this->city,
            'work_location'     =>  $this->work_location,
            'industry'          =>  $this->industry,
            'sub_industry'      =>  $this->sub_industry,
            'job_title'         =>  $this->job_title,
            'recent_company'    =>  $this->recent_company,
            'is_student'        =>  $this->is_student,
            'session_price'     =>  $this->session_price

        ];
    }
}
