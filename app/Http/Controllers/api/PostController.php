<?php

namespace App\Http\Controllers\api;

use App\Events\GeneralEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReflectionResource;
use App\Models\PostPrivacy;
use App\Models\PostType;
use App\Models\Reflection;
use Illuminate\Http\Request;
use App\Repositories\UnitOfWork\iUnitOfWork;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Traits\NotificationTrait;

class PostController extends Controller
{

    use NotificationTrait;

    private $unitOfWork;

    public function __construct(iUnitOfWork $unitOfWork)
    {
        $this->unitOfWork = $unitOfWork;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFeedPosts()
    {
        $user_id = auth()->id();
        $post = $this->unitOfWork->post->getModel();

        $posts = $post->with(
            [
                'user', 'postType', 'postMedia', 'jobs.employeeType', 'shared.user', 'shared.postType', 'shared.postMedia', 'shared.jobs.employeeType', 'reflections' => function ($query) {
                    $query->with('user')->orderBy('created_at', 'DESC');
                },
                'rate' => function ($queryRate) {
                    $queryRate->where('user_id', auth()->user()->id);
                },
                'page' => function($query){
                    $query->whereHas('pageUser');
                },
                'group' => function($query){
                    $query->whereHas('groupUser');
                }
            ]
        )
        ->where(function($query){
            $query->whereNotNull('page_id');
            $query->whereHas('page', function($q){
                $q->whereHas('pageUser');
            });
        })
        ->orWhere(function($query){
            $query->whereNotNull('group_id');
            $query->whereHas('group', function($q){
                $q->whereHas('groupUser');
            });
        })
        ->orWhere(function($query){
            $query->whereNull('page_id');
            $query->whereNull('group_id');
        })
        // ->whereHas('page', function($query){
        //     $query->whereHas('pageUser');
        // })
        // ->orWherehas('group', function($query){
        //     $query->whereHas('groupUser');
        // })
        ->withCount('reflections')
            // ->whereRaw('post_privacy_id = 1 OR (post_privacy_id = 2 AND user_id = "'.$user_id.'")')
            ->where('post_privacy_id', 1)
            ->orWhere(function($query){
                $query->where('user_id', auth()->user()->id);
                $query->where('post_privacy_id', 2);
            })

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

        return $this->unitOfWork->response(['ResponseCode' => 1, 'ResponseMessage' => 'List of posts', 'data' => $posts, 'media_url' => $media_url, 'pdf_url' => $pdf_url]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'privacy' => 'required',
            'post_type' => 'required|string'
        ]);

        // DB::beginTransaction();
        // try {

            $postType = PostType::where('name', $request->input('post_type'))->first();
            $request['post_type_id'] = $postType->id;
            $postPrivacy = PostPrivacy::where('name', $request->input('privacy'))->first();
            $request['post_privacy_id'] = $postPrivacy->id;

            $post = auth()->user()->posts()->create($request->all());

            if ($postType->name != 'Job') {

                if ($request->hasFile('file')) {
                    $fileArray = [];
                    foreach ($request->file('file') as $file) {

                        $filNameWithExtention = $file->getClientOriginalName();
                        $fileName = pathinfo($filNameWithExtention, PATHINFO_FILENAME);
                        $extention = $file->getClientOriginalExtension();
                        $image = trim(str_replace(' ', '', $fileName . '_' . time() . '.' . $extention));
                        str_replace(' ', '', $image);
                         $path = $file->storeAs('media', $image);
                        // $path = $file->storeAs('media', $image, 's3');
                        // Storage::disk('s3')->setVisibility($path, 'public');

                        $fileArray[] = [
                            'name' => $image
                        ];
                    }
                    $post->postMedia()->createMany($fileArray);
                }
            } else {
                if ($request->has('file')) {

                    $filNameWithExtention = $request->file('file')->getClientOriginalName();
                    $fileName = pathinfo($filNameWithExtention, PATHINFO_FILENAME);
                    $extention = $request->file('file')->getClientOriginalExtension();
                    $image = trim(str_replace(' ', '', $fileName . '_' . time() . '.' . $extention));
                    str_replace(' ', '', $image);
                    $path = $request->file('file')->storeAs('media', $image);
                    // $path = $request->file('file')->storeAs('media', $image, 's3');
                    // Storage::disk('s3')->setVisibility($path, 'public');
                    $fileArray = [
                        'name' => $image
                    ];

                    $post->postMedia()->create($fileArray);

                    $request['job_poster'] = $image;
                }
                $post->jobs()->create($request->all());
            }

            $post = $this->unitOfWork->post->getFullPost($post->id);
            // DB::commit();
            return response()->success(1, 'Post Created successfully', $post);
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     return response()->error(0, 'server error', 'something went wrong. Please try again');
        // }
    }

    public function rate(Request $request)
    {
        $request->validate([
            'post_id'   => 'required|exists:posts,id',
            'stars'      =>  'required'
        ]);

        $post = $this->unitOfWork->post->getById($request->input('post_id'));

        $request['user_id'] = auth()->user()->id;

        $ifExists = $post->rate()->where('user_id', auth()->user()->id)->first();

        if ($ifExists && !$request->has('updateStars') && !$request->input('updateStars') == true) {
            $post->rate()->find($ifExists->id)->delete();
            return response()->success(2, 'rate removed');
        } else {

            $existingViewCount = $post->view_count;

            $post->update([
                'view_count' => $existingViewCount + 1
            ]);

            $rate = $post->rate()->updateOrCreate(['id' => $request->input('rate_id')], $request->all());

            $name = auth()->user()->firstname . ' ' . auth()->user()->lastname;

            $notification = [
                'user_id' => $post->user_id,
                'other_user_id' => auth()->id(),
                'text' => $name . ' rate your post'
            ];

            $this->storeNotification($notification);

            $data = [
                'action' => 'RATE',
                'text' => $name . ' rate your post'
            ];


            if ($post->user_id != auth()->id()) {
                $this->storeNotification($notification);
                event(new GeneralEvent($data, $post->user_id));
            }

            $totalRates = $post->rate()->get()->count();
        }
        return response()->success(1, 'post rated successfully' , ['your_rate' => $rate, 'total_rate' => $totalRates]);
    }

    public function reflect(Request $request)
    {
        $request->validate([
            'post_id'       =>  'required|exists:posts,id',
            'reflection'    =>  'required'
        ]);

        $post = $this->unitOfWork->post->getById($request->input('post_id'));
        if ($post) {
            $request['user_id'] = auth()->user()->id;
            $reflection = $post->reflections()->create($request->all());

            $reflection = new ReflectionResource($reflection);

            if ($reflection) {
                return response()->success(1, 'reflection added successfully', $reflection);
            }
        }
    }

    public function getMoreReflections(Request $request)
    {

        $request->validate([
            'post_id'   =>  'required|exists:posts,id'
        ]);

        $comments = Reflection::with('user')->where('post_id', $request->input('post_id'))->orderBy('id', 'DESC')->paginate(10);
        $comments = ReflectionResource::collection($comments);
        return response()->success(1, 'list of reflections', $comments);
    }

    public function bookmark(Request $request){
        $request->validate([
            'post_id'       =>      'required|exists:posts,id'
        ]);


        $savedPost =  auth()->user()->savePost()->where('user_save_posts.post_id', $request->post_id)->first();

        if($savedPost){
            auth()->user()->savePost()->detach($request->post_id);
            return response()->success(1, 'post removed from saved list');
        }


        auth()->user()->savePost()->attach($request->post_id);

        return response()->success(1, 'post saved successfully');

    }

    public function bookmarkPostsList(){
        $posts = auth()->user()->savePost()->with(
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
            ->paginate(10)
            ->map(function ($query) {
                $query->setRelation('reflections', $query->reflections->take(2));
                return $query;
            });

            return response()->success(1, 'list of bookmarked posts', ['posts' => $posts]);
    }
}
