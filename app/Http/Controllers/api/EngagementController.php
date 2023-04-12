<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EngagementResource;
use App\Models\Consultation;
use Illuminate\Http\Request;

class EngagementController extends Controller
{
    public function getEngagements(){
        $engagements = Consultation::with('consultFrom', 'consultWith')->where('consult_from', auth()->id())
        ->orWhere('consult_with', auth()->id())
        ->paginate(10);

        $engagements = EngagementResource::collection($engagements);
        return response()->success(1, 'list of consultations', $engagements);
    }
}
