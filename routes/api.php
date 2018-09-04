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

    // 接口节流处理
    $api->group([
        'middleware' =>  ['api.throttle', 'serializer:array', 'bindings'],
        'limit' => config('api.rate_limits.sign.limit'),
        'expires' => config('api.rate_limits.sign.expires'),
    ], function ($api) {
        // 发送短信验证码
        $api->post('verificationCodes', 'VerificationCodesController@store')
            ->name('api.verificationCodes.store');

        // 用户注册
        $api->post('users', 'UsersController@store')
            ->name('api.users.store');

        // 登录
        $api->post('authorizations', 'AuthorizationsController@store')
            ->name('api.authorizations.store');

        // 获取分类列表
        $api->get('categories', 'CategoriesController@index')
            ->name('api.categories.index');

        //获取文章列表
        $api->get('article', 'ArticleController@index')
            ->name('api.article.index');

        // 获取个人文章列表
        $api->get('user/article/{user}', 'ArticleController@userIndex')
            ->name('api.article.userIndex');

        //文章详情
        $api->get('article/{article}', 'ArticleController@show')
            ->name('api.article.show');

        //获取文章回复列表
        $api->get('article/{article}/comments', 'ArticleCommentController@index')
            ->name('api.articleComment.index');

        // 咨询列表
        $api->get('advisorys', 'AdvisoryController@index')
            ->name('api.advisorys.index');

        // 咨询详情
        $api->get('advisory/{advisory}', 'AdvisoryController@show')
            ->name('api.advisory.show');

        // 根据用户查询咨询列表
        $api->get('users/{user}/advisorys', 'AdvisoryController@userIndex')
            ->name('api.users.advisorys.index');

        /**
         * 访问以下接口需要token认证
         */
        $api->group(['middleware' => 'api.auth'], function ($api) {

            // 登录用户信息获取
            $api->get('user', 'UsersController@me')
                ->name('api.user.show');

            // 编辑用户信息
            $api->patch('user', 'UsersController@update')
                ->name('api.user.update');

            //添加文章
            $api->post('article', 'ArticleController@store')
                ->name('api.article.stroe');

            //修改文章
            $api->patch('article/{article}', 'ArticleController@update')
                ->name('api.article.update');

            //删除文章
            $api->delete('article/{article}', 'ArticleController@destroy')
                ->name('api.article.destroy');

            //添加文章回复
            $api->post('article/comment/{article}', 'ArticleCommentController@store')
                ->name('api.articleComment.store');

            //删除文章回复
            $api->delete('article/comment/{articleComment}', 'ArticleCommentController@destroy')
                ->name('api.articleComment.destroy');

            //文章有新回复通知
            $api->get('user/atricle/notifications', 'ArticleNotificationsController@index')
                ->name('api.user.articleNotifications.index');

            // 发布咨询
            $api->post('advisory', 'AdvisoryController@store')
                ->name('api.advisory.store');

            // 编辑咨询
            $api->patch('advisory/{advisory}', 'AdvisoryController@update')
                ->name('api.advisory.update');

            // 删除咨询
            $api->delete('advisory/{advisory}', 'AdvisoryController@destroy')
                ->name('api.advisory.destroy');
        });
    });
});