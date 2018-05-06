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

use App\Events\MessagePosted;
use App\User;

Route::get('/', function () {
    return view('home');
})->middleware('auth');



Route::group(['middleware' => 'auth'], function () {
    
    Route::get('/chat',function(){
        return view('chat');
    });

    //get all messages from database
    Route::get('/messages','MessagesController@index');

    //add new msg to the database
    Route::post('/messages','MessagesController@store');

    //get all rooms (groups from database
    Route::get('/groups','GroupsController@index');

    //add new group to database
    Route::post('/groups','GroupsController@store');

    Route::get('/users',function(){
        return User::with('messages','groupsAdmin','groupsSubscriber')->get();
    });

    Route::get('/user',function(){
        return Auth::user();
    });

});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');


