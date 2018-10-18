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
        $api->get('articles', 'ArticleController@index')
            ->name('api.article.index');

        // 获取个人文章列表
        $api->get('users/{user}/articles', 'ArticleController@userIndex')
            ->name('api.article.userIndex');

        //文章详情
        $api->get('articles/{article}', 'ArticleController@show')
            ->name('api.article.show');

        //获取文章回复列表   Param: include=user,articleChildComment
        $api->get('articles/{article}/comments', 'ArticleCommentController@index')
            ->name('api.articleComment.index');
            
        // 咨询列表
        $api->get('advisorys', 'AdvisoryController@index')
            ->name('api.advisorys.index');

        // 咨询详情
        $api->get('advisorys/{advisory}', 'AdvisoryController@show')
            ->name('api.advisory.show');

        // 根据用户查询咨询列表
        $api->get('users/{user}/advisorys', 'AdvisoryController@userIndex')
            ->name('api.users.advisorys.index');

        // 查询咨询回复列表
        $api->get('advisorys/{advisory}/replies', 'AdvisoryReplyController@index')
            ->name('api.advisorys.replies.index');

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
            $api->post('articles', 'ArticleController@store')
                ->name('api.article.stroe');

            //修改文章
            $api->patch('articles/{article}', 'ArticleController@update')
                ->name('api.article.update');

            //删除文章
            $api->delete('articles/{article}', 'ArticleController@destroy')
                ->name('api.article.destroy');

            //添加文章回复
            $api->post('articles/comment/{article}', 'ArticleCommentController@store')
                ->name('api.articleComment.store');

            //删除文章回复
            $api->delete('articles/comment/{articleComment}', 'ArticleCommentController@destroy')
                ->name('api.articlesComment.destroy');

            //添加文章评论子评论
            $api->post('article/childComment/{articleComment}/{articleChildComments?}', 'ArticleChildCommentController@store')
                ->name('api.articleChildComment.store');

            //删除文章评论子评论
            $api->delete('article/childComment/{articleChildComment}', 'ArticleChildCommentController@destroy')
                ->name('api.articleChildComment.destroy');

            //文章有新回复通知
            $api->get('user/articles/notifications', 'ArticleNotificationsController@index')
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

            // 回复咨询
            $api->post('advisory/{advisory}/replies', 'AdvisoryReplyController@store')
                ->name('api.advisory.replies.store');

            // 添加子评论
            $api->post('advisory/replies/{replies}/{childReplies?}', 'AdvisoryReplyReplyController@store')
                ->name('api.advisory.replies.replies.store');

            //文件上传
            $api->post('upload', 'Controller@upload')
                ->name('api.Controller.upload');

                $api->group(['namespace' => 'Store'], function ($api) {

                    // 添加商品到购物车
                    $api->post('store/cart', 'CartController@store')
                        ->name('api.store.cart.store');

                    // 删除购物车
                    $api->delete('store/cart/{cart}', 'CartController@destroy')
                        ->name('api.store.cart.destroy');

                    // 更新购物车
                    $api->patch('store/cart/{cart}', 'CartController@update')
                        ->name('api.store.cart.update');

                    // 查询当前登录用户的购物车信息
                    $api->get('store/cart', 'CartController@userIndex')
                        ->name('api.store.cart.userIndex');

                    // 新增收货地址
                    $api->post('store/address', 'AddressController@store')
                        ->name('api.store.address.store');

                    // 删除收货地址
                    $api->delete('store/address/{address}', 'AddressController@destroy')
                        ->name('api.store.address.destroy');

                    //添加订单
                    $api->post('store/order', 'OrderController@store');

                    //查询某个用户的订单
                    $api->get('store/user/orders', 'OrderController@userIndex');

                    //查询订单详情
                    $api->get('store/order/{order}', 'OrderController@show');
                });

            });

    });

    $api->group([
        'namespace' => 'Store',
    ], function ($api) {
        //添加分类
        $api->post('store/categorie', 'CategorieController@store');
        
        //修改分类
        $api->patch('store/categorie/{categorie}', 'CategorieController@update');

        //删除分类
        $api->delete('store/categorie/{categorie}', 'CategorieController@destroy');

        //查询分类
        $api->get('store/categorie', 'CategorieController@index');

        //修改订单
        $api->patch('store/order/{order}', 'OrderController@update');

        //查询所有订单
        $api->get('store/orders', 'OrderController@index');


        $api->get('store', 'CategorieController@store');

        $api->post('store/product', 'ProductController@store')
            ->name('api.store.product.store');

        $api->delete('store/products/{product}', 'ProductController@destroy')
            ->name('api.store.product.destroy');

        $api->patch('store/products/{product}', 'ProductController@update')
            ->name('api.store.product.update');

        $api->get('store/products', 'ProductController@index')
            ->name('api.store.product.index');

        $api->get('store/products/{product}', 'ProductController@productIndex')
            ->name('api.store.product.productIndex');

        $api->get('store/products/user/new', 'ProductController@userExclusive')
            ->name('api.store.product.userExclusive');
    });
});

