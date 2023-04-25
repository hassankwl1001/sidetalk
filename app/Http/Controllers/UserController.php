<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use App\Models\Reflection;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\UnitOfWork\iUnitOfWork;
use App\Repositories\SingleModel\iSingleModelRepository;
use App\Traits\CheckFriendTrait;
use Illuminate\Support\Facades\DB;
use App\Models\Friend;
use App\Models\Skill;
use App\Traits\NotificationTrait;
use App\Events\GeneralEvent;


class UserController extends Controller
{

    use NotificationTrait;
    use CheckFriendTrait;

    public function __construct(iUnitOfWork $unitOfWork, iSingleModelRepository $singleModel)
    {
        $this->unitOfWork = $unitOfWork;
        $this->singleModel = $singleModel;
    }
    public function show($id)
    {
        //Getting Friends List
        $friends_ids = [];
        $other_user_id = $id;
        $friends = Friend::where(function ($query) {
            $query->where('request_to', auth()->id())
                ->orWhere('request_from', auth()->id());
        })
            ->where('is_accepted', 1)
            ->get();

        foreach ($friends as $friend) {

            if ($friend->request_from == auth()->user()->id) {
                $friends_ids[] = $friend->request_to;
            } elseif ($friend->request_to == auth()->user()->id) {
                $friends_ids[] = $friend->request_from;
            }
        }

        $all_posts = [];

        $user = User::findOrFail($id);

        $totalReflections = Reflection::whereIn("post_id",$user->posts->pluck("id")->toArray())->count("id");

        if($totalReflections > 999){
            $totalReflections=number_format($totalReflections/1000,2) . 'k';
        }

        $totalRating = Rate::whereIn("post_id",$user->posts->pluck("id")->toArray())->count("stars");

        if($totalRating > 999){
            $totalRating=number_format($totalRating/1000,2) . 'k';
        }

        $contentView =  $user->posts()->sum('view_count');

        if($contentView > 999){
            $contentView=number_format($contentView/1000,2) . 'k';
        }

        $engagement =    $user->consultation()->count();

//        $profileUrl = env("PROFILE_URL");
        $profileUrl = url('/')."/storage/app/media";
        $employeeTypes = $this->singleModel->employeeTypes->all();
        $experiences = $user->experience()->get();

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
            ->where('user_id', $id)
            ->get()
            ->map(function ($query) {
                $query->setRelation('reflections', $query->reflections->take(2));
                return $query;
            });

        $urlPost = $this->unitOfWork->url->UrlPost();
        $urlProfile = $profileUrl;

        $follows = DB::table('pages')->WhereIn('id',
            DB::table('page_followers')->where('user_id', $user->id)->pluck('id'))
            ->get();
        $totalPages = DB::table('pages')->WhereIn('id',
            DB::table('page_followers')->where('user_id', auth()->id())->pluck('id'))
            ->count('id');

        $is_friend = $this->is_friend(auth()->id(), $id);

//        dd($posts);
//        if(auth()->id() != $id){
//            dd("Watching Someone Profile");
//        }

        foreach ($posts as $post) {

            if ($post->user_id != auth()->id()) {

                //Getting All posts that are not of login user
                if (in_array($post->user_id, $friends_ids) && $post->post_privacy_id == 3) {

                    //Getting posts of friends
                    $all_posts[] = $post;
                } elseif ($post->post_privacy_id == 1) {

                    //Getting all public posts
                    $all_posts[] = $post;
                }
            }
        }

        $posts = $all_posts;

        $name = auth()->user()->name;
        $notification = [
            'user_id' => $other_user_id,
            'other_user_id' => auth()->user()->id,
            'text' => $name . ' See your profile',
            'url'=> url("user/profile/".auth()->user()->id)
        ];

        $data = [
            'action' => 'PROFILE',
            'text' => $name . 'See your profile'
        ];


        if($other_user_id != auth()->user()->id){
            $this->storeNotification($notification);
            event(new GeneralEvent($data, $other_user_id));
        }

        return view('visitUserProfile')->with(compact('profileUrl', 'totalPages','follows','employeeTypes', 'experiences', 'posts', 'urlPost', 'urlProfile', 'user', 'is_friend', 'totalReflections','totalRating','engagement', 'contentView'));
    }

    public function getuser(Request $request)
    {
        $user = User::findOrFail($request->id);
        return $user;
    }

    public function addSkill(Request $request)
    {
       $skill= auth()->user()->skills()->create([
            'name'  =>  $request->skill
        ]);

       return $skill->id;
//        return 1;
    }

    public function removeSkill(Request $request){
        $skill = Skill::find($request->skill);
        $skill->delete();

        return 1;
    }



}
