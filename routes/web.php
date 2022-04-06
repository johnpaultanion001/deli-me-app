<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/customer/home');

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('optimize:clear');
    // return what you want
});

// Route::get('/', 'LandingpageController@index')->name('landingpage');
Route::get('view/{product}', 'LandingpageController@view')->name('view');


Route::group(['prefix' => 'customer', 'as' => 'customer.', 'namespace' => 'Customer', 'middleware' => ['auth']], function () {
    Route::get('/approve', function() {
           return view('auth.checkapprove');
         });
 });

Auth::routes();

Route::group(['prefix' => 'customer', 'as' => 'customer.', 'namespace' => 'Customer', 'middleware' => ['auth', 'checkapproved']], function () {
   
    // Home
    Route::get('home', 'HomeController@index')->name('home');

    //Add To Cart
    Route::post('addtocart', 'OrderController@addtocart')->name('addtocart');
    Route::get('orders', 'OrderController@orders')->name('orders');
    Route::get('orders_history', 'OrderController@orders_history')->name('orders_history');

    //Check Out
    Route::post('checkout', 'OrderController@checkout')->name('checkout');

    //Profile
    Route::get('profile', 'HomeController@profile')->name('profile');

});

