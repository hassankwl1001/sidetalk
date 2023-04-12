<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\Post\iPostRepository;
use App\Repositories\URL\iUrlRepository;
use App\Models\Posts;
use App\Traits\NotificationTrait;
use App\Events\GeneralEvent;

class JobController extends Controller
{
    use NotificationTrait;

    private $post;
    private $url;

    public function __construct(iPostRepository $post, iUrlRepository $url)
    {
        $this->post = $post;
        $this->url = $url;
    }

    public function detail($id){

        $post = $this->post->getFullPost($id);
        $post->view_count += 1;
        $post->update();


        return view('job.detail')->with(compact('post'));
    }

    public function apply(Request $request){


        auth()->user()->apply()->attach($request->job_id);


        $job = Posts::find($request->job_id);
        $job_user = $job->user;

        $name = auth()->user()->firstname . ' ' . auth()->user()->lastname;
//
        $notification = [
            'user_id' => $job_user->id,
            'other_user_id' => auth()->id(),
            'text' => $name . ' Applied to your Job.',
            'url'=> "https://skilledtalk.com/job/my-jobs"
        ];
//
//        $this->storeNotification($notification);
//
        $data = [
            'action' => 'JOB_APPLY',
            'text' => $name . ' Applied to your Job'
        ];
//
//
        if($job_user->id != auth()->id()){
            $this->storeNotification($notification);
            event(new GeneralEvent($data, $job_user->id));
        }

        return 1;
    }

    public function list(Request $request){


        if($request->has("search") && $request->search != "" && $request->has("city") && $request->city != ""){
            $posts = $this->post->jobs($request->search,$request->city);
        }else{
            $posts = $this->post->jobs();
        }

        $urlPost = $this->url->UrlPost();

        return view('job.jobs')->with(compact('posts', 'urlPost'));
    }

    public function userList(){
        $posts = $this->post->jobs();
        $urlPost = $this->url->UrlPost();
        $posts =  $posts->where("user_id",auth()->user()->id);

        return view('job.user-jobs')->with(compact('posts', 'urlPost'));
    }


    public function getJobApplicants($id){
        $posts = Posts::find($id);

        $applicants = $posts->applicants;

        return view("job.applicants",compact("applicants"));
    }

}
