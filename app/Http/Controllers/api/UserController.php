<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Resources\UserLessInfoResource;
use App\Models\EmployeeTypes;
use App\Models\Rate;
use App\Models\Reflection;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;
use App\Repositories\UnitOfWork\iUnitOfWork;


class UserController extends Controller
{

    use FileUploadTrait;

    private $unitOfWork;

    public function __construct(iUnitOfWork $unitOfWork)
    {
        $this->unitOfWork = $unitOfWork;
    }

    public function updateProfile(ProfileUpdateRequest $request){
        $user =  $this->unitOfWork->user->updateProfile($request);
        return response()->success(1, 'Profile updated Successfully', ['user' => $user]);
    }

    public function visitProfile(Request $request){
        $request->validate([
            'user_id'   =>  'required|exists:users,id'
        ]);

        $totalReflections = Reflection::with(['post'=>function($query){
            $query->where('user_id',auth()->id());
        }])->count('id');

        if($totalReflections > 999){
            $totalReflections=number_format($totalReflections/1000,2) . 'k';
        }

        $totalRating=Rate::with(['post'=>function($query){
            $query->where('user_id',auth()->id());
        }])->count('stars');

        if($totalRating > 999){
            $totalRating=number_format($totalRating/1000,2) . 'k';
        }

        $engagement = auth()->user()->consultation()->count();

        $employeeTypes = EmployeeTypes::all();


        $user = User::findOrFail($request->user_id);
        $user = new UserLessInfoResource($user);

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
            ->orderBy('created_at', 'DESC')
            ->where('user_id', $request->user_id)
            ->paginate(10)
            ->map(function ($query) {
                $query->setRelation('reflections', $query->reflections->take(2));
                return $query;
            });

            return response()->success(1, 'profile data', [
                'totalReflections'  =>  $totalReflections,
                'totalRating'       =>  $totalRating,
                'totalEngagements'  =>  $engagement,
                'user'              =>  $user,
                'employeeTypes' => $employeeTypes,
                'posts'         =>  $posts,
            ]);
    }

    public function uploadProfilePic(Request $request){
        $request->validate([
            'file'          =>      'required',
            'type'          =>      'required'
        ]);

       $profilePic =  $this->uploadMedia($request, 'file');


       if($request->type == 'BANNER'){
            auth()->user()->update([
                'banner'   =>  $profilePic
            ]);
       }else if($request->type == 'PROFILE_PIC'){
            auth()->user()->update([
                'profile_pic'   =>  $profilePic
            ]);
       }else{
           return response()->error(0, null, 'Unknown type');
       }


       return response()->success(1, 'Profile picture updated successfully', $profilePic);

    }
}
