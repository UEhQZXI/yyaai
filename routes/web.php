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

Route::get('/test', 'Admin\LoginController@test');

Route::group(['middleware' => 'adminlogin'], function () {
	Route::get('admin/index', 'Admin\IndexController@index');
	//管理员
	Route::get('admin/user/index', 'Admin\AdminController@indexview');
	Route::post('admin/admin', 'Admin\AdminController@store');
	Route::get('admin/user/updateview/{admin_id}', 'Admin\AdminController@updateview');
	Route::patch('admin/user/update/{admin_id}', 'Admin\AdminController@update');
	Route::delete('admin/user/destroy', 'Admin\AdminController@destroy');

	//权限管理
	Route::get('admin/role/view', 'Admin\RoleController@indexview');
	Route::post('admin/roles', 'Admin\RoleController@store');
	Route::get('admin/role/updateview/{role_id}', 'Admin\RoleController@updateview');
	Route::patch('admin/role/update', 'Admin\RoleController@update');

	//分类管理
	Route::get('admin/categorie/view', 'Admin\CategorieController@view');

    //用户管理
    Route::get('admin/user/user', 'Admin\UserController@indexview');
    Route::get('admin/user/userinfo', 'Admin\UserController@info');

    //退出登陆
    Route::post('admin/logout', 'Admin\LoginController@logout');

    // 商品管理
	Route::get('admin/products/add', 'Admin\ProductController@store');
	Route::get('admin/products/list', 'Admin\ProductController@index');
	Route::get('admin/products/{product}/edit', 'Admin\ProductController@update');

	// 订单管理
	Route::get('admin/orders/list', 'Admin\OrderController@index');
	Route::get('admin/orders/{order}/edit', 'Admin\OrderController@update');
});

//登陆
Route::get('admin/login/view', 'Admin\LoginController@view');
Route::post('admin/login', 'Admin\LoginController@login');



