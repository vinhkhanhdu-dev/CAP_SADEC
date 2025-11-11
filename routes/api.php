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
        //Test
    Route::get('test', 'TestController@index');
    Route::get('test/gen_code', 'TestController@genCode');
    Route::get('test/detail/{id}', 'TestController@show');
    Route::post('test/update/{id}', 'TestController@update');
    Route::post('test/create', 'TestController@store');
    Route::post('test/delete/{id}', 'TestController@destroy');    
        //QuanLyChiThu
    Route::get('nhatkychithu', 'NhatKyChiThuController@index');
    Route::get('nhatkychithu/gen_code', 'NhatKyChiThuController@genCode');
    Route::get('nhatkychithu/detail/{id}', 'NhatKyChiThuController@show');
    Route::post('nhatkychithu/update/{id}', 'NhatKyChiThuController@update');
    Route::post('nhatkychithu/create', 'NhatKyChiThuController@store');
    Route::post('nhatkychithu/delete/{id}', 'NhatKyChiThuController@destroy');    
        //QuanLyKhuVuc
    Route::get('quanlythongtinkhuvuc', 'KhuVucController@index');
    Route::get('quanlythongtinkhuvuc/gen_code', 'KhuVucController@genCode');
    Route::get('quanlythongtinkhuvuc/detail/{id}', 'KhuVucController@show');
    Route::post('quanlythongtinkhuvuc/update/{id}', 'KhuVucController@update');
    Route::post('quanlythongtinkhuvuc/create', 'KhuVucController@store');
    Route::post('quanlythongtinkhuvuc/delete/{id}', 'KhuVucController@destroy');    
        //QuanLyCongViec
    Route::get('task', 'taskController@index');
    Route::get('task/gen_code', 'taskController@genCode');
    Route::get('task/detail/{id}', 'taskController@show');
    Route::post('task/update/{id}', 'taskController@update');
    Route::post('task/create', 'taskController@store');
    Route::post('task/delete/{id}', 'taskController@destroy');           
    
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

    //thongTinDonVi
    Route::get('thongtindonvi','thongTinDonViController@index');
    Route::get('thongtindonvi/detail/{id}','thongTinDonViController@show');
    Route::post('thongtindonvi/update/{id}','thongTinDonViController@update');
    Route::post('thongtindonvi/create','thongTinDonViController@store');
    Route::post('thongtindonvi/delete/{id}','thongTinDonViController@destroy');
    Route::get('thongtindonvi/gen_code','thongTinDonViController@genCode');
     //danhSachKyThi
     Route::get('danhsachkythi','danhSachKyThiController@index');
     Route::get('danhsachkythi/detail/{id}','danhSachKyThiController@show');
     Route::post('danhsachkythi/update/{id}','danhSachKyThiController@update');
     Route::post('danhsachkythi/create','danhSachKyThiController@store');
     Route::post('danhsachkythi/delete/{id}','danhSachKyThiController@destroy');
     Route::get('danhsachkythi/gen_code','danhSachKyThiController@genCode');
     //danhSachKyThi
     Route::get('danhsachkhoithi','danhSachKhoiThiController@index');
     Route::get('danhsachkhoithi/detail/{id}','danhSachKhoiThiController@show');
     Route::post('danhsachkhoithi/update/{id}','danhSachKhoiThiController@update');
     Route::post('danhsachkhoithi/create','danhSachKhoiThiController@store');
     Route::post('danhsachkhoithi/delete/{id}','danhSachKhoiThiController@destroy');
     Route::get('danhsachkhoithi/gen_code','danhSachKhoiThiController@genCode');
     //danhSachMonThi
     Route::get('danhsachmonthi','DanhSachMonThiController@index');
     Route::get('danhsachmonthi/detail/{id}','DanhSachMonThiController@show');
     Route::post('danhsachmonthi/update/{id}','DanhSachMonThiController@update');
     Route::post('danhsachmonthi/create','DanhSachMonThiController@store');
     Route::post('danhsachmonthi/delete/{id}','DanhSachMonThiController@destroy');
     Route::get('danhsachmonthi/gen_code','DanhSachMonThiController@genCode');
     //danhSachPhongThi
     Route::get('danhsachphongthi','DanhSachPhongThiController@index');
     Route::get('danhsachphongthi/detail/{id}','DanhSachPhongThiController@show');
     Route::post('danhsachphongthi/update/{id}','DanhSachPhongThiController@update');
     Route::post('danhsachphongthi/create','DanhSachPhongThiController@store');
     Route::post('danhsachphongthi/delete/{id}','DanhSachPhongThiController@destroy');
     Route::get('danhsachphongthi/gen_code','DanhSachPhongThiController@genCode');
     //getListKetQuaSapPhongThi
     Route::get('ketquasapphongthi','DanhSachThiSinhController@getListKetQuaSapPhongThi');
     Route::get('danhsachthisinhthuocphongthi','DanhSachThiSinhController@getDanhSachThiSinhOfPhong');

     //danhSachThiSinh
     Route::get('danhsachthisinh','DanhSachThiSinhController@index');
     Route::post('danhsachthisinh/exportMau1','DanhSachThiSinhController@exportMau1');
     Route::post('danhsachthisinh/exportMau2','DanhSachThiSinhController@exportMau2');
     Route::post('danhsachthisinh/exportMau3','DanhSachThiSinhController@exportMau3');
     Route::post('danhsachthisinh/deleteKQ','DanhSachThiSinhController@deleteKQ');
     Route::post('danhsachthisinh/import','DanhSachThiSinhController@importExcel');
     Route::get('danhsachthisinh/danhsach','DanhSachThiSinhController@listThiSinhInNamHocKhoiThi');
     Route::get('danhsachthisinh/detail/{id}','DanhSachThiSinhController@show');
     Route::post('danhsachthisinh/update/{id}','DanhSachThiSinhController@update');
     Route::post('danhsachthisinh/create','DanhSachThiSinhController@store');
     Route::post('danhsachthisinh/delete','DanhSachThiSinhController@destroy');
     Route::get('danhsachthisinh/gen_code','DanhSachThiSinhController@genCode');
     Route::post('sapphongthi','DanhSachThiSinhController@sapPhongThi');
     //danhSachNamHoc
     Route::get('danhsachnamhoc','DanhSachNamHocController@index');
     Route::get('danhsachnamhoc/detail/{id}','DanhSachNamHocController@show');
     Route::post('danhsachnamhoc/update/{id}','DanhSachNamHocController@update');
     Route::post('danhsachnamhoc/create','DanhSachNamHocController@store');
     Route::post('danhsachnamhoc/delete/{id}','DanhSachNamHocController@destroy');
     Route::get('danhsachnamhoc/gen_code','DanhSachNamHocController@genCode');

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

