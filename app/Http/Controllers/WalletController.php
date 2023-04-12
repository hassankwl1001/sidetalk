<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Ebank;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function wallet(){

//        $engagement = Consultation::with('consultFrom', 'consultWith')
//        ->where(function($query){
//            $query->where('consult_from', '!=', auth()->id());
//        })
//        ->get();


        $engagement = Consultation::with('consultFrom', 'consultWith')
        ->where(function($query){
            $query->where('consult_from', '=', auth()->id());
        })->orWhere("consult_with",'=',auth()->id())
        ->get();



        $profileUrl = env('PROFILE_URL');
        $profileUrl =url('/')."/storage/app/media";

//        dd($engagement);

        $total_paid = Consultation::where("consult_from",auth()->id())->where("is_accepted",1)->orWhere("is_accepted",0)->sum("session_price");


        return view('wallet.wallet')->with(compact('engagement', 'profileUrl','total_paid'));
    }

    public function withdrawal(){
        $withdrawal_history = auth()->user()->withdrawals()->with('userEbank.ebank')->get();
        $userEbanks = auth()->user()->UserEbanks()->with('ebank')->get();
        $ebanks = Ebank::all();
        return view('wallet.withdrawal')->with(compact('withdrawal_history', 'userEbanks', 'ebanks'));
    }

    public function addEbank(Request $request){
        // $request->validate([
        //     'ebank_id'  =>  'required|exists:ebank,id',
        //     'email'     =>  'required'
        // ]);

        auth()->user()->UserEbanks()->create([
            'ebank_id'  =>  $request->id,
            'email'     =>  $request->email
        ]);

        return redirect()->back()->with(['success' => 'eBank added successfully']);
    }

    public function withdrawalRequest(Request $request){
        auth()->user()->withdrawals()->create([
            'user_ebank_mail_id'     =>  $request->withdraw,
            'price'                 =>  auth()->user()->balance
        ]);

        auth()->user()->update([
            'balance'   =>  0
        ]);

        return redirect()->back()->with(['success' => 'You withdrawal request has been received.']);
    }



//    //My Wallet
//    public function myWallet(){
//        return view();
//    }


}
