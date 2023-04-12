<?php

namespace App\Http\Controllers;

use App\Models\CompanyInformation;
use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;
use App\Repositories\UnitOfWork\iUnitOfWork;
use Illuminate\Support\Facades\DB;
use App\Models\Friend;
use App\Models\Posts;

class PageController extends Controller
{
    use FileUploadTrait;


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
    public function index()
    {
        return view('page.pageType');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $logo = $this->uploadSingleImage($request, 'log');
        $banner = $this->uploadSingleImage($request, 'ban');

        $request['logo'] = $logo;
        $request['banner'] = $banner;

        $page = auth()->user()->pages()->create($request->all());
        CompanyInformation::updateOrCreate(['type'=>'industry','information'=>$request->industry],[
            'type'=>'industry',
            'information'=>$request->industry
        ]);
        CompanyInformation::updateOrCreate(['type'=>'company_size','information'=>$request->company_size],[
            'type'=>'company_size',
            'information'=>$request->company_size
        ]);
        CompanyInformation::updateOrCreate(['type'=>'company_type','information'=>$request->company_type],[
            'type'=>'company_type',
            'information'=>$request->company_type
        ]);

        return redirect(route('page.show', $page->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $page = Page::find($id);
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
                'user', 'postType', 'postMedia', 'jobs.employeeType', 'jobs', 'shared.user', 'shared.postType', 'shared.jobs.employeeType', 'reflections' => function ($query) {
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
            ->where('page_id', $id)
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

        if (in_array($page->id, auth()->user()->pagesfollow->pluck("id")->toArray()) || auth()->user()->id == $page->user_id){

            $posts = $all_posts;

        }else{
            $posts = [];
        }

//            $url = env('PAGE_CONTENT_URL');
//            $urlProfile = env('PROFILE_URL');

            $url =url('/')."/storage/app/media";
            $urlProfile = url('/')."/storage/app/media";
            $page = Page::findOrFail($id);
            $page_followers=DB::table('page_followers')->where('page_id',$page->id)->count();

            $urlPost = $this->unitOfWork->url->UrlPost();
            $industry =CompanyInformation::where('type','industry')->get();
            $company_size =CompanyInformation::where('type','company_size')->get();
            $company_type =CompanyInformation::where('type','company_type')->get();

            return view('page.pageDetail')->with(compact('industry','company_size','company_type','page','page_followers', 'url', 'urlProfile', 'posts', 'urlPost'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function pageSetup($id){
       $industry =CompanyInformation::where('type','industry')->get();
       $company_size =CompanyInformation::where('type','company_size')->get();
       $company_type =CompanyInformation::where('type','company_type')->get();

//       dd($industry,$company_size,$company_type);

       return view('page.pageSetup')->with(compact('id','industry','company_size','company_type'));
    }
    public function pageFollow($id){

       $page =Page::find($id);
         $user=User::find(auth()->id());
        $user->pagesfollow()->attach($page);
       return 1;
    }

    public function pageUnfollow($id){

        $page =Page::find($id);
        $user=User::find(auth()->id());
        $user->pagesfollow()->detach($page);
        return 1;

    }



    public function pageDetail($id){

    }

    public function pagesList(Request $request){

        $search = $request->search;

        $pagesList=Page::where("user_id","!=",auth()->id())
            ->when($search,function ($q) use ($search){
                return $q->where("name","like","%".$search."%");
            })
            ->paginate(12);

//        if($request->has("search") && $request->search != ""){
//            $pagesList = Page::where("user_id","!=",auth()->id())->where("name","like","%".$request->search."%")->paginate(12);
//        }

        return view('page.pagesList',compact('pagesList'));
    }


    public function myPagesList(Request $request){

        $followed_pages = auth()->user()->pagesfollow->pluck("id")->toArray();
        $my_pages =  auth()->user()->pages->pluck("id")->toArray();

       $pages_array = array_merge($my_pages,$followed_pages);


       if($request->has("search") && $request->search != ""){
           $all_my_pages = Page::whereIn("id",$pages_array)->where("name","like","%".$request->search."%")->get();
       }else{
           $all_my_pages = Page::whereIn("id",$pages_array)->get();
       }


        $url =url('/')."/storage/app/media";
        return view("page.pageListUser",compact("url","all_my_pages"));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $page = Page::find($id);

        $data = $request->except("log","ban");

        if($request->hasFile("log")){
            $logo = $this->uploadSingleImage($request, 'log');
            $data['logo'] = $logo;
        }
        if($request->hasFile("ban")){
            $banner = $this->uploadSingleImage($request, 'ban');
            $data['banner'] = $banner;
        }

        if($request->hasFile("ban") || $request->hasFile("log") || count($request->all())>0){

            $page->update($data);
            return back()->with("success","Page Updated Successfully");

        }

        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);
        if($page && auth()->user()){


            $posts = Posts::where("page_id",$page->id)->get();

            foreach ($posts as $post){
                $post->delete();
            }
            $page->delete();

            return redirect()->route("pages.list");
        }
    }
}
