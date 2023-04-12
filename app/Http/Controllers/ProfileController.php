<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Country;
use App\Models\Experience;
use App\Models\Page;
use App\Models\Rate;
use App\Models\Reflection;
use App\Repositories\SingleModel\iSingleModelRepository;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use App\Repositories\UnitOfWork\iUnitOfWork;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class ProfileController extends Controller
{

    private $unitOfWork;
    private $singleModel;

    public function __construct(iUnitOfWork $unitOfWork, iSingleModelRepository $singleModel)
    {
        $this->unitOfWork = $unitOfWork;
        $this->singleModel = $singleModel;
    }

    public function index()
    {

        $totalReflections = Reflection::whereIn("post_id",auth()->user()->posts->pluck("id")->toArray())->count("id");

        if($totalReflections > 999){
            $totalReflections=number_format($totalReflections/1000,2) . 'k';
        }

        $totalRating = Rate::whereIn("post_id",auth()->user()->posts->pluck("id")->toArray())->count("stars");

        if($totalRating > 999){
            $totalRating=number_format($totalRating/1000,2) . 'k';
        }

        $contentView =  auth()->user()->posts()->sum('view_count');

        if($contentView > 999){
            $contentView=number_format($contentView/1000,2) . 'k';
        }

        $engagement=auth()->user()->consultation()->count();

//        $profileUrl = env('AWS_S3_BUCKET_URL').'media';
        $profileUrl = url('/')."/storage/app/media";
        $employeeTypes = $this->singleModel->employeeTypes->all();
        $experiences = auth()->user()->experience()->get();

        $post = $this->unitOfWork->post->getModel();
        $posts = $post->with(
            [
                'user', 'postType', 'postMedia', 'jobs.employeeType', 'shared.user', 'shared.postType', 'shared.jobs.employeeType', 'reflections' => function ($query) {
                $query->with('user')->orderBy('created_at', 'DESC');
            },
                'rate' => function ($queryRate) {
                    $queryRate->where('user_id', auth()->user()->id);
                }
            ]
        )->withCount('reflections')
            ->withCount('rate')
            ->withCount('postShared')
            ->orderBy('created_at', 'DESC')
            ->where('user_id', auth()->user()->id)
            ->get()
            ->map(function ($query) {
                $query->setRelation('reflections', $query->reflections->take(2));
                return $query;
            });
//        $follows = Page::inRandomOrder()->limit(5)->get();
        $follows = DB::table('pages')->WhereIn('id',
            DB::table('page_followers')->where('user_id', auth()->id())->pluck('id'))
            ->get();

        $totalPages = DB::table('pages')->WhereIn('id',
            DB::table('page_followers')->where('user_id', auth()->id())->pluck('id'))
            ->count('id');
        $urlPost = $profileUrl;
        $urlProfile = $profileUrl;
        $countries = Country::all();

        return view('profile')->with(compact('profileUrl', 'employeeTypes', 'experiences', 'posts', 'urlPost', 'urlProfile', 'follows', 'totalPages', 'countries','totalReflections','totalRating','engagement', 'contentView'));

    }

    public function update(Request $request)
    {

        if ($request->hasFile('profile_photo')) {
            $filNameWithExtention = $request->file('profile_photo')->getClientOriginalName();
            $fileName = pathinfo($filNameWithExtention, PATHINFO_FILENAME);
            $extention = $request->file('profile_photo')->getClientOriginalExtension();
            $image = trim(str_replace(' ', '', $fileName . '_' . time() . '.' . $extention));
            str_replace(' ', '', $image);
            $path = $request->file('profile_photo')->storeAs('media', $image);
            // Storage::disk('s3')->setVisibility($path, 'public');
            $request['profile_pic'] = $image;
        }

        if ($request->hasFile('banner_pic')) {
            $filNameWithExtention = $request->file('banner_pic')->getClientOriginalName();
            $fileName = pathinfo($filNameWithExtention, PATHINFO_FILENAME);
            $extention = $request->file('banner_pic')->getClientOriginalExtension();
            $image = trim(str_replace(' ', '', $fileName . '_' . time() . '.' . $extention));
            str_replace(' ', '', $image);
            $path = $request->file('banner_pic')->storeAs('media', $image);
            // Storage::disk('s3')->setVisibility($path, 'public');
            $request['banner'] = $image;
        }

        $update = auth()->user()->update($request->all());
        if ($update) {
            return redirect()->back()->with(['success' => 'Profile Updated Successfully']);
        }
    }

    public function userExperienceCalculate()
    {
        $experience = Experience::where('user_id', auth()->id())->get();
        $totalExperience = 0;
        foreach ($experience as $exp) {
            $totalExperience += \Carbon\Carbon::parse($exp->start_date)->diffInYears(\Carbon\Carbon::parse($exp->end_date));
        }
        auth()->user()->update(['experience' => $totalExperience]);

    }

    public function experience(Request $request)
    {



        $data = $request->all();

        if($request->has("currently_working") && $request->currently_working == "on"){
            $data["currently_working"] = true;
        }else{
            $data["currently_working"] = false;
        }


        $experience = auth()->user()->experience()->updateOrCreate(['id' => $request->input('id')], $data);
        $this->userExperienceCalculate();
        if ($experience) {
            return redirect()->back()->with(['success' => 'Experience added successfully']);
        }
    }

    public function experienceEdit($id)
    {

        $exp = Experience::findorfail($id);
        $employeeTypes = $this->singleModel->employeeTypes->all();

        return view('custom.inc.experienceEdit', compact('exp', 'employeeTypes'));

    }

    public function experienceUpdate(Request $request)
    {

        $data = $request->all();

        if($request->has("currently_working") && $request->currently_working != ""){

            $data["currently_working"] = true;
        }else{
            $data["currently_working"] = false;
        }

        $experience = auth()->user()->experience()->updateOrCreate(['id' => $request->input('id')], $data);
        $this->userExperienceCalculate();

        if ($experience) {
            return redirect()->back()->with(['success' => 'Experience updated successfully']);
        }
    }
}
