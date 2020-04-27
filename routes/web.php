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

Route::group(['middleware' => 'user.role'], function () {
    Route::get('/manage', 'HomeController@manage')->name('manage');
    Route::get('/reported', 'HomeController@reportedComment')->name('reported');
    Route::get('/approveTopic/{id}', 'HomeController@approveTopic')->name('approveTopic');
    Route::get('/approve/{id}', 'HomeController@approveComment')->name('approve');
    Route::get('/reject/{id}', 'HomeController@rejectComment')->name('reject');
});

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/delete/{id}', 'HomeController@delete')->name('delete')->middleware('CRUD');

    Route::get('/comment/{id}', 'HomeController@comment')->name('comment')->middleware('CRUD');

    Route::get('/reportComment/{id}', 'HomeController@reportComment')->name('reportComment')->middleware('CRUD');

    Route::post('/postComment/{id}', 'HomeController@postComment')->name('postComment')->middleware('CRUD');

    Route::get('/deleteComment/{id}', 'HomeController@deleteComment')->name('deleteComment')->middleware('CRUD');

    Route::post('/createTopic', 'HomeController@createTopic')->name('createTopic')->middleware('CRUD');

    Route::get('/showTopicForm', 'HomeController@showTopicForm')->name('showTopicForm')->middleware('CRUD');

    Route::get('/editTopic/{id}', 'HomeController@editTopic')->name('editTopic')->middleware('CRUD');

    //topics which have been previously approved do not need reapproval form admin
    Route::post('/saveTopic/{id}', 'HomeController@saveTopic')->name('saveTopic')->middleware('CRUD');



