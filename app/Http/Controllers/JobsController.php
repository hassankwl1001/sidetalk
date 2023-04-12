<?php

namespace App\Http\Controllers;

use App\Http\Resources\JobResource;
use Illuminate\Http\Request;

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
}
