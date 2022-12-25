<?php

use Illuminate\Support\Facades\Route;
use Database\Seeders\GovernorateSeeder;
use App\Http\Controllers\Web\MainWebController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GovernorateController;
use App\Http\Controllers\Admin\DonationRequestController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Web\AuthWebController;
use App\Http\Controllers\Web\DonationRequestWebController;
use App\Http\Controllers\Web\MessageWebController;

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




//dashboard
Route::get('/dashboard', function () {
    return view('admin.pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth','auto_check_permission'])->prefix('/dashboard')->group(function(){
    Route::get('search/{seachTerm}',[GovernorateSeeder::class,'filter']);
    Route::resources([
        'sliders' => SliderController::class,
        'governorates' => GovernorateController::class,
        'cities' => CityController::class,
        'clients' => ClientController::class,
        'categories' => CategoryController::class,
        'posts' => PostController::class,
        'roles' => RoleController::class,
        'users' => UserController::class,
    ]);
    Route::resource('messages', MessageController::class)->only('index','show','destroy');
    Route::resource('donation-requests', DonationRequestController::class)->only('index','show','destroy');
    Route::post('/toggle-client-status/{id}',[ClientController::class,'toggleActivate'])->name('toggle_state');
    Route::get('settings/edit', [SettingController::class,'edit'])->name('settings.edit');
    Route::post('settings/update', [SettingController::class,'update'])->name('settings.update');
    Route::get('/profile/{id}',[ProfileController::class,'profileInfo'])->name('profile.show');
    Route::post('updats/profile/{id}/',[ProfileController::class,'updateProfileInfo'])->name('profile.update');
    Route::post('/change-password/{id}',[ProfileController::class,'changePassword'])->name('password.change');
});


//website
Route::prefix('/web')->group(function(){
    Route::get('/',[MainWebController::class,'index'])->name('web.home');
    Route::get('/who-are-us',[MainWebController::class,'whoAreUs'])->name('whoAreUs');
    Route::get('/contact-us',[MainWebController::class,'ContactUs'])->name('contactUs');
    // Route::get('/about-blood-bank',[MainWebController::class,'aboutBloodBank'])->name('aboutUs');
    Route::get('/posts',[MainWebController::class,'posts'])->name('posts.all');
    Route::get('/post/{id}',[MainWebController::class,'postDetails'])->name('post.details');
    Route::get('/client/register',[AuthWebController::class,'clientRegister'])->name('client.register');
    Route::get('/cities/{governorate_id}',[AuthWebController::class,'getCitiesByGovernorate'])->name('cities.list');
    Route::post('/client/store',[AuthWebController::class,'clientStore'])->name('client.store');
    Route::get('/client/create-login',[AuthWebController::class,'clientCreateLogin'])->name('client.create.login');
    Route::post('/client/login',[AuthWebController::class,'clientLogin'])->name('client.login');

    Route::get('forgot-password', [AuthWebController::class, 'forgetPasswordView'])->name('client.password.request');
    Route::post('/forgot-password', [AuthWebController::class, 'forgetPassword'])->name('client.password.email');
    Route::get('/reset-password', [AuthWebController::class, 'newPassword'])->name('client.password.reset');
    Route::post('/reset-password', [AuthWebController::class, 'updatePassword'])->name('client.password.update');

    Route::middleware(['auth:client-web','is_client'])->group(function(){
        Route::get('/client/notifications_setting/edit/{id}',[DonationRequestWebController::class,'editNotificationsSetting'])->name('client.notifications.edit');
        Route::post('/client/notifications_setting/update/{id}',[DonationRequestWebController::class,'updateNotificationsSetting'])->name('client.notifications.update');
        Route::get('/my/notifications',[DonationRequestWebController::class,'myNotifications'])->name('mynotifications');
        Route::post('/client/notifications/read/{notification_id}',[DonationRequestWebController::class,'readNotification'])->name('readnotification');

        Route::get('/client/profile/edit/{id}',[AuthWebController::class,'clientEditProfile'])->name('client.profile.edit');
        Route::post('/client/profile/update/{id}',[AuthWebController::class,'clientUpdateProfile'])->name('client.profile.update');

        Route::post('/toggle-post-favourite/{id}',[MainWebController::class,'togglePostFavourite']);
        Route::get('/get-my-favourite-posts/{id}',[MainWebController::class,'getMyFavouritePosts'])->name('client.favourite.posts');
        Route::post('/client/logout',[AuthWebController::class,'clientLogout'])->name('client.logout');
        Route::get('/donation-requests',[DonationRequestWebController::class,'donationRequests'])->name('donation.requests');
        Route::get('/donation-requests/{id}',[DonationRequestWebController::class,'showDonationRequest'])->name('donation.request.details');

        Route::post('/send-message',[MessageWebController::class,'sendMessage'])->name('message.send');

        Route::get('/create-donation-request',[DonationRequestWebController::class,'AddDonationRequest'])->name('create.donation.request');
        Route::post('/store-donation-request',[DonationRequestWebController::class,'storeDonationRequest'])->name('store.donation.request');

    });
});


require __DIR__.'/auth.php';





