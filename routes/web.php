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

Route::view('/', 'wap.index.index');

Route::prefix('my')->group(function () {
    Route::view('/', 'wap.my.index');
    Route::view('orders', 'wap.my.order');
    Route::view('address', 'wap.my.address.index');
    Route::view('address/edit', 'wap.my.address.update');
    Route::view('address/new', 'wap.my.address.store');
    Route::view('collection', 'wap.my.collection');
    Route::view('setting', 'wap.my.setting');
    Route::view('needLogin', 'wap.my.notLogin');
});


Route::prefix('order')->group(function () {
    Route::view('detail', 'wap.order.detail');
    Route::view('new', 'wap.order.store');
});


Route::prefix('good')->group(function () {
    Route::view('detail', 'wap.good.detail');
    Route::view('search', 'wap.good.search');
    Route::view('search/list', 'wap.good.searchList');
});

Route::view('cart', 'wap.cart.index');
Route::view('category', 'wap.category.index');
Route::view('login', 'wap.login.index');
Route::view('register', 'wap.register.index');
Route::view('pay', 'wap.pay.index');
Route::view('forgetPwd', 'wap.login.forgetPass');

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

Route::get('/bind', function () {
    return view('wap.login.bindPhone');
});





