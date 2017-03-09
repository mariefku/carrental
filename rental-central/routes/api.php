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

Route::post('/carmodels/', 'CarmodelController@apiListItem');
Route::post('/carmodels/{id}', 'CarmodelController@apiShowItem');
Route::post('/destinations/', 'DestinationController@apiListItem');
Route::post('/destinations/{id}', 'DestinationController@apiShowItem');
