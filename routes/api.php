<?php

use Illuminate\Http\Request;

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


Route::post('/checkin', 'Api\CheckinController@checkin');
Route::post('/nearby', 'Api\CheckinController@nearby');
Route::post('/bot', 'Api\CheckinController@bot');