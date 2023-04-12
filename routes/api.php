<?php
namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('getCountries', [GenericController::class, 'getCountries']);
Route::get('getEmploymentTypes', [GenericController::class, 'getEmploymentTypes']);


Route::group([
    'prefix' => 'user'
], function () {
    //Public Routes

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('otp/resend', [AuthController::class, 'resendOTP']);
    Route::prefix('verify')->group(function () {
        Route::post('user', [AuthController::class, 'verifyUser']);
        Route::post('otp', [AuthController::class, 'verifyOTP']);
    });

    Route::post('password/reset', [AuthController::class, 'resetPassword']);

    //Protected Routes
    Route::group([
        'middleware' => 'auth:sanctum'
    ], function(){
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('/getUser', [AuthController::class, 'getUser']);
        Route::post('setPassword', [AuthController::class, 'setPassword']);
        Route::post('updateProfile', [UserController::class, 'updateProfile']);
        Route::post('visitProfile', [UserController::class, 'visitProfile']);
        Route::post('uploadProfilePic', [UserController::class, 'uploadProfilePic']);

        Route::prefix('experience')->group(function () {
            Route::get('/', [ExperienceController::class, 'userExperienceList']);
            Route::post('updateOrCreate', [ExperienceController::class, 'updateOrCreate']);
        });


    });

});

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::prefix('post')->group(function () {
        Route::post('create', [PostController::class, 'create']);
        Route::post('rate', [PostController::class, 'rate']);
        Route::post('reflect', [PostController::class, 'reflect']);
        Route::post('getMoreReflections', [PostController::class, 'getMoreReflections']);
        Route::get('getFeedPosts', [PostController::class, 'getFeedPosts']);
        Route::post('bookmark', [PostController::class, 'bookmark']);
        Route::get('bookmark/list', [PostController::class, 'bookmarkPostsList']);
    });

    Route::prefix('jobs')->group(function () {
        Route::get('/', [JobsController::class, 'getJobs']);
        Route::post('detail', [JobsController::class, 'detail']);
        Route::post('apply', [JobsController::class, 'apply']);
        Route::get('myjobs', [JobsController::class, 'myjobs']);


    });

    Route::prefix('fellow')->group(function () {
        Route::get('myFellows', [FellowController::class, 'myFellows']);
        Route::post('sendRequest', [FellowController::class, 'sendRequest']);
        Route::post('requestList', [FellowController::class, 'friendRequestList']);
        Route::post('acceptReject', [FellowController::class, 'friendRequestAction']);
        Route::post('remove', [FellowController::class, 'unfriend']);

    });

    Route::prefix('engagements')->group(function () {
        Route::get('/', [EngagementController::class, 'getEngagements']);
    });


    Route::prefix('group')->group(function () {
        Route::get('/', [GroupController::class, 'groups']);
        Route::post('create', [GroupController::class, 'create']);
        Route::post('join', [GroupController::class, 'join']);
        Route::post('leave', [GroupController::class, 'leave']);
        Route::post('posts', [GroupController::class, 'posts']);
    });

    Route::prefix('page')->group(function () {
        Route::get('/', [PageController::class, 'pages']);
        Route::post('create', [PageController::class, 'create']);
        Route::post('follow', [PageController::class, 'follow']);
        Route::post('unfollow', [PageController::class, 'unfollow']);
        Route::post('posts', [PageController::class, 'posts']);
    });

    Route::prefix('chat')->group(function () {
        Route::get('/inbox', [ChatController::class , 'inbox']);
        Route::post('/getConversationMessages', [ChatController::class , 'getConversationMessages']);
        Route::post('/sendMessage', [ChatController::class , 'sendMessage']);

    });

    Route::post('subscribe', [SubscriptionController::class, 'subscribe']);

});

