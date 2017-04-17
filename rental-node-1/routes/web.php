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
    return redirect('/cars');
});

Route::get('/carmodels', 'CarmodelController@listItem');
Route::post('/carmodels/datatable', 'CarmodelController@datatable');
Route::get('/carmodels/create', 'CarmodelController@createForm');
Route::post('/carmodels/create', 'CarmodelController@createItem');
Route::get('/carmodels/{id}/update', 'CarmodelController@updateForm');
Route::post('/carmodels/{id}/update', 'CarmodelController@updateItem');
Route::post('/carmodels/{id}/delete', 'CarmodelController@deleteItem');

Route::get('/cars', 'CarController@listItem');
Route::post('/cars/datatable', 'CarController@datatable');
Route::get('/cars/create', 'CarController@createForm');
Route::post('/cars/create', 'CarController@createItem');
Route::get('/cars/{id}/update', 'CarController@updateForm');
Route::post('/cars/{id}/update', 'CarController@updateItem');
Route::post('/cars/{id}/delete', 'CarController@deleteItem');

Route::get('/booking', 'BookingController@newItem');
Route::get('/booking/confirmed', 'BookingController@confirmedItem');
Route::get('/booking/rejected', 'BookingController@rejectedItem');
Route::get('/booking/canceled', 'BookingController@canceledItem');
Route::get('/booking/all', 'BookingController@allItem');
Route::get('/booking/{kode_booking}/detail', 'BookingController@detailItem');

Route::post('/booking/all', 'BookingController@DTallItem');
Route::post('/booking/new', 'BookingController@DTnewItem');
Route::post('/booking/confirmed', 'BookingController@DTconfirmedItem');
Route::post('/booking/rejected', 'BookingController@DTrejectedItem');
Route::post('/booking/canceled', 'BookingController@DTcanceledItem');

Route::post('/booking/{id}/confirm', 'BookingController@confirmItem');
Route::post('/booking/{id}/reject', 'BookingController@rejectItem');
Route::post('/booking/{id}/cancel', 'BookingController@cancelItem');


Route::get('/bookinghistory', 'BookingHistoryController@listItem');
Route::post('/bookinghistory/datatable', 'BookingHistoryController@datatable');