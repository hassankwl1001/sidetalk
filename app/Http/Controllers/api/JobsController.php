<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\JobResource;
use App\Models\Posts;
use App\Repositories\UnitOfWork\iUnitOfWork;

class JobsController extends Controller
{
    private $unitOfWork;

    public function __construct(iUnitOfWork $unitOfWork)
    {
        $this->unitOfWork = $unitOfWork;
    }

    public function getJobs(){
        $post = $this->unitOfWork->post->getModel();

        $jobs = $post->with('jobs')
        ->whereHas('postType', function($query){
            $query->where('name', 'Job');
        })
        ->withCount('userApplicant')
        ->doesntHave('userApplicant')
        ->paginate(10);

        $jobs = JobResource::collection($jobs);

        return response()->success(1, 'list of available jobs', $jobs);
    }

    public function detail(Request $request){
        $request->validate([
            'post_id'   =>  'required|exists:posts,id'
        ]);

        $post = $this->unitOfWork->post->getModel();

        $job = $post->with(
            [
                'postType', 'postMedia', 'jobs.employeeType', 'shared.user', 'shared.postType', 'shared.postMedia', 'shared.jobs.employeeType'
            ]
        )
        ->withCount('applicants')
        ->withCount('userApplicant')
        ->find($request->post_id);

        return response()->success(1, 'job detail', $job);

    }

    public function apply(Request $request){

        $request->validate([
            'post_id'   =>  'required|exists:posts,id'
        ]);

        auth()->user()->apply()->attach($request->post_id);

        return response()->success(1, 'You have successfully applied on this job');
    }

    public function myjobs(){
        $post = Posts::with(
            [
                'user', 'postType', 'postMedia', 'jobs', 'reflections' => function($query){
                    $query->with('user')->orderBy('created_at', 'DESC');
                    },
                'rate' => function($queryRate){
                    $queryRate->where('user_id', auth()->user()->id);
                }
            ]
            )->whereHas('postType', function ($query){
                $query->where('post_type.name', 'Job');
            })
            ->withCount('reflections')
            ->withCount('applicants')
            ->whereHas('userApplicant')
            ->withCount('rate')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->map(function ($query) {
            $query->setRelation('reflections', $query->reflections->take(2));
                return $query;
            });

            return response()->success(1, 'list of my jobs', ['jobs' => $post]);
    }
}
