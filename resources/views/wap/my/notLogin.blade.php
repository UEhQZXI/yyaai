@extends('wap.public.index')
@section('title')
    个人中心
@endsection
@section('css')
    <link rel="stylesheet" href="/css/wap/user.css">
    <link rel="stylesheet" href="/css/wap/iconfont.css">
@endsection
@section('content')
    <div class="Ty_mall" style="padding-top:0">
        <div class="UserLogin">
            <div>
                <a href="/login"><span class="mui-icon mui-icon-gear"></span></a>
                <a href="/login"><span class="mui-icon mui-icon-chatbubble"></span></a>
            </div>
            <div>
                <a href="/login">
                    <img src="images/user.jpg" alt="">
                </a>
            </div>
            <a href="/login" class="reg">登陆/注册</a>
        </div>
        <!-- 我的订单 -->
        <div class="order">
            <a class="check" href="/login" data-id="1">
                <span class="mui-icon mui-icon-compose"></span>
                <span>我的订单</span>
                <span class="mui-icon mui-icon-arrowright"></span>
                <span>查看全部订单</span>
            </a>
            <div class="delivery">
                <ul class="mui-clearfix">
                    <li>
                        <span class="iconfont">&#xe610;</span>
                        <a href="/login">待付款</a>
                    </li>
                    <li>
                        <span class="iconfont">&#xe62e;</span>
                        <a href="/login">待发货</a>
                    </li>
                    <li>
                        <span class="iconfont">&#xe601;</span>
                        <a href="/login">待收货</a>
                    </li>
                    <li>
                        <span class="iconfont">&#xe60b;</span>
                        <a href="/login">已完成</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="collection">
            <ul class="mui-table-view" style="border:none !important">
                <li class="mui-table-view-cell">
                    <a class="mui-navigate-right" href="/login"> <span class="fa fa-circle-o"></span>我的收藏</a>
                </li>
                <li class="mui-table-view-cell">
                    <a class="mui-navigate-right" href="/login">管理收货地址</a>
                </li>
                <li class="mui-table-view-cell">
                    <a class="mui-navigate-right" href="/login">我的红包</a>
                </li>
            </ul>
        </div>
    </div>
@endsection
@section('script')
    <script src="/js/wap/user.js"></script>
@endsection