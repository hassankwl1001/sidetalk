<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Group;
use App\Models\Page;
use App\Models\PostJobs;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Repositories\UnitOfWork\iUnitOfWork;

class HomeController extends Controller
{
    private $unitOfWork;

    public function __construct(iUnitOfWork $unitOfWork)
    {
        $this->unitOfWork = $unitOfWork;
    }

    public function index()
    {

        $friends_ids = [];
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

        $post = $this->unitOfWork->post->getModel();
        $posts = $post->with(
            [
                'user', 'postType', 'postMedia', 'jobs.employeeType', 'shared.user', 'shared.postType', 'shared.postMedia', 'shared.jobs.employeeType', 'reflections' => function ($query) {
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
            ->paginate(10)
            ->map(function ($query) {
                $query->setRelation('reflections', $query->reflections->take(2));
                return $query;
            });

        $similarPages = Page::inRandomOrder()->doesntHave('pageUser')->limit(5)->get();

        $groups = Group::inRandomOrder()->limit(5)->get();



        $jobs = $post->with(["jobs"=>function($q){
            $q->where("job_title",'like',"%".auth()->user()->current_position."%");
        }])
        ->whereHas('postType', function($query){
            $query->where('name', 'Job');
        })
//            ->where("heading","like","%".auth()->user()->current_position."%")
//            ->orWhere("description","like","%".auth()->user()->current_position."%")
        ->doesntHave('userApplicant')
        ->limit(3)
        ->get();

//        auth()->user()->current_position



//        dd($jobs);

        foreach ($posts as $post) {

            if ($post->user_id == auth()->id() && $post->page_id == "") {
                //Getting login User Posts public/private
                $all_posts[] = $post;
            } elseif ($post->user_id != auth()->id() && $post->page_id == "") {

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

//        $urlPost = env('AWS_S3_BUCKET_URL');
//        $urlPost = $urlPost.'media';
//        $urlPDF = $urlPost.'pdf';
//        $urlProfile = $urlPost;

        $urlPost = url('/')."/storage/app/media";
        $urlPDF =  url('/')."/storage/app/pdf";
        $urlProfile = $urlPost;
//        dd(env('ASSET_URL'));

        return view('home')->with(compact('posts', 'urlPost', 'urlPDF', 'urlProfile', 'similarPages', 'groups', 'jobs'));
    }
    public function discover (Request $request)
    {


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
        )
            ->when($request->has('filter_type') && $request->filled('filter_type') && $request->filter_type=='Jobs',function ($query){
                $query->where('post_type_id','=',4);
            })
            ->when($request->has('discover') && $request->filled('discover'),function ($query) use ($request){
                $query->where('heading', 'like', '%'.$request->discover.'%')
                    ->orWhere('description', 'like', '%'.$request->discover.'%')
                    ->orWhere('hashtags', 'like', '%'.$request->discover.'%');

            })
            ->when($request->has('hashtags') && $request->filled('hashtags'),function ($query) use ($request){
                $input=$request->hashtags;
                $middle = ceil(strlen($input) / 2);
                $middle_space = strpos($input, " ", $middle - 1);

                if ($middle_space === false) {
                    //there is no space later in the string, so get the last sapce before the middle
                    $first_half = substr($input, 0, $middle);
                    $middle_space = strpos($first_half, " ");
                }

                if ($middle_space === false) {
                    //the whole string is one long word, split the text exactly in the middle
                    $first_half = substr($input, 0, $middle);
                    $second_half = substr($input, $middle);
                }
                else {
                    $first_half = substr($input, 0, $middle_space);
                    $second_half = substr($input, $middle_space);
                }

//                dd($string1,$string2,trim($first_half), trim($second_half));

                $query->where('hashtags', 'like', '%'.trim($first_half).'%');

            })
            ->withCount('reflections')
            ->withCount('rate')
            ->withCount('postShared')
            ->orderBy('created_at', 'DESC')
            ->paginate(10)

            ->map(function ($query) {
                $query->setRelation('reflections', $query->reflections->take(2));
                return $query;
            });

//        $urlPost = env('AWS_S3_BUCKET_URL');
//        $urlPost = $urlPost.'media';
//        $urlPDF = $urlPost.'pdf';
//        $urlProfile = $urlPost;

        $urlPost = url('/')."/storage/app/media";
        $urlPDF =  url('/')."/storage/app/pdf";
        $urlProfile = $urlPost;

        return view('discover')->with(compact('posts', 'urlPost', 'urlPDF', 'urlProfile'));
    }

    public function notifications()
    {
        $notifications = auth()->user()->notifications()->with('otherUser')->where("other_user_id","!=",auth()->user()->id)->latest()->get();
//        $url = env('PROFILE_URL');



        $url = url('/')."/storage/app/media";
        return [
            'notifications' => $notifications,
            'url' => $url
        ];
    }


    public function checkEmail($email){
        $user = User::where("email",$email)->first();
        if ($user){
            return array("resp"=>"error", "msg"=>"Email has been already taken.");
        }else{
            return array("resp"=>"success", "msg"=>"");
        }
        // if($user){
        //     return response()->json([
        //         "ResponseCode"=>0,
        //         "ResponseMessage"=>"The user with this email is already exist !"
        //     ]);
        // }

        // return response()->json([
        //     "ResponseCode"=>1,
        // ]);
    }


    public function clearAllNotifications(Request $request){
        $notifications = auth()->user()->notifications()->with('otherUser')->where("other_user_id","!=",auth()->user()->id)->latest()->get();

        foreach($notifications as $notification){
            $notification->delete();
        }

        return 1;
    }


    public function getAllNotifications(){
        $notifications = auth()->user()->notifications()->with('otherUser')->where("other_user_id","!=",auth()->user()->id)->latest()->get();
        $url = env('PROFILE_URL');
        return view("notification")->with(compact("notifications","url"));
    }


}
