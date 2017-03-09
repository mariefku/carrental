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
    return redirect('/search');
});
Route::get('/admin', function () {
    return redirect('/admin/carmodels');
});


Route::get('/search', 'SearchController@searchCar');

Route::get('/admin/carmodels', 'CarmodelController@listItem');
Route::post('/admin/carmodels/datatable', 'CarmodelController@datatable');
Route::get('/admin/carmodels/create', 'CarmodelController@createForm');
Route::post('/admin/carmodels/create', 'CarmodelController@createItem');
Route::get('/admin/carmodels/{id}/update', 'CarmodelController@updateForm');
Route::post('/admin/carmodels/{id}/update', 'CarmodelController@updateItem');
Route::post('/admin/carmodels/{id}/delete', 'CarmodelController@deleteItem');

Route::get('/admin/destinations', 'DestinationController@listItem');
Route::post('/admin/destinations/datatable', 'DestinationController@datatable');
Route::get('/admin/destinations/create', 'DestinationController@createForm');
Route::post('/admin/destinations/create', 'DestinationController@createItem');
Route::get('/admin/destinations/{id}/update', 'DestinationController@updateForm');
Route::post('/admin/destinations/{id}/update', 'DestinationController@updateItem');
Route::post('/admin/destinations/{id}/delete', 'DestinationController@deleteItem');

Route::get('/admin/rentals', 'RentalController@listItem');
Route::post('/admin/rentals/datatable', 'RentalController@datatable');
Route::get('/admin/rentals/create', 'RentalController@createForm');
Route::post('/admin/rentals/create', 'RentalController@createItem');
Route::get('/admin/rentals/{id}/update', 'RentalController@updateForm');
Route::post('/admin/rentals/{id}/update', 'RentalController@updateItem');
Route::post('/admin/rentals/{id}/delete', 'RentalController@deleteItem');
