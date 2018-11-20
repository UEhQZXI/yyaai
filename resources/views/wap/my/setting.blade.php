@extends('wap.public.index')
@section('title')
    设置
@endsection
@section('css')
    <link rel="stylesheet" href="/css/wap/about.css">
@endsection
@section('content')
    <div class="about">
        <div class="aboutTop">
            <a href="javascript:history.go(-1)"><span class="mui-icon mui-icon-arrowleft"></span></a>
            <p>设置</p>
        </div>
        <!-- <a href="aboutUs.html" class="ownUs">关于我们
            <span class="mui-icon mui-icon-arrowright"></span>
        </a> -->
        <p class="loginOut">退出登录</p>
    </div>
@endsection
@section('script')
    <script src="/js/wap/about.js"></script>
@endsection