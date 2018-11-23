@extends('wap.public.index')
@section('html-style')
@endsection
@section('title')
    购物车
@endsection
@section('css')
    <link rel="stylesheet" href="https://mall-ty-1252438738.cos.ap-shanghai.myqcloud.com/css/cart-header.css">
    <style>
        *{
            font-family: 'Helvetica Neue' !important;
        }
        .cart-null {
            padding-top: 3rem;
            text-align: center;
        }
        .cart-null-img {
            display: inline-block;
            background-image: url("https://mall-ty-1252438738.cos.ap-shanghai.myqcloud.com/images/7922f484921b81bc94997582ac7f7d9.png");
            -webkit-background-size: 100%;
            background-size: 100%;
            width: 5rem;
            height: 3.1rem;
        }
        .not-login {
            font-size: 0.4rem;
            color: #212121;
            padding-top: 0.5rem;
        }
        .login-btn {
            display: inline-block;
            width: 3.5rem;
            height: 1.1rem;
            background-color: #FF9800;
            line-height: 1.1rem;
            color: #fff;
            font-size: 0.4rem;
            border-radius: 0.1rem;
        }
        #topIconBack {
            background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoBAMAAAB+0KVeAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAYUExURUdwTF1famFhal1fal1fal5ga2FhcF1falIa7fwAAAAHdFJOUwDxN1zamie3ypN1AAAAP0lEQVQoz2NgGAjA5GiAKahYLoCpUByLoGJ5uQEWhcXDRiGDOxaFDOXlAQzEqcRqJlbbh4VSAeLSEvZURyUAAGHYICnlu7kGAAAAAElFTkSuQmCC");
            -webkit-background-size: 100%;
            background-size: 100%;
            height: 25px;
        }
    </style>
    <style>
        .cart-good-box{
            width: 100%;
            height: 4.5rem;
            background-color: #ffffff;
            margin-top: 0.4rem;
            overflow: hidden;
        }
        .cart-good-box .good-box-top{
            width: 100%;
            height: 1rem;
            margin-bottom: 0.3rem;
        }
        .cart-good-box .good-box-top .good-title-info{
            width: 8.5rem;
            line-height: 1rem;
            height: 100%;
            float: left;
        }
        .good-content{
            overflow: hidden;
            position: relative;
            transition: all 0.3s ease-out;
            z-index: 1;
            background-color: #ffffff;
            padding-bottom: 0.2rem;
            left: 0;
        }
        .good-title-info .maijia-img{
            display: inline-block;
            width: 0.4rem;
            height: 0.4rem;
            background-image: url(/images/wap/sj.png);
            background-size: 100%;
            margin-left: 0.3rem;
            margin-right: 0.4rem;
            vertical-align: middle;
            opacity: 0.8;
        }
        .good-title-info .good-title{
            display:inline-block;
            vertical-align: middle;
            padding-top: 0.08rem;
        }
        .good-info-btn{
            width: 1.5rem;
            line-height: 1rem;
            height: 100%;
            float: right;
            text-align: center;
        }
        .good-info-btn span{
            display:inline-block;
            vertical-align: middle;
            padding-top: 0.08rem;
        }
        .good-select-btn{
            width: 1rem;
            height: 3rem;
            float: left;
            line-height: 3rem;
            text-align: center;
        }
        .good-select-btn a{
            display: inline-block;
            width: 0.6rem;
            height: 0.6rem;
            background-size: 100%;
            vertical-align: middle;
        }
        .select-btn-off{
            background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoBAMAAAB+0KVeAAAAA3NCSVQICAjb4U/gAAAALVBMVEX///+hprehprehprehprehprehprehprehprehprehprehprehprehprehprd0XKVXAAAAD3RSTlMAESIzRGZ3iJmqu8zd7v8zDtSdAAAACXBIWXMAAAsSAAALEgHS3X78AAAAHHRFWHRTb2Z0d2FyZQBBZG9iZSBGaXJld29ya3MgQ1M26LyyjAAAAPVJREFUKJF1k88KQUEUxg/yrygLG4m8gLKVUlZ28gTyAsrCTskLKLL3BFKysJO1IixkYSMkrr5nMPeie+/0OYuZ6TedP3PONyKWecpjYNWKicO8PVh2zDjYSIHTWi0PmzaAeUkk3gYOP5YAhp9THhh8kyww+90XYHySJXG3w3cwtfYRqjb042FuAdyc1dVQV2sWTScMYm96G+KyhfL34uKGRWQkhL4bhtGVFHJu6MNOKlpIFfQqnbsOFZlcdVh5yuasw/RLsNVhFIKlDiP/IHOniWhJtHj6TNoQ2jraZDoOPjg6YioGLhsqMCpFLloub/oR9C/zBsU0n4PhpWahAAAAAElFTkSuQmCC);
        }
        .select-btn-on{
            background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAMAAAC7IEhfAAAAA3NCSVQICAjb4U/gAAAAh1BMVEX/////UAD/UAD/UAD/UAD/UAD/UAD/UAD/UAD/UAD/UAD/UAD/////+vj/9fD/8ev/8On/7OP/6d//5Nj/4NL/3s//2cj/1MH/zLX/w6f/wKP/upv/t5b/rYf/qID/oXb/mWb/jlr/jFj/dTb/cC//biz/bSr/aCP/XhT/Wg7/Vgn/UQL/UADQOR1YAAAALXRSTlMAESJEd4iZqrvM3e7///////////////////////////////////////////9INcYgAAAACXBIWXMAAAsSAAALEgHS3X78AAAAHHRFWHRTb2Z0d2FyZQBBZG9iZSBGaXJld29ya3MgQ1M26LyyjAAAARJJREFUOI2N1et2wiAMAOBApVZg7j7dzbn71Lz/8w0qcsKtJr/EfgcIDSkADdGpQaMLPahOQCtkb5CE6WWdzbGIeYXOTOncrLOMicp0YdJkq2LRcogLwXOJbK4bVo95TDvEkJGs5kvDSM7CcXF53iH6KXsO7N3RnN2hDyOgaz/9evyIvztQTfe5tBeH00DB0HLfl9au42gAPeFW+zjUMOEeduSPBiwchdvbbdtReGNtkD+lQ5LMmw3y97p0mh7Pq5PvR3efOXc89MBH6d3dX56dSl/hi5NXNedeYVoUXtacK4qszJ6qzpdZVriHzXPFjYXLvgr8y8W+rvwGwG8p7CbFb3v8Rgr81gzsZj9ulX4+0kf/qVXH8bP2GwMAAAAASUVORK5CYII=);
        }
        .good-img{
            width: 3rem;
            height: 3rem;
            float: left;
            padding: 0.2rem;
        }
        .good-img a{
            display: inline-block;
            width: 100%;
            height: 100%;
            padding: 0.1rem;
            background-size: 100%
        }
        .good-full{
            width: 6rem;
            height: 3rem;
            float: left;
            padding: 0.2rem;
        }
        .good-full-title{
            width: 100%;
            height: 1rem;
            margin-bottom: 0.6rem;
        }
        .money-box{
            width: 100%;
            height: 1rem;
        }
        .money-biaoshi{
            width: 0.2rem;
            height: 100%;
            float: left;
            position: relative;
        }
        .money-biaoshi div{
            position: absolute;
            bottom: 0.35rem;
            line-height: 1;
            color: #ff8c00;
        }
        .money-number{
            width: 2rem;
            height: 100%;
            float: left;
            line-height: 1rem;
        }
        .money-number div{
            font-size: 0.4rem;
            font-family: sans-serif;
            color: #ff8c00;
        }
        .add-btn{
            width: 0.7rem;
            height: 100%;
            float: right;
            position: relative;
            line-height: 1rem;
            text-align: center;
        }
        .add-btn a{
            display: inline-block;
            width: 0.4rem;
            height: 0.4rem;
            background-image: url(/images/wap/add.png);
            background-size: 100%;
            vertical-align: middle;
        }
        .good-number{
            width: 0.8rem;
            height: 100%;
            float: right;
        }
        .good-number input{
            width: 100%;
            height: 100%;
            border: 0;
            border-radius: 0;
            font-size: 0.4rem;
            font-family: sans-serif;
            padding: 0;
            text-align: center;
        }
        .sub-btn{
            width: 0.7rem;
            height: 100%;
            float: right;
            position: relative;
            line-height: 1rem;
            text-align: center;
        }
        .sub-btn a{
            display: inline-block;
            width: 0.4rem;
            height: 0.4rem;
            background-image: url(/images/wap/sub.png);
            background-size: 100%;
            vertical-align: middle;
        }
        .delete-good{
            width: 15%;
            height: 3.2rem;
            background-color: #ff8c00;
            position: relative;
            right: -8.5rem;
            top: -3.0rem;
            color: #ffffff;
            text-align: center;
            line-height: 3.2rem;
            font-size: 0.35rem;
        }
    </style>
    <style>
        .cart-footer{
            position: fixed;
            bottom: 1.3rem;
            z-index: 50;
            border-top: 1px solid rgba(204, 204, 204, 0.30196078431372547);
            border-bottom: 1px solid rgba(204, 204, 204, 0.30196078431372547);
        }
        .cart-footer-left1{
            width: 100%;
            height: 1.5rem;
            background-color: #ffffff;
            overflow: hidden;
        }
        .cart-footer-left1-left{
            width: 1rem;
            height: 100%;
            float: left;
            text-align: center;
            line-height: 1.5rem;
        }
        .cart-footer-left1-left a{
            display: inline-block;
            width: 0.6rem;
            height: 0.6rem;
            background-size: 100%;
            vertical-align: middle;
        }
        .cart-footer-left1-middle{
            width: 1rem;
            height: 100%;
            float: left;
            text-align: center;
            line-height: 1.5rem;
        }
        .cart-footer-left1-middle span{
            vertical-align: center;
            font-size: 0.39rem;
        }
        .cart-footer-left2{
            width: 5rem;
            height: 100%;
            float: left;
            overflow: hidden;
            text-align: right;
            line-height: 1.5rem;
            padding-right: 0.3rem;
        }
        .cart-sub-btn{
            width: 3rem;
            height: 100%;
            background-color: #ff8c00;
            color: #ffffff;
            float: left;
            text-align: center;
            line-height: 1.5rem;
            font-size: 0.39rem;
        }
        .del-goods .layui-m-layercont{
            padding: 20px 30px;
            color: #505050;
        }
        .del-goods .layui-m-layerbtn{
            background-color: #ffffff;
            border-top: 1px solid #d0d0d069;
        }
        .del-goods .layui-m-layerbtn span[no] {
            border: 0;
        }
        .del-goods .layui-m-layerbtn span[yes] {
            color: #505050;
        }
        .del-goods .layui-m-layerbtn span {
            font-size: 0.45rem;
            color: #505050;
        }
        .change-num-layer .layui-m-layercont{
            padding: 20px 20px;
        }
    </style>
@endsection
@section('body-style')
    background-color:#f5f5f5 !important;font-family: 'Helvetica Neue' !important;
@endsection
@section('content')
    <div class="touchweb-com_header header_flex" id="globalHeader">
        <a id="topIconBack" class="left" href="/"></a>
        <h1 id="goods-number" style="font-size: 0.4rem !important;padding-right: 25px;font-family: 'Helvetica Neue';">购物车(0)</h1>
        {{--<div class="rightBox">--}}
            {{--<a class="right" href="javascript:;" id="globalMore">--}}
                {{--<span class="right_text icon-more btn_more"></span>--}}
            {{--</a>--}}
        {{--</div>--}}
    </div>
   <div class="cart-null" style="display: none">
       <a class="cart-null-img"></a>
       <p class="not-login">登录查看购物车中商品</p>
       <a href="/login" class="login-btn">登录</a>
   </div>
    <div id="cart-list">

    </div>
    <input type="hidden" id="cart-count" value="0">
    <div class="cart-footer">
        <input type="hidden" id="count-m" value="0">
        <div class="cart-footer-left1">
            <div id="gs" style="float: left;" data-action="off" onclick="selectAll(this)">
                <div  class="cart-footer-left1-left" >
                    <a id="select-all-btn" href="javacript:void(0);" class="select-btn-off"></a>
                </div>
                <div class="cart-footer-left1-middle">
                    <span class="select-all-text">全选</span>
                </div>
            </div>
            <div class="cart-footer-left2">
                <span style="font-size: 0.37rem;">合计：</span>
                <p style="float: right;color: #ff8c00;">
                    &yen;
                    <span>
                        <span id="first-money-num" style="font-size: 0.5rem;">0.</span>
                        <span id="last-money-num" style="margin-left: -0.1rem;">00</span>
                    </span>
                </p>
            </div>
            <div class="cart-sub-btn" onclick="subCart()">
                结算(0)
            </div>
        </div>
    </div>
    {{--<div class="Ty_mall">--}}
        {{--<div class="Ty_header">--}}
            {{--<p>购物车</p>--}}
        {{--</div>--}}
        {{--<div class="Ty_main">--}}
            {{--<div class="mui-scroll-wrapper">--}}
                {{--<div class="mui-scroll">--}}
                    {{--<ul class="mui-table-view">--}}
                        {{--<!-- 模板 -->--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="revise" data-id="@{{v.id}}">--}}
            {{--<p>修改商品数量</p>--}}
            {{--<span class="number">数量:</span>--}}
            {{--<div class="mui-numbox" data-numbox-step='1' data-numbox-min='1' data-numbox-max='100'>--}}
                {{--<button class="mui-btn mui-numbox-btn-minus" type="button">-</button>--}}
                {{--<input class="mui-numbox-input" type="number" />--}}
                {{--<button class="mui-btn mui-numbox-btn-plus" type="button">+</button>--}}
            {{--</div>--}}
            {{--<div class="choose">--}}
                {{--<span class="confirm">确认</span>--}}
                {{--<span class="cancel">取消</span>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="totalPrice mui-clearfix" style="z-index:666">--}}
            {{--<div class="pay">--}}
                {{--<span style="font-size: 0.32rem;">合计： <span style="color:orange">&yen;  <span class="total" style="font-size: 0.35rem">0.00</span></span></span>--}}
                {{--<a href="#" id="pays">结算<span class="chooseNum"></span></a>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<!-- 阴影 -->--}}
        {{--<div class="mui-backdrop"></div>--}}
    {{--</div>--}}
@section('footer')
    @include('wap.public.footer')
@endsection
@endsection
@section('script')
    <script type="text/html" id="tpl_car">
        @verbatim
            {{ if list.length == 0}}
                <span style="display:block;text-align:center;padding-top:100px;">购物车竟然是空的</span>
            {{/if}}

            {{each list v i}}
                <div data-id="{{v.id}}" class="cart-good-box sequence{{v.id}}" {{if i == list.length -1}} style="margin-bottom: 3.3rem" {{/if}}>
                    <div class="good-box-top">
                        <div class="good-title-info">
                            <span class="maijia-img"></span>
                            <span class="good-title">天医口腔商城</span>
                        </div>
                        <div id="flag-{{v.id}}" class="good-info-btn" data-flag=false onclick="showDel(this, {{v.id}})">
                            <span id="good-info-btn-text-{{v.id}}">编辑</span>
                        </div>
                    </div>
                    <div id="smooth-good-{{v.id}}" class="good-content" ontouchmove="touchmove(this, {{v.id}})" ontouchstart="touchstart(this, {{v.id}})">
                        <div data-id="{{v.id}}" data-action="off" class="good-select-btn" onclick="selectGood(this)">
                            <a href="javacript:void(0);" class="select-btn-off"></a>
                        </div>
                        <div class="good-img">
                            <a href="javascript:void(0);" style="background-image: url({{v.product.image1}});"></a>
                        </div>
                        <div class="good-full">
                            <div class="good-full-title">
                                {{v.product.title}}
                            </div>
                            <div class="money-box">
                                <div class="money-biaoshi" >
                                    <div>&yen;</div>
                                </div>
                                <div class="money-number">
                                    <div id="money-number-{{v.id}}">
                                        {{v.product.current_price}}
                                    </div>
                                </div>
                                <div data-id="{{v.id}}" data-flag="add" class="add-btn" onclick="changeNum(this)">
                                    <a href="javascript:void(0);"></a>
                                </div>
                                <div class="good-number">
                                    <input id="gd-num-{{v.id}}" data-id="{{v.id}}" data-flag="input" type="number" value="{{v.product_number}}" max="9999" min="1" onblur="changeNum(this)">
                                </div>
                                <div data-id="{{v.id}}" data-flag="sub" class="sub-btn" onclick="changeNum(this)">
                                    <a href="javascript:void(0);"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="delete-good" data-id="{{v.id}}" onclick="delGood(this)">
                        删除
                    </div>
                </div>
            {{/each}}
        @endverbatim
    </script>
    <script src="/js/wap/cart.js?t={{ time() }}"></script>
    <script src="https://mall-ty-1252438738.cos.ap-shanghai.myqcloud.com/lib/layer_mobile/layer.js"></script>
    <script>
        $("#count-m").bind("input propertychange",function(event){
            console.log(11111111)
        });
    </script>
@endsection