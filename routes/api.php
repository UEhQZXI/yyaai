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

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
		'namespace' => 'App\Http\Controllers\Api\V1',
	], function($api) {
    // 查询当前接口版本
    $api->get('version', function() {
        return response('this is version v1');
    });

    //添加案例分享
    $api->post('article', 'ArticleController@store');
    $api->post('test', 'ArticleController@tests');
});

$api->version('v2', function($api) {
    // 查询当前接口版本
    $api->get('version', function() {
        return response('this is version v2');
    });
});
