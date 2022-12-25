<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\DonationRequestController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout']);

Route::post('/reset-password',[AuthController::class,'resetPassword']);
Route::post('/new-password',[AuthController::class,'sendNewPassword']);

Route::get('/posts',[MainController::class,'posts']);


Route::group(['middleware'=>['auth:client-api']],function(){
    Route::get('/governorates',[MainController::class,'governorates']);
    Route::get('/cities',[MainController::class,'cties']);

    Route::post('/profile',[AuthController::class,'profile']);
    Route::post('/toggle-post-favourite',[MainController::class,'togglePostFavourite']);
    Route::get('/my-favourite-posts',[MainController::class,'getMyFavouritePosts']);

    Route::post('/register-device-token',[AuthController::class,'registerDeviceToken']);
    Route::post('/remove-device-token',[AuthController::class,'removeDeviceToken']);

    Route::get('/get-notification-settings',[DonationRequestController::class,'getNotificationSettings']);
    Route::post('/update-notification-settings',[DonationRequestController::class,'updateNotificationSettings']);
    Route::post('/create-donation-request',[DonationRequestController::class,'createDonationRequest']);
    Route::get('/donation-requests',[DonationRequestController::class,'donationRequests']);


    Route::post('/send-message',[MainController::class,'sendMessage']);

    Route::get('/settings',[MainController::class,'settings']);
});
