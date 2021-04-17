<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes(['register' => false]);
// login ajax
Route::post('/login-check', 'Auth\LoginController@check')->name('login.check');
Route::get('/logout', 'HomeController@logout')->name('logout');


Route::group(['prefix' => '/admin', 'middleware'=>['auth']],function(){

    Route::get('/dashboard', 'Admin\AdminController@dashboard')->name('dashboard');
    Route::get('/profile', 'HomeController@profile')->name('profile');
    Route::post('/profile-update', 'HomeController@profile_update')->name('profile-update');
    Route::post('/reset-passeord', 'HomeController@changePassword')->name('changepassword');
    Route::get('/send-mail/{email}', 'HomeController@send_mail');
    Route::resources([
        'user' => Admin\UserController::class,
    ]);

});

Route::group(['prefix' => '/employee', 'middleware'=>['auth']],function(){
    Route::get('/dashbaord', 'Admin\AdminController@dashboard')->name('employee-dashboard');
    Route::get('/profile', 'HomeController@profile')->name('emp-profile');
    Route::post('/profile-update', 'HomeController@profile_update')->name('emp-profile-update');
    Route::post('/reset-passeord', 'HomeController@changePassword')->name('emp-changepassword');
});

