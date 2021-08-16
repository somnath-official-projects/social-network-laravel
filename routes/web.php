<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::group(['namespace'=>'App\Http\Controllers', 'middleware' => 'auth'], function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('user/account', 'AccountController@index')->name('account');
    Route::get('user/account/edit', 'AccountController@edit')->name('account-edit');
    Route::post('user/account/update', 'AccountController@update')->name('account-update');
    Route::get('view-profile/{id}', 'UserProfileController@index')->name('view-user-profiile');
    Route::post('search-user', 'UserSearchController@index')->name('view-user-profiile');
    Route::post('send-friend-request', 'FriendRequestController@send')->name('send-friend-request');
    Route::post('cancel-friend-request', 'FriendRequestController@cancel')->name('cancel-friend-request');
    Route::post('unfriend', 'FriendRequestController@unfriend')->name('unfriend');
    Route::post('accept-friend-request', 'FriendRequestController@accept')->name('accept-friend-request');
    Route::get('user/friend-list', 'FriendRequestController@friendList')->name('accept-friend-request');
});