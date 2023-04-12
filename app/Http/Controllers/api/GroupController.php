<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GroupListingResource;
use App\Models\Posts;
use Illuminate\Http\Request;
use App\Repositories\GroupRepository\iGroupRepository;

class GroupController extends Controller
{

    private $group;

    public function __construct(iGroupRepository $group)
    {
        $this->group = $group;
    }

    public function groups(){
        $groups = $this->group->allGroups();
        $url = env('PAGE_CONTENT_URL');
        $groups = GroupListingResource::collection($groups);
        return response()->success(1, 'list of groups', ['url' => $url, 'groups' => $groups]);
    }

    public function create(Request $request){

        $request->validate([
            'name'  =>  'required',
            'about' =>  'required',
            'log'   =>  'required',
            'ban'   =>  'required'
        ]);

        $group = $this->group->store($request);

        if($group){
           return response()->success(1, 'group created successfully', ['group' => $group]);
        }
    }

    public function join(Request $request){
        $request->validate([
            'group_id'  =>  'required'
        ]);

        $group = $this->group->join($request);

        if($group){
            return response()->success(1, 'group joined successfully');
        }
    }

    public function leave(Request $request){
        $request->validate([
            'group_id'  =>  'required'
        ]);

        $group = $this->group->leave($request);

        if($group){
            return response()->success(1, 'group leaved successfully');
        }
    }

    public function posts(Request $request){

        $request->validate([
            'group_id'  =>  'required|exists:groups,id'
        ]);

        $posts = Posts::with(
            [
                'user', 'postType', 'postMedia', 'jobs.employeeType', 'shared.user', 'shared.postType', 'shared.postMedia', 'shared.jobs.employeeType', 'reflections' => function ($query) {
                    $query->with('user')->orderBy('created_at', 'DESC');
                },
                'rate' => function ($queryRate) {
                    $queryRate->where('user_id', auth()->user()->id);
                }
            ]
        )
        ->where('group_id', $request->group_id)
        ->withCount('reflections')
            ->withCount('rate')
            ->withCount('postShared')
            ->orderBy('created_at', 'DESC')
            ->paginate(10)
            ->map(function ($query) {
                $query->setRelation('reflections', $query->reflections->take(2));
                return $query;
            });

        $media_url = env('AWS_S3_BUCKET_URL') . 'media/';
        $pdf_url   = env('AWS_S3_BUCKET_URL') . 'pdf/';

        return response()->success(1, 'group post listing', ['posts' => $posts, 'media_url' => $media_url, 'pdf_url' => $pdf_url]);

    }
}
