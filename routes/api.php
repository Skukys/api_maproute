<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/register', 'App\Http\Controllers\UserController@register');
Route::post('/login', 'App\Http\Controllers\UserController@login');

Route::middleware('checkAuth')->group(function () {
    Route::get('/logout', 'App\Http\Controllers\UserController@logout');
    Route::get('/place', 'App\Http\Controllers\PlaceController@show');
    Route::get('/place/{place:id}', 'App\Http\Controllers\PlaceController@find');
    Route::middleware('checkAdmin')->group(function (){
        Route::post('/place', 'App\Http\Controllers\PlaceController@create');
        Route::delete('/place/{place:id}', 'App\Http\Controllers\PlaceController@destroy');
        Route::post('/place/{place:id}', 'App\Http\Controllers\PlaceController@update');
        Route::post('/schedule', 'App\Http\Controllers\ScheduleController@create');
        Route::delete('/schedule/{schedule:id}', 'App\Http\Controllers\ScheduleController@destroy');
    });
});
