<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('/')->namespace('App\Http\Controllers')->group(function()
{

// plan  
Route::get('plan','IndexController@plan')->name('user.plan');
Route::get('basicPay','IndexController@basicPay')->name('basicPay');
Route::get('proPlan','IndexController@proPlan')->name('proPlan');
Route::get('businessPay','IndexController@businessPay')->name('businessPay');

// stripe
Route::post('stripePayment','IndexController@stripePayment')->name('stripe.payment');
Route::get('stripePaymentSuccess','IndexController@stripeSuccessPayment')->name('stripe.paymentSuccess');

Route::get('/','IndexController@login')->name('login');
Route::post('admin-post','IndexController@AdminLoginPost')->name('AdminLoginPost');
});

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function()
{
    Route::get('dashboard','AdminController@dashboard')->name('admin.dashboard');
    Route::get('user','AdminController@user')->name('admin.user');
    Route::get('admin','AdminController@admin')->name('admin.admin');
    Route::get('getData','AdminController@getData')->name('admin.getData');
    Route::get('admingetData','AdminController@admingetData')->name('admin.admingetData');
    Route::resource('admins', AdminController::class);

    Route::post('admin-post','AdminController@adminPost')->name('admin.adminPost');
    
    Route::group(['middleware' => ['admin']], function () {
        
    });

});