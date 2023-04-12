<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Posts;
use Illuminate\Http\Request;
use App\Repositories\GroupRepository\iGroupRepository;
use App\Repositories\URL\iUrlRepository;
use App\Models\Friend;

class GroupController extends Controller
{
    private $group;
    private $url;

    public function __construct(iGroupRepository $group, iUrlRepository $url)
    {
        $this->group = $group;
        $this->url = $url;
    }

    public function list(Request $request){

        if($request->has("search") && $request->search != ""){
            $groups = $this->group->list($request->search);
        }else{
            $groups = $this->group->list();
        }

//        $url = env('PAGE_CONTENT_URL');
        $url = url('/')."/storage/app/media";
        return view('group.groups')->with(compact('groups', 'url'));
    }
    public function allGroups(Request $request){

        if($request->has("search") && $request->search != ""){
            $groups = Group::where("name","like","%".$request->search."%")->get();
        }else{
            $groups = Group::all();
        }

        $url = url('/')."/storage/app/media";
//        $url = env('PAGE_CONTENT_URL');
        return view('group.allGroups')->with(compact('groups', 'url'));

    }

    public function create(){
        return view('group.createGroup');
    }

    public function store(Request $request){

        if($request->has("is_private") && $request->is_private != ""){
            $request->is_private = 1;
        }

        $group = $this->group->store($request);
        if($group){
            return redirect(route('group.list'))->with(['success' => 'Group Created successfully']);
        }
    }

    public function detail($id){

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

        $group = Group::with(['members' => function($query){
            $query->limit(3);
        }, 'groupUser', 'groupAdmins'])
        ->withCount('members')->findOrFail($id);

        $posts = Posts::with(
            [
                'user', 'postType', 'postMedia', 'jobs.employeeType', 'shared.user', 'shared.postType', 'shared.jobs.employeeType', 'reflections' => function($query){
                    $query->with('user')->orderBy('created_at', 'DESC');
                    },
                'rate' => function($queryRate){
                    $queryRate->where('user_id', auth()->user()->id);
                }
            ]
            )->withCount('reflections')
            ->withCount('rate')
            ->withCount('postShared')
            ->orderBy('created_at', 'DESC')
            ->where('group_id', $id)
            ->paginate(10)
            ->map(function ($query) {
            $query->setRelation('reflections', $query->reflections->take(2));
                return $query;
            });

        foreach ($posts as $post) {

            if ($post->user_id == auth()->id()) {
                //Getting login User Posts public/private
                $all_posts[] = $post;
            } elseif ($post->user_id != auth()->id()) {

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
        $group_members = $group->groupUser->pluck("id")->toArray();

        if(!in_array(auth()->user()->id,$group_members)){
            $posts = [];
        }



//            $url = env('PAGE_CONTENT_URL');
//            $urlProfile = env('PROFILE_URL');

            $url = url("/")."/storage/app/media";
            $urlProfile = url("/")."/storage/app/media";

            $urlPost = $this->url->UrlPost();
            return view('group.groupDetail')->with(compact('group', 'posts', 'url', 'urlProfile', 'urlPost'));
    }

    public function deleteGroup($id){

        $group = Group::findOrFail($id);

        if($group){
            if(in_array(auth()->user()->id,$group->groupAdmins->pluck("id")->toArray())){
                $group->delete();
                return redirect(route('group.list'))->with(['success' => 'Group Deleted successfully']);
            } else{
                return redirect(route('group.list'))->with(['error' => 'You are not authentic user']);
            }
        }else{
            return redirect(route('group.list'))->with(['error' => 'Group not found']);
        }

    }

    public function join(Request $request){
        $group = $this->group->join($request);

        if($group){
            return 1;
        }

    }

    public function leave(Request $request){
        $group = $this->group->leave($request);

        if($group){
            return 1;
        }
    }
}
