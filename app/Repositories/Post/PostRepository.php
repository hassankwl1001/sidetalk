<?php

namespace App\Repositories\Post;
use App\Repositories\Post\iPostRepository;
use App\Repositories\Generic\GenericRepository;
use App\Models\Posts;

class PostRepository extends GenericRepository implements iPostRepository{

    public function __construct(Posts $posts)
    {
        parent::__construct($posts);
    }

    public function getFullPost($id){
        $post = Posts::with(
            [
                'user', 'postType', 'postMedia', 'jobs', 'reflections' => function($query){
                    $query->with('user')->orderBy('created_at', 'DESC');
                    },
                'rate' => function($queryRate){
                    $queryRate->where('user_id', auth()->user()->id);
                }
            ]
            )->withCount('reflections')
            ->withCount('applicants')
            ->with('userApplicant')
            ->withCount('rate')
            ->orderBy('created_at', 'DESC')
            ->where('id', $id)
            ->get()
            ->map(function ($query) {
            $query->setRelation('reflections', $query->reflections->take(2));
                return $query;
            });

            if($post->isEmpty()){
                return null;
            }

            return $post[0];
    }

    public function jobs($search=null,$city=null){
        $post = Posts::with(
            [
                'user', 'postType', 'postMedia',
                'jobs'=>function($query1) use ($search,$city){

                    $query1->when($search,function ($query11) use ($search,$city){
                        $query11->where("job_title","like","%".$search."%")->where("location","like","%".$city."%");
                    });

                }
            ,'reflections' => function($query){
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
            ->with('userApplicant')
            ->withCount('rate')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->map(function ($query) {
            $query->setRelation('reflections', $query->reflections->take(2));
                return $query;
            });

            return $post;
    }
}
