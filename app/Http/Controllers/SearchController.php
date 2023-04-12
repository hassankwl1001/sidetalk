<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Skill;
use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\UnitOfWork\iUnitOfWork;

class SearchController extends Controller
{
    private $unitOfWork;

    public function __construct(iUnitOfWork $unitOfWork)
    {
        $this->unitOfWork = $unitOfWork;
    }

    public function search(Request $request){

        $profileUrl =  env("PROFILE_URL");
        $profileUrl = url("/") ."/storage/app/media";

        $users = User::where('firstname', 'like', '%'.$request->keyword.'%')
        ->orWhere('lastname', 'like', '%'.$request->keyword.'%')
        ->orWhere('current_position', 'like', '%'.$request->keyword.'%')
        ->orWhere('job_title', 'like', '%'.$request->keyword.'%')
        ->where('id', '!=', auth()->id())
        ->get();

//        $pageUrl = env("PAGE_CONTENT_URL");
        $pageUrl = url('/')."/storage/app/media";

        $pages = Page::where('name', 'like', '%'.$request->keyword.'%')->get();
        $groups = Group::where('name', 'like', '%'.$request->keyword.'%')->get();

        return $this->unitOfWork->response(['user' => $users, 'pages'=>$pages,'groups'=>$groups,'profileUrl' => $profileUrl, 'pageUrl' => $pageUrl]);

    }

    public function skills(Request $request)
    {
        $skills = Skill::select('name')->distinct()->where('name', 'like', '%'.$request->keyword.'%')->get();
        return $skills;
    }
}
