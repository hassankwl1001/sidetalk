<?php

namespace App\Providers;

use App\Models\Consultation;
use Illuminate\Support\Facades\Response;
use App\Models\Page;

use App\Repositories\Stripe\iStripeRepository;
use App\Repositories\Stripe\StripeRepository;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Auth;

use App\Repositories\Generic\GenericRepository;
use App\Repositories\Generic\iGenericRepository;

use App\Repositories\UnitOfWork\UnitOfWork;
use App\Repositories\UnitOfWork\iUnitOfWork;

use App\Repositories\SingleModel\iSingleModelRepository;
use App\Repositories\SingleModel\SingleModelRepository;

use App\Repositories\URL\iUrlRepository;
use App\Repositories\URL\UrlRepository;

use App\Repositories\Users\iUserRepository;
use App\Repositories\Users\UserRepository;

use App\Repositories\Auth\iAuthRepository;
use App\Repositories\Auth\AuthRepository;

use App\Repositories\Post\iPostRepository;
use App\Repositories\Post\PostRepository;

use App\Repositories\GroupRepository\iGroupRepository;
use App\Repositories\GroupRepository\GroupRepository;

use App\Repositories\ChatRepository\iChatRepository;
use App\Repositories\ChatRepository\ChatRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength('191');
        Paginator::useBootstrap();

        view()->composer('*', function ($view) {

            if(Auth::check()){
                if(auth()->user()->profile_pic != null){
//                    Old Changes
//                    $profile_pic = env('AWS_S3_BUCKET_URL').'media/' . auth()->user()->profile_pic;

                    //New Changes
                    $profile_pic = url('/').'/storage/app/media/' . auth()->user()->profile_pic;

                }else{
                    $profile_pic = asset('assets/img'). "/profile.png";
                }

                $pages = Page::select('id', 'name', 'logo')->where('user_id', auth()->user()->id)->get();

                $usdEarned = auth()->user()->balance;
            }else{
                $profile_pic = 'profile.png';
                $pages = null;
                $usdEarned = 0;
            }

//            $pageUrl = env('PAGE_CONTENT_URL');
            $pageUrl = url('/').'/storage/app/media/';

            $view->with(compact('profile_pic', 'pages', 'pageUrl', 'usdEarned'));
        });

        $this->app->singleton(iGenericRepository::class, GenericRepository::class);
        $this->app->singleton(iUnitOfWork::class, UnitOfWork::class);
        $this->app->singleton(iSingleModelRepository::class, SingleModelRepository::class);
        $this->app->singleton(iUrlRepository::class, UrlRepository::class);
        $this->app->singleton(iUserRepository::class, UserRepository::class);
        $this->app->singleton(iAuthRepository::class, AuthRepository::class);
        $this->app->singleton(iPostRepository::class, PostRepository::class);
        $this->app->singleton(iGroupRepository::class, GroupRepository::class);
        $this->app->singleton(iChatRepository::class, ChatRepository::class);
        $this->app->singleton(iStripeRepository::class,StripeRepository::class);

        Response::macro('success', function ($code, $message, $data = null){
            response()->json([
               'ResponseCode'      =>  $code,
               'ResponseMessage'   =>  $message,
               'data'              =>  $data
           ])->send();
           die;
       });

       Response::macro('error', function ($code, $message, $error, $status = 400){
           return response()->json([
               'ResponseCode'      =>  $code,
               'ResponseMessage'   =>  $message,
               'error'              =>  [$error]
           ], $status);
       });
    }
}
