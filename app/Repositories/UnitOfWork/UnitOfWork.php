<?php
namespace App\Repositories\UnitOfWork;

use App\Repositories\UnitOfWork\iUnitOfWork;
use App\Repositories\URL\iUrlRepository;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Users\iUserRepository;
use App\Repositories\Auth\iAuthRepository;
use App\Repositories\Post\iPostRepository;

class UnitOfWork implements iUnitOfWork{
    
    public $url;
    public $user;
    public $auth;
    public $post;

    public function __construct(iUrlRepository $url, iUserRepository $user, iAuthRepository $auth, iPostRepository $post)
    {
        $this->url = $url;
        $this->user = $user;
        $this->auth = $auth;
        $this->post = $post;
    }
    
    public function gate($gate){

        if(Gate::denies($gate)){
            return true;
         }
    }

    public function response(array $data, $status = 200){
       
        return response()->json($data, $status);
    }

}