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
    'namespace' => 'App\Http\Controllers\Api\V1'
], function($api) {

    // 接口节流处理
    $api->group([
        'middleware' =>  'api.throttle',
        'limit' => config('api.rate_limits.sign.limit'),
        'expires' => config('api.rate_limits.sign.expires'),
    ], function ($api) {
        // 发送短信验证码
        $api->post('verificationCodes','VerificationCodesController@store')
            ->name('api.verificationCodes.store');

        // 用户注册
        $api->post('users','UsersController@store')
            ->name('api.users.store');

        // 登录
        $api->post('authorizations','AuthorizationsController@store')
            ->name('api.authorizations.store');

        /**
         * 访问以下接口需要token认证
         */
        $api->group(['middleware' => 'api.auth'], function ($api) {
            $api->post('article', 'ArticleController@store');
        });
    });

});