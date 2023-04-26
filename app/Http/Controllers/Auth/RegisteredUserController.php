<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\SingleModel\iSingleModelRepository;
use Khsing\World\World;
use Khsing\World\Models\Country;
use App\Models\IndustryTypes;
use App\Models\JobTypes;
use App\Models\Company;
use DB;

class RegisteredUserController extends Controller
{
    private $singleModel;
    private $secret_key = "sk_test_51LokHfFPy6qhi114FZNzxPDr1naYLW5bIJEccgYNHfLiQCDbVezR9rKefwSvSU6ZBKDTUPe6H3e0gQhCuPJT4zF600V4iv0o4t";
    public function __construct(iSingleModelRepository $singleModel)
    {
        $this->singleModel = $singleModel;
    }
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        $employeeTypes = $this->singleModel->employeeTypes->all();
        $job_titles=$this->singleModel->users->distinct()->pluck('job_title')->whereNotNull();
        $industryTypes=$this->singleModel->industryTypes->where('is_active',1)->get();
        $jobTypes=DB::table("skills_speciality")->get();
        //$this->singleModel->jobTypes->where('is_active',1)->get();
        $company=$this->singleModel->company->where('is_active',1)->get();
        $countries = World::Countries()->pluck("code","name")->toArray();
        return view('custom.auth.register')->with(compact('employeeTypes','countries','job_titles','industryTypes','jobTypes','company'));
    }


    public function getRealtedCities($id){
         $pakistan = Country::getByCode($id);
//         check has_division to determine next level is division or city.
         $pakistan->has_division; // true, otherwise is false
         $regsions = $pakistan->children()->pluck("name")->toArray();
         return response()->json([
             "RespsonseCode"=>1,
             "cities"=>$regsions
         ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'country' => 'required|string',
            'city' => 'required|string',
            //'g-recaptcha-response' => 'required|recaptchav3:register,0.5'
        ]);

//        $password = Hash::make($request->password);
        $request['password'] =$request->password;
        if(!$request->has('is_student')){
            $request['is_student'] = 0;
        }


        $stripe = new \Stripe\StripeClient(
            $this->secret_key
        );

        //Creating Stripe user for records
        try {
            $stripe_customer = $stripe->customers->create([
                'email' => $request->email,
                'name' => $request->first_name,
                'description' => 'User',
            ]);
        } catch (\Stripe\Exception\CardException $e) {
            // Error code will be authentication_required if authentication is needed
            // echo 'Error code is:' . $e->getError()->code;
            $error = $e->getError();
            $payment_intent_id = $e->getError()->payment_intent->id;
            return $error;
        }
        //Assigning id
        $request["stripe_customer_id"] = $stripe_customer->id;

        if($request->has('industry_type_id') && !preg_match('/^[0-9]+$/', $request->industry_type_id) ){
            $industryType=new IndustryTypes;
            $industryType->name=$request->industry_type_id;
            $industryType->is_active=0;
            $industryType->save();
            $request["industry_type_id"]=$industryType->id;
        } else {
            $request["industry_type_id"]= (int)$request["industry_type_id"];   
        }

        if($request->has('job_type_id') && !preg_match('/^[0-9]+$/', $request->job_type_id) ){
            $jobType=new JobTypes;
            $jobType->name=$request->job_type_id;
            $jobType->is_active=0;
            $jobType->save();
            $request["job_type_id"]=$jobType->id;
        } else {
            $request["job_type_id"]= (int)$request["job_type_id"];   
        }

        if($request->has('company_id') && !preg_match('/^[0-9]+$/', $request->company_id) ){
            $company=new Company;
            $company->name=$request->company_id;
            $company->is_active=0;
            $company->save();
            $request["company_id"]=$company->id;
        } else {
            $request["company_id"]= (int)$request["company_id"];   
        }
        
        

        $user = User::create($request->all());
        
        if (isset($industryType)) {
            $industryType->user_id = $user->id;
            $industryType->save();
        }
        if (isset($jobType)) {
            $jobType->user_id = $user->id;
            $jobType->save();
        }
        if (isset($company)) {
            $company->user_id = $user->id;
            $company->save();
        }

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
