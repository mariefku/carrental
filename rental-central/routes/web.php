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
Auth::routes();

Route::get('/', function () {
    return redirect('/search');
});
Route::get('/admin', function () {
    return redirect('/admin/bookings');
});


Route::get('/search', 'SearchController@searchForm');
Route::get('/search/result', 'SearchController@searchCar');
Route::post('/search/datatable', 'SearchController@datatable');
Route::get('/search/{id_r}/book/{id_c}/{id_d}', 'SearchController@book');

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

Route::get('/bookings', function () {
    return redirect('/search');
});
Route::get('/bookings/form', function () {
    return redirect('/search');
});
Route::get('/bookings/confirmed', function () {
    return redirect('/search');
});
Route::post('/bookings', 'BookingController@viewItem');
Route::post('/bookings/form', 'BookingController@createForm');
Route::post('/bookings/confirm', 'BookingController@confirmItem');
Route::post('/bookings/update', 'BookingController@updateItem');
Route::post('/bookings/confirmed', 'BookingController@storeItem');
Route::post('/bookings/printPDF', 'BookingController@printPDF');
Route::get('/bookings/viewPDF/{kode_booking}', 'BookingController@viewPDF');
Route::get('/bookings/{filename}/getPhoto', 'PhotosController@getPhoto')->name('ktp.getPhoto');

Route::get('/admin/bookings', 'BookingController@listItem');
Route::get('/admin/bookings/{kode_booking}/detail', 'BookingController@detailItem');
Route::post('/admin/bookings/datatable', 'BookingController@datatable');