<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LicenseController;
use GuzzleHttp\Middleware;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SettingController;
use App\Models\Setting;
use Laravel\Passport\AuthCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Spatie\Permission\Contracts\Role;
use App\Http\Controllers\EventController;


Route::group(['middleware' => ['mode', 'XSS']], function () {

    Route::get('/', [FrontendController::class, 'home'])->name('home');
    Route::post('/send-to-admin', [FrontendController::class, 'sentMessageToAdmin']);
    Route::get('/privacy_policy', [FrontendController::class, 'privacypolicy']);
    Route::get('/FAQ', [FaqController::class, 'show']);
    Route::get('/appuser-privacy-policy', [FrontendController::class, 'appuserPrivacyPolicyShow']);
    Route::get('/show-details/{id}', [OrderController::class, 'showTicket']);
    Route::get('/events_details/{id}',[EventController::class,'show']);


    Route::group(['prefix' => 'user'], function () {

        Route::get('/VerificationConfirm/{id}', [FrontendController::class, 'LoginByMail']);
        Route::get('/register', [FrontendController::class, 'register']);
        Route::post('/register', [FrontendController::class, 'userRegister']);
        Route::get('login', [FrontendController::class, 'login']);
        Route::post('/login', [FrontendController::class, 'userLogin']);
        Route::get('/resetPassword', [FrontendController::class, 'resetPassword']);
        Route::post('/resetPassword', [FrontendController::class, 'userResetPassword']);
        Route::get('/org-register', [FrontendController::class, 'orgRegister']);
        Route::post('/org-register', [FrontendController::class, 'organizerRegister']);
        Route::get('/logout', [LicenseController::class, 'adminLogout'])->name('logout');
        Route::get('/logoutuser', [FrontendController::class, 'userLogout'])->name('logoutUser');
        Route::post('/search_event',[FrontendController::class,'searchEvent']);
        Route::get('/tag/{tagname}',[FrontendController::class,'eventsByTag']);
        Route::get('/blog-tag/{tagname}',[FrontendController::class,'blogByTag']);
        Route::get('/FAQs',[FrontendController::class,'Faqs']);
    });
    Route::group(['middleware' => 'checkStatus'], function () {

        Route::get('/all-events', [FrontendController::class, 'allEvents']);
        Route::post('/all-events', [FrontendController::class, 'allEvents']);
        Route::get('/events-category/{id}/{name}', [FrontendController::class, 'categoryEvents']);
        Route::get('/event-type/{type}', [FrontendController::class, 'eventType']);
        Route::get('/event/{id}/{name}', [FrontendController::class, 'eventDetail']);
        Route::get('/events/{id}', [FrontendController::class, 'eventDetail']);
        Route::get('/organization/{id}/{name}', [FrontendController::class, 'orgDetail']);
        Route::post('/report-event', [FrontendController::class, 'reportEvent']);
        Route::get('/all-category', [FrontendController::class, 'allCategory']);
        Route::get('/all-blogs', [FrontendController::class, 'blogs']);
        Route::get('/blog-detail/{id}/{name}', [FrontendController::class, 'blogDetail']);
        Route::get('/contact', [FrontendController::class, 'contact']);

        Route::group(['middleware' => 'appuser'], function () {

            Route::get('email/verify/{id}/{token}', [FrontendController::class, 'emailVerify']);
            Route::get('/checkout/{id}', [FrontendController::class, 'checkout']);
            Route::post('/applyCoupon', [FrontendController::class, 'applyCoupon']);
            Route::post('/createOrder', [FrontendController::class, 'createOrder']);
            Route::get('/user/profile', [FrontendController::class, 'userTickets']);
            Route::get('/add-favorite/{id}/{type}', [FrontendController::class, 'addFavorite']);
            Route::get('/add-followList/{id}', [FrontendController::class, 'addFollow']);
            Route::post('/add-bio', [FrontendController::class, 'addBio']);
            Route::get('/change-password', [FrontendController::class, 'changePassword']);
            Route::post('/user-change-password', [FrontendController::class, 'changeUserPassword']);
            Route::post('/upload-profile-image', [FrontendController::class, 'uploadProfileImage']);
            Route::get('/my-tickets', [FrontendController::class, 'userTickets']);
            Route::get('/my-ticket/{id}', [FrontendController::class, 'userOrderTicket']);

            Route::get('/update_profile', [FrontendController::class, 'update_profile']);
            Route::post('/update_user_profile', [FrontendController::class, 'update_user_profile']);
            Route::get('/getOrder/{id}', [FrontendController::class, 'getOrder']);
            Route::post('/add-review', [FrontendController::class, 'addReview']);
            Route::get('/web/create-payment/{id}', [FrontendController::class, 'makePayment']);
            Route::post('/web/payment/{id}', [FrontendController::class, 'initialize'])->name('frontendPay');
            Route::get('/web/rave/callback/{id}', [FrontendController::class, 'callback'])->name('frontendCallback');
        });
    });
});
