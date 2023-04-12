<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\EmployeeTypes;
use Illuminate\Http\Request;

class GenericController extends Controller
{
    public function getCountries(){
        $countries = Country::select('id', 'name')->orderBy('name', 'ASC')->get();
        return response()->success(1, 'List of countries', $countries);
    }

    public function getEmploymentTypes(){
        $employmentTypes = EmployeeTypes::select('id', 'name')->orderBy('name', 'ASC')->get();
        return response()->success(1, 'list of employment types', $employmentTypes);
    }
}
