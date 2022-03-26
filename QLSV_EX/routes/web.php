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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get("tai-khoan/dang-nhap", 'UserController@login')->name('login');
Route::get("tai-khoan/dang-ky", 'UserController@add')->name('addUser');
Route::post("user/checkLogin", 'UserController@checkLogin')->name('checkLogin');
Route::middleware('checkLogin')->group(function () {
    Route::get("/", 'HomeController@index')->name('home');
    //User

    Route::get("user/logout", 'UserController@logout')->name('logout');
    Route::post('user/store', 'UserController@store')->name('storeUser');
    Route::get('user/delete/{id}', 'UserController@delete')->name('deleteUser');
    Route::get('user/edit/{id}', 'UserController@edit')->name('editUser');
    Route::post('user/update/{id}', 'UserController@update')->name('updateUser');
    //Exercise
    Route::get('exercise/list', 'ExerciseController@index')->name('listExercise');
    Route::get('exercise/add', 'ExerciseController@add')->name('addExercise');
    Route::post('exercise/store', 'ExerciseController@store')->name('storeExercise');
    Route::get('exercise/delete/{id}', 'ExerciseController@delete')->name('deleteExercise');
    Route::get('exercise/submit/{id}', 'ExerciseController@submit')->name('submitExercise');
    Route::post('exercise/storeSubmit/{id}', 'ExerciseController@storeSubmit')->name('storeSubmitExercise');
    Route::get('exercise/seeSubmit/{id}', 'ExerciseController@seeSubmit')->name('seeSubmitExercise');
    //Challenge
    Route::get('challenge/list', 'ChallengeController@index')->name('listChallenge');
    Route::get('challenge/add', 'ChallengeController@add')->name('addChallenge');
    Route::post('challenge/store', 'ChallengeController@store')->name('storeChallenge');
    Route::get('challenge/delete/{id}', 'ChallengeController@delete')->name('deleteChallenge');
    Route::get('challenge/submit/{id}', 'ChallengeController@submit')->name('submitChallenge');
    Route::post('challenge/storeSubmit/{id}', 'ChallengeController@storeSubmit')->name('storeSubmitChallenge');
    Route::get('exercise/seeSubmit/{id}', 'ExerciseController@seeSubmit')->name('seeSubmitExercise');
    //Message
    Route::get('message/send/{id}', 'MessageController@send')->name('sendMessage');
    Route::post('message/store/{id}', 'MessageController@store')->name('storeMessage');
    Route::get('message/delete/{id}', 'MessageController@delete')->name('deleteMessage');
    Route::get('message/edit/{id}', 'MessageController@edit')->name('editMessage');
    Route::post('message/update/{id}', 'MessageController@update')->name('updateMessage');
});
