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
	return ['message' => '此地不宜久留~ (｡ŏ_ŏ)走开！', 'code' => 2333];
});

Route::get('/test', 'Api\V1\Store\WechatPayController@test');

Route::get('admin/index', 'Admin\IndexController@index');
//管理员
Route::get('admin/user/index', 'Admin\AdminController@indexview');
Route::post('admin/admin', 'Admin\AdminController@store');
Route::get('admin/user/updateview/{admin_id}', 'Admin\AdminController@updateview');
Route::patch('admin/user/update/{admin_id}', 'Admin\AdminController@update');
Route::delete('admin/user/destroy', 'Admin\AdminController@destroy');

//权限管理
Route::get('admin/role/view', 'Admin\RoleController@indexview');
