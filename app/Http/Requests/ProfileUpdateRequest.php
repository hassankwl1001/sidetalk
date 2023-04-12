<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstname'             =>  'required',
            'lastname'              =>   'required',
            'country'               =>  'required',
            'city'                  =>  'required',
            'job_title'             =>  'required',
            'employee_type_id'      =>  'required',
            'recent_company'        =>  'required|sometimes|nullable',
            'is_student'            =>  'required|sometimes|nullable',
            'session_price'         =>  'required|sometimes|nullable',
            'headline'              =>  'required|sometimes|nullable',
            'current_position'      =>  'required|sometimes|nullable',
            'education'             =>  'required|sometimes|nullable',
            'recent_company'        =>  'required|sometimes|nullable',
            'work_location'         =>  'required|sometimes|nullable',
            'industry'              =>  'required|sometimes|nullable',
            'sub_industry'          =>  'required|sometimes|nullable',


        ];
    }

    public function store(){
        return  User::updateOrCreate(['id' => auth()->user()->id], $this->validated());
    }
}
