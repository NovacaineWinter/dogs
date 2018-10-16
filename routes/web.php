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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/api/create-new-user','customerController@signup');

Route::post('/api/webhooks','stripeController@webhooks');

Route::post('/api/checkemail','customerController@checkEmail');

Route::get('/api/cancellationReasons','customerController@allCancellationReasons');

Route::get('/api/add-new-subscription','customerController@allCancellationReasons');

Route::post('/api/cancelSubscription','customerController@cancelSubscription');

Route::post('/api/update/dog-details','customerController@updateDogDetails');

Route::get('/api/plans', 'vuePublic@plans');

Route::post('/vue/contact/message','contactController@receiveMessage');

Route::get('/api/get-logged-in-user', 'customerController@loggedInDetails');