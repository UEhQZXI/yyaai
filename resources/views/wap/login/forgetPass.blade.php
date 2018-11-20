@extends('wap.public.index')
@section('title')
    忘记密码
@endsection
@section('css')
    <link rel="stylesheet" href="/css/wap/register.css">
@endsection
@section('content')
    <div class="lt_container">

        <div class="lt_header">
            <a class="icon_left" href="javascript:history.go(-1);"><span class="mui-icon mui-icon-arrowleft"></span></a>
            <span style="font-size: 0.4rem">修改密码</span>
            <a href="/login" class="login">登录</a>
        </div>

        <div class="lt_main">
            <form class="myform">
                <div class="mui-input-row">
                    <i class="iconfont">&#xe66f;</i>
                    <input type="text" name="mobile" class="mui-input-clear" placeholder="请输入手机号" id="tel" maxlength="11">
                </div>
                <div class="mui-input-row">
                    <i class="iconfont">&#xe623;</i>
                    <input type="password" name="password" class="mui-input-password" placeholder="请输入新密码">
                </div>
                <div class="mui-input-row">
                    <i class="iconfont">&#xe623;</i>
                    <input type="password" name="repassword" class="mui-input-password" placeholder="请输入密码">
                </div>
                <div class="mui-input-row vcode_wrap" style="position: relative">
                    <i class="iconfont">&#xe616;</i>
                    <input type="text" name="vCode" placeholder="请输入验证码" maxlength="4">
                    <button class="mui-btn mui-btn-primary btn_vcode" style="position:absolute;right: 0rem;top: 0.16rem;">获取验证码</button>
                </div>
            </form>
            <div class="register_btn">
                <span>确认</span>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="/js/wap/Forget.js"></script>
@endsection