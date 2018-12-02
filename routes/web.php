<?php

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
    return view('welcome');
});

Route::get('/email', function () {
    return view('emailTemplates.testEmail');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/api/create-new-user','customerController@signup');

Route::post('/api/webhooks','stripeController@webhooks');

Route::post('/api/checkemail','customerController@checkEmail');

Route::get('/api/cancellationReasons','customerController@allCancellationReasons')->middleware('auth');

Route::get('/api/get-stripe-public-key','stripeController@publicKeyAPI');

Route::post('/api/update-user','customerController@updateUser')->middleware('auth');

Route::post('/api/add-new-subscription','customerController@addSubscriptionToAccount')->middleware('auth');

Route::post('/api/cancelSubscription','customerController@cancelSubscription')->middleware('auth');

Route::post('/api/delete-payment-card','customerController@deleteCard')->middleware('auth');

Route::post('/api/make-payment-card-primary','customerController@makeCardPrimary')->middleware('auth');

Route::post('/api/update/dog-details','customerController@updateDogDetails')->middleware('auth');

Route::get('/api/plans', 'vuePublic@plans');

Route::get('/api/voucher-options', 'vuePublic@vouchers');

Route::post('/api/logout', 'customerController@logout');

Route::get('/api/new-user-next-dispatch','vuePublic@subscribeNowForDeliveryOn');

Route::post('/vue/contact/message','contactController@receiveMessage');

Route::get('/api/get-logged-in-user', 'customerController@loggedInDetails')->middleware('auth');


Route::get('/voucher-code/','vuePublic@voucherCode');

Route::post('/api/buy-giftvoucher','stripeController@buyGiftVoucher');