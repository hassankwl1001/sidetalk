<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PageListingResource;
use App\Models\Page;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;

class PageController extends Controller
{
    use FileUploadTrait;

    public function pages(){
        $pagesList  =   Page::with('pageUser')->paginate(12);
        $pagesList = PageListingResource::collection($pagesList);
        return $pagesList;
    }

    public function create(Request $request){

        $request->validate([
            'log'               =>  'required|file',
            'ban'               =>  'required|file',
            'name'              =>  'required',
            'public_url'        =>  'required',
            'website'           =>  'sometimes|required|nullable',
            'industry'          =>  'required',
            'company_size'      =>  'required',
            'company_type'      =>  'required',
            'tagline'           =>  'required',
            'about'             =>  'required',
            'page_type_id'      =>  'required'

        ]);


        $logo = $this->uploadSingleImage($request, 'log');
        $banner = $this->uploadSingleImage($request, 'ban');

        $request['logo'] = $logo;
        $request['banner'] = $banner;

        $page = auth()->user()->pages()->create($request->all());

        if($page){
            return response()->success(1, 'page created successfully', ['page' => $page]);
        }

    }

    public function follow(Request $request){
        $request->validate([
            'page_id'   =>  'required'
        ]);

        $page   = Page::find($request->page_id);
         $user  = User::find(auth()->id());
        $user->pagesfollow()->sync($page);

        return response()->success(1, 'Page followed successfully');

    }

    public function unfollow(Request $request){
        $request->validate([
            'page_id'   =>  'required'
        ]);


        $page  =   Page::findOrFail($request->page_id);
        $user   =   User::find(auth()->id());
        $user->pagesfollow()->detach($page->id);

        return response()->success(1, 'page unfollow successfully');
    }

    public function posts(Request $request){
        $request->validate([
            'page_id'      =>  'required|exists:pages,id'
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
        ->where('page_id', $request->group_id)
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

        return response()->success(1, 'page post listing', ['posts' => $posts, 'media_url' => $media_url, 'pdf_url' => $pdf_url]);
    }
}
