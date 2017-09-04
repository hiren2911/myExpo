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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('events','EventController@index');
Route::get('event/{event}','EventController@show');
Route::get('company/{user}','RegisterCompanyController@getBookedStand');
Route::post('company','RegisterCompanyController@store');
Route::post('bindStand','RegisterCompanyController@bindStand');
Route::post('file','RegisterCompanyController@uploadFile');