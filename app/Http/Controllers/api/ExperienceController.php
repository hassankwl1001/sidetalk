<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function userExperienceList(){
        $experienceList = auth()->user()->experience()->get();
        return response()->success(1, 'List of user experience', $experienceList);
    }

    public function updateOrCreate(Request $request){
        $request->validate([
            'id'                        =>  'required|exists:experiences,id|sometimes',
            'title'                     => 'required|string',
            'employee_type_id'          =>  'required',
            'company'                   =>  'required',
            'start_date'                =>  'required',
            'end_date'                  =>  'required',
            'responsibility'            =>  'required',
            'location'                  =>  'required'
        ]);

       $experience =  auth()->user()->experience()->UpdateOrCreate(['id' => $request->id],$request->all());

        if($experience->wasRecentlyCreated){
            return response()->success(1, 'Experience added successfully', $experience);
        }

        return response()->success(1, 'experience updated successfully', $experience);
    }
}
