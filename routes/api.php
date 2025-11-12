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



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::delete('logout', 'AuthController@logout');
        Route::get('me', 'AuthController@user');
        // Route::group(
        //     [
        //         'middleware' => 'permission:' . \ACL::PERMISSION_PERMISSION_MANAGE,
        //     ],
        //     function () {
        //         Route::apiResource('roles', 'RoleController');
        //         Route::apiResource('permissions', 'PermissionController');
        //     }
        // );

    });
});
Route::prefix('admin')->namespace('admin')->group(function () {    
    //File
    Route::post('upload', 'UploadController@upload');
    Route::post('removeFile', 'UploadController@removeFile');  
    //Province
    Route::get('get-full-province','ProvinceController@getFullProvince'); 
    //Setting
    Route::post('setting/updateSetting','SettingController@UpdateSetting');
    Route::post('setting/updateAllSetting','SettingController@UpdateAllSetting');
    Route::get('setting/fetchSetting','SettingController@fetchSetting');    
    //User
    Route::get('users','UserController@index');
    Route::post('users/create','UserController@create');
    Route::get('users/detail/{id}','UserController@show');
    Route::post('users/update/{id}','UserController@update');
    Route::post('users/create-signature/{id}','UserController@createSigature');
    Route::post('users/delete/{id}','UserController@destroy');
    //Modules
    Route::get('module','ModuleController@index');
    Route::get('module/gen_code','ModuleController@genCode');
    Route::get('module/detail/{id}','ModuleController@show');
    Route::post('module/update/{id}','ModuleController@update');
    Route::post('module/create','ModuleController@create');
    Route::post('module/delete/{id}','ModuleController@destroy');
    //Action
    Route::get('action','ActionController@index');
    Route::get('action/gen_code','ActionController@genCode');
    Route::get('action/detail/{id}','ActionController@show');
    Route::post('action/update/{id}','ActionController@update');
    Route::post('action/create','ActionController@create');
    Route::post('action/delete/{id}','ActionController@destroy');
    //Role
    Route::get('role','RoleController@index');
    Route::get('role/gen_code','RoleController@genCode');
    Route::get('role/detail/{id}','RoleController@show');
    Route::post('role/update/{id}','RoleController@update');
    Route::post('role/create','RoleController@create');
    Route::post('role/delete/{id}','RoleController@destroy');        

});

// Generation CRUD API
Route::post('get-content-controller','GenTableController@genContentController');
Route::post('get-content-migration','GenTableController@genContentMigrate');
Route::post('get-content-model','GenTableController@genContentModel');
Route::post('get-content-router','GenTableController@genContentRouter');
Route::post('get-content-vue-table','GenTableController@genContentVueTable');
Route::post('get-content-vue-form','GenTableController@genContentVueForm');
Route::post('get-content-vue-router','GenTableController@genContentVueRouter');
Route::post('generate-code-all','GenTableController@generateCode');

