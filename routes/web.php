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


Route::get('/getFile', function(Request $request) {
    // dd(request()->input('a'));
    $filename = request()->input('a');
    $file = Storage::disk('local')->get($filename);
    header('Content-Type', 'image/jpg');
    echo $file;
 
		// return (new Response($file, 200 ));
});