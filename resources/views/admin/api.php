<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PackageController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/uploadImage', [PackageController::class,'store']);


Route::get('/packageCategory', [CategoryController::class, 'tourCategory']);
Route::get('/allCategory', [CategoryController::class, 'allCategory']);
Route::get('/homeBanner', [PackageController::class, 'homeBanner']);
Route::get('/allPackage', [PackageController::class, 'allPackage']);
Route::get('/testimonials', [PackageController::class, 'testimonials']);
Route::get('/reason', [PackageController::class, 'reasons']);
Route::get('/allEvent', [PackageController::class, 'allEvents']);

Route::post('/categoryPackage', [PackageController::class, 'categoryPackages']);
Route::post('/packageDetail', [PackageController::class, 'packageDetail']);

Route::post('/relatedPackage', [PackageController::class, 'relatedPackage']);

Route::get('/staticPages', [PackageController::class, 'staticPages']);
Route::post('/blogDetail', [PackageController::class, 'blogDetail']);

Route::post('/packageFeedback', [PackageController::class, 'packageFeedback']);
Route::post('/contactRequest', [PackageController::class, 'contactRequest']);
Route::get('/aboutPages', [PackageController::class, 'aboutPages']);

Route::post('/form', [PackageController::class, 'form']);
Route::get('/contactDetail', [PackageController::class, 'contactDetail']);

Route::post('/galleryImage', [PackageController::class, 'galleryImage']);






Route::get('/onboarding', [LoginController::class, 'onboarding']);
Route::get('/topAttraction', [PackageController::class, 'topAttraction']);
Route::get('/exploreWorld', [PackageController::class, 'exploreWorld']);
Route::get('/latestBlog', [PackageController::class, 'latestBlog']);
Route::post('/goaPackage', [PackageController::class, 'goaPackage']);





Route::get('/interests', [LoginController::class, 'interests']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/refreshToken', [LoginController::class, 'refreshToken']);
Route::post('/forgotPassword', [LoginController::class, 'sendResetOtpEmail']);
Route::post('/changePassword', [LoginController::class, 'changePassword']);
Route::post('/verifyOtp', [LoginController::class, 'verifyOtp']);
Route::post('/signup', [SignupController::class,'signup']);






Route::group( ['middleware' => ['auth:api'] ],function()
{
    Route::get('allPost', [PostController::class,'getPosts']);
    Route::post('myProfile', [MyProfileController::class,'myProfiles']);
    Route::get('myPostImage', [PostController::class,'myPostImage']);
    Route::get('mySavePostImage', [PostController::class,'mySavePostImage']);
    Route::post('addPost', [PostController::class,'addPost']);

    Route::get('allMember', [TribeController::class,'allMembers']);
    Route::post('addTribe', [TribeController::class,'addTribe']);
    Route::post('joinTribe', [TribeController::class,'joinTribe']);
    Route::get('myTribe', [TribeController::class,'myTribe']);
    Route::post('viewTribeMember', [TribeController::class,'viewTribeMember']);
    Route::post('editTribe', [TribeController::class,'updateTribe']);

    Route::post('addStory', [StoryController::class,'addStory']);
    Route::get('todayStory', [StoryController::class,'todayStory']);
    Route::post('updateStoryStatus', [StoryController::class,'updateStoryStatus']);
    Route::post('storyComment', [StoryController::class,'storyComment']);
    Route::post('viewStoryResponse', [StoryController::class,'viewStoryResponse']);

    Route::post('updateProfile', [LoginController::class,'updateProfile']);
    Route::post('viewTribe', [TribeController::class,'viewTribe']);
    Route::post('likePost', [PostController::class,'likePost']);
    Route::post('unlikePost', [PostController::class,'unlikePost']);

    Route::post('/savePost', [SavePostController::class, 'savePost']);
    Route::post('/unsavePost', [SavePostController::class, 'unsavePost']);

    Route::post('commentPost', [PostController::class,'addComments']);
    Route::get('getNotification', [UserNotification::class,'getNotification']);

    Route::post('addfollower', [FollowerController::class,'addfollower']);
    Route::post('unfollow', [FollowerController::class,'unfollow']);

    Route::post('addBlockUser', [FollowerController::class,'addBlockUser']);
    Route::post('unBlockUser', [FollowerController::class,'unBlockUser']);

    Route::get('allPlan', [PlanController::class,'getPlan']);
    Route::post('purchasePlan', [PlanController::class,'purchasePlan']);
    Route::get('getMySubscription', [PlanController::class,'getUserSubscription']);

    Route::get('privacy', [PrivacyController::class,'getPrivacyPolicy']);

    Route::post('nearByProfile', [LoginController::class,'getNearbyProfiles']);

});
