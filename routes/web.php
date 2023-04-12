<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\GoogleSocialiteController;
use App\Http\Controllers\FacebookSocialiteController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    return redirect(route('login'));
});

Route::get('login/google', [GoogleSocialiteController::class, 'redirectToGoogle'])->name('login.google');
Route::get('callback/google', [GoogleSocialiteController::class, 'handleCallback'])->name('callback.google');

Route::get('login/facebook', [FacebookSocialiteController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('callback/facebook', [FacebookSocialiteController::class, 'handleCallback'])->name('callback.facebook');

Route::match(["get", "post"],"check-email/{email}",[App\Http\Controllers\HomeController::class,"checkEmail"]);
Route::get('/register/userstatus',[\App\Http\Controllers\api\AuthController::class,'userStatus']);
//Protected Routes
Route::group([
    'middleware' => ['auth', 'verified']
], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/discover', [App\Http\Controllers\HomeController::class, 'discover'])->name('discover');
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/experience', [App\Http\Controllers\ProfileController::class, 'experience'])->name('experience');
    Route::get('/experience/edit/{id}', [App\Http\Controllers\ProfileController::class, 'experienceEdit'])->name('experience.edit');
    Route::post('/experience/update', [App\Http\Controllers\ProfileController::class, 'experienceUpdate'])->name('experience.update');

    Route::get('/inbox/{id?}', [App\Http\Controllers\ChatController::class, 'inbox'])->name('inbox');
    Route::post('/getConversationMessages', [App\Http\Controllers\ChatController::class, 'getConversationMessages'])->name('getConversationMessages');
    Route::post('/sendMessage', [App\Http\Controllers\ChatController::class, 'sendMessage'])->name('sendMessage');
    Route::post('/setMeeting', [App\Http\Controllers\ChatController::class, 'setMeeting'])->name('setMeeting');
    Route::post('/AcceptRejectMeeting', [App\Http\Controllers\ChatController::class, 'AcceptRejectMeeting'])->name('AcceptRejectMeeting');

    //Complete Meeting
    Route::post("/CompleteMeeting",[App\Http\Controllers\ChatController::class, 'CompleteMeeting'])->name("CompleteMeeting");

    Route::get('user/calling/{meeting_id}', [ChatController::class, 'call'])->name('user.calling');

    Route::post('/sendRequest', [App\Http\Controllers\FriendController::class, 'sendRequest'])->name('friend.request.send');
    Route::post('/friend/requests', [App\Http\Controllers\FriendController::class, 'friendRequestList'])->name('friend.request.list');
    Route::post('/friend/requests/action', [App\Http\Controllers\FriendController::class, 'friendRequestAction'])->name('friend.request.action');
    Route::post('/friend/unfriend', [App\Http\Controllers\FriendController::class, 'unfriend'])->name('friend.unfriend');
    Route::get('/friend/list', [App\Http\Controllers\FriendController::class, 'friendList'])->name('friend.list');
    Route::get('/friend/list/ajax', [App\Http\Controllers\FriendController::class, 'getFriendListAjax'])->name('friend.list');

    Route::get('/notifications/list', [App\Http\Controllers\HomeController::class, 'notifications'])->name('notifications.list');
    Route::post("/notifications/clearAllNotifications",[App\Http\Controllers\HomeController::class, 'clearAllNotifications']);


    Route::get('engagements/list', [App\Http\Controllers\EngagementController::class, 'list'])->name('engagements.list');
    Route::get('engagements/verify/{id}', [App\Http\Controllers\EngagementController::class, 'verify'])->name('engagements.verify');


    Route::group([
        'prefix' => 'wallet'
    ], function () {
        Route::get('/', [App\Http\Controllers\WalletController::class, 'wallet'])->name('wallet');
        Route::get('withdrawal', [App\Http\Controllers\WalletController::class, 'withdrawal'])->name('withdrawal');
        Route::post('addEbank', [App\Http\Controllers\WalletController::class, 'addEbank'])->name('addEbank');
        Route::post('withdrawalRequest', [App\Http\Controllers\WalletController::class, 'withdrawalRequest'])->name('withdrawalRequest');

//        Route::get("my-wallet",[App\Http\Controllers\WalletController::class, 'myWallet'])->name('wallet.my-wallet');
    });

    Route::group([
        'prefix' => 'post'
    ], function () {
        Route::post('/edit',[\App\Http\Controllers\PostsController::class,'edit'])->name('post.edit');
        Route::post('/update',[\App\Http\Controllers\PostsController::class,'update'])->name('post.update');
        Route::post('/store', [App\Http\Controllers\PostsController::class, 'store'])->name('post.store');
        Route::post('/repost', [App\Http\Controllers\PostsController::class, 'repost'])->name('post.repost');
        Route::post('/rate', [App\Http\Controllers\PostsController::class, 'rate'])->name('post.rate');
        Route::post('/reflect', [App\Http\Controllers\PostsController::class, 'reflect'])->name('post.reflect');
        Route::post('/reflect/more', [App\Http\Controllers\PostsController::class, 'getMoreReflections'])->name('post.reflections.more');
        Route::get('/show/{id}', [App\Http\Controllers\PostsController::class, 'show'])->name('post.show');
        Route::get('/detail/{id}', [App\Http\Controllers\PostsController::class, 'postDetail'])->name('post.detail');

        Route::get('/saved',[\App\Http\Controllers\PostsController::class,'savedPostGet'])->name('post.saved');
        Route::post('/save',[\App\Http\Controllers\PostsController::class,'savePost'])->name('post.save');
        Route::post('/delete',[\App\Http\Controllers\PostsController::class,'delete'])->name('post.delete');

        Route::post("/delete-comment",[\App\Http\Controllers\PostsController::class,'deleteComment']);
        Route::post("/update-comment",[\App\Http\Controllers\PostsController::class,'updateComment']);

        Route::post('/report',[\App\Http\Controllers\PostsController::class,'reportPost']);

    });
    Route::group([
        'prefix' => 'group'
    ], function () {
        Route::get('list', [App\Http\Controllers\GroupController::class, 'list'])->name('group.list');
        Route::get('all', [App\Http\Controllers\GroupController::class, 'allGroups'])->name('group.all');
        Route::get('create', [App\Http\Controllers\GroupController::class, 'create'])->name('group.create');
        Route::post('store', [App\Http\Controllers\GroupController::class, 'store'])->name('group.store');
        Route::get('detail/{id}', [App\Http\Controllers\GroupController::class, 'detail'])->name('group.detail');
        Route::get('delete/{id}', [App\Http\Controllers\GroupController::class, 'deleteGroup']);

        //for ajax
        Route::post('join', [App\Http\Controllers\GroupController::class, 'join'])->name('group.join');
        Route::post('leave', [App\Http\Controllers\GroupController::class, 'leave'])->name('group.leave');
    });
    Route::group([
        'prefix' => 'job'
    ], function () {

        Route::get('list', [App\Http\Controllers\JobController::class, 'list'])->name('job.list');
        Route::get('my-jobs',[App\Http\Controllers\JobController::class, 'userList'])->name('job.list.user');
        Route::get('detail/{id}', [App\Http\Controllers\JobController::class, 'detail'])->name('job.detail');

        //for ajax
        Route::post('apply', [App\Http\Controllers\JobController::class, 'apply'])->name('job.apply');

        Route::get("getJobApplicants/{id}",[App\Http\Controllers\JobController::class, 'getJobApplicants']);
    });

    Route::resource('page', PageController::class);
    Route::get('page/setup/{id}', [App\Http\Controllers\PageController::class, 'pageSetup'])->name('page.setup');
    Route::get('page/follow/{id}', [App\Http\Controllers\PageController::class, 'pageFollow'])->name('page.follow');
    Route::get('page/unfollow/{id}', [App\Http\Controllers\PageController::class, 'pageUnfollow'])->name('page.unfollow');
    Route::get('page/detail/{id}', [App\Http\Controllers\PageController::class, 'show'])->name('page.detail');
    Route::get('pages/list', [App\Http\Controllers\PageController::class, 'pagesList'])->name('pages.list');
    Route::get('pages/list/user', [App\Http\Controllers\PageController::class, 'myPagesList'])->name('pages.list.user');
    Route::get('pages/delete/{id}', [App\Http\Controllers\PageController::class, 'destroy']);
    Route::post("pages/update/{id}", [App\Http\Controllers\PageController::class, 'update']);

    Route::group([
        'prefix' => 'user'
    ], function () {
        Route::get('/profile/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('user.profile.show');
        Route::post('get', [App\Http\Controllers\UserController::class, 'getuser'])->name('user.get');
        Route::post('addSkill', [App\Http\Controllers\UserController::class, 'addSkill'])->name('user.skill.add');
        Route::post('removeSkill', [App\Http\Controllers\UserController::class, 'removeSkill']);
    });

    Route::post('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search');
    Route::post('/search/skills', [App\Http\Controllers\SearchController::class, 'skills'])->name('search');
    Route::post('subscription',[\App\Http\Controllers\SubscriptionController::class,'getSubscription'])->name('subscription');
    Route::get('unsubscribe',[\App\Http\Controllers\SubscriptionController::class,'unsubscribe'])->name('unsubscribe');


    Route::get('/notifications', [App\Http\Controllers\HomeController::class, 'getAllNotifications']);

});



Route::get('/migrate', function(){
    Artisan::call('migrate');
 });


 Route::get('/rollback', function(){
    Artisan::call('migrate:rollback');
 });

 Route::get('/symlink', function(){
    Artisan::call('storage:link');
 });
 Route::get('/privacy-policy', function(){
    return view('privacy.privacyPolicy');
 })->name('policy');
 Route::get('/cookie-policy', function(){
    return view('privacy.cookiePolicy');
 })->name('cookie.policy');
 Route::get('/disclaimer', function(){
    return view('privacy.disclaimer');
 })->name('disclaimer');
 Route::get('/terms-of-use', function(){
    return view('privacy.terms');
 })->name('terms');
 Route::get('/about', function(){
    return view('privacy.about');
 })->name('about');


//App Cache Clear
Route::get('cache-clear', function () {
    // \Artisan::call('optimize:clear');
    Artisan::call("config:clear");

    Artisan::call("config:cache");

    Artisan::call("route:clear");

    Artisan::call("view:clear");
    return redirect('/');
});


//resolve route by slug
// Route::get('/posts/{post:slug}', function (Post $post) {
//     return $post;
// });


// Route::get('/users/{user}/posts/{post:slug}', function (User $user, Post $post) {
//     return $post;
// });
require __DIR__.'/auth.php';
