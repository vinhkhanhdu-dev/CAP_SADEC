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

// Route::get('/welcome', function () {
//     return view('welcome');
// });

// Route::any('{all}', function () {
//     return view('index');
// })->where(['all' => '.*']);

// Use now
Route::any('{any}', function () {
    return view('backend');
})->where('any', '^(?!api|images|assets|bower_components|css|js|uploads|admin).*$');



// Route::get('/{any}',function(){
//     return view('index');
// })->where('any','.*');




