<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\User;
use Illuminate\Http\Request;

class EngagementController extends Controller
{
    public function list(){
        $engagement = Consultation::with('consultFrom', 'consultWith')->where('consult_from', auth()->id())
        ->orwhere(function ($query) {
            $query->where('consult_with', auth()->id());
        })
        ->get();

//        $profileUrl = env('PROFILE_URL');

        $profileUrl = url('/')."/storage/app/media";
        return view('engagements')->with(compact('engagement', 'profileUrl'));
    }
    public function verify($id){
        $engagement = Consultation::findorfail($id);
        $engagement->is_approved=1;
        $engagement->save();

        $user = User::findOrFail($engagement->consult_with);
        $currentBalance = $user->balance;
        $user->update([
            'balance'   =>  $currentBalance + $engagement->actual_payment_earned
        ]);

        return back()->with('success','verify successfully');
    }
}
