@extends('wap.public.index')
@section('title')
    个人中心
@endsection
@section('css')
    <link rel="stylesheet" href="/css/wap/userInfo.css">
    <link rel="stylesheet" href="/css/wap/iconfont.css">
@endsection
@section('content')
    <div class="Ty_mall" style="padding-top:0">
        <div class="UserLogin">
            <div>
                <a href="/my/setting"><span class="mui-icon mui-icon-gear"></span></a>
                <a href="#"><span class="mui-icon mui-icon-chatbubble"></span></a>
            </div>
            <div class="userName">
                <a href="#">
                    <img id="user-avatar" src="" alt="">
                    <span></span>
                </a>
            </div>
            <a href="detail.html"> </a>
            <!-- <div class="point">
                <a href="#">0积分</a>
                <a href="#">积分记录</a>
            </div> -->
        </div>
        <!-- 我的订单 -->
        <div class="order">
            <a class="check" href="/my/orders?id=0">
                <span class="mui-icon mui-icon-compose"></span>
                <span>我的订单</span>
                <span class="mui-icon mui-icon-arrowright"></span>
                <span>查看全部订单</span>
            </a>
            <div class="delivery">
                <ul class="mui-clearfix">
                    <li>
                        <span class="iconfont">&#xe610;</span>
                        <a href="/my/orders?id=1">待付款</a>
                    </li>
                    <li>
                        <span class="iconfont">&#xe62e;</span>
                        <a href="/my/orders?id=2">待发货</a>
                    </li>
                    <li>
                        <span class="iconfont">&#xe601;</span>
                        <a href="/my/orders?id=3">待收货</a>
                    </li>
                    <li>
                        <span class="iconfont">&#xe60b;</span>
                        <a href="/my/orders?id=4">已完成</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="collection">
            <ul class="mui-table-view" style="border:none !important">
                <li class="mui-table-view-cell">
                    <a class="mui-navigate-right" href="/my/collection">我的收藏</a>
                </li>
                <li class="mui-table-view-cell">
                    <a class="mui-navigate-right" href="/my/address">管理收货地址</a>
                </li>
                <li class="mui-table-view-cell">
                    <a class="mui-navigate-right" href="">我的红包</a>
                </li>
            </ul>
        </div>
    </div>
    @section('footer')
        @include('wap.public.footer')
    @endsection
@endsection
@section('script')
    <script src="/js/wap/userInfo.js"></script>
@endsection