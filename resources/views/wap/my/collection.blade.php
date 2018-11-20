@extends('wap.public.index')
@section('title')
    我的收藏
@endsection
@section('css')
    <link rel="stylesheet" href="/css/wap/collection.css">
@endsection
@section('content')
    <div class="collection">
        <div class="collectionTop">
            <a href="javascript:history.go(-1)"><span class="mui-icon mui-icon-arrowleft"></span></a>
            <p>我的收藏</p>
        </div>
        <!-- 无收藏显示 -->
        <div class="None">
            <img src="images/" alt="">
            <p>暂无收藏商品</p>
            <a href="index.html">随便逛逛</a>
        </div>
    </div>
@endsection