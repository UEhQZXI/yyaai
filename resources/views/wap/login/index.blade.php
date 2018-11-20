@extends('wap.public.index')
@section('title')
    登录
@endsection
@section('css')
    <link rel="stylesheet" href="/css/wap/login.css">
@endsection
@section('content')
    <div class="Login">
        <div class="login_first">
            <div class="top">
                <a href="javascript:history.go(-1);" class="go"><span class="mui-icon mui-icon-arrowleft"></span></a>
            </div>
            <p class="mall">登录天医商城</p>
            <div class="form_login">
                <div class="form_item">
                    <span class="iconfont">&#xe66f;</span>
                    <div class="input_box">
                        <input type="text" placeholder="输入手机号" class="user" maxlength="11">
                        <i class="mui-icon mui-icon-closeempty user_delete"></i>
                    </div>
                </div>
                <input type="button" value="获取验证码" class="code" disabled>
            </div>
            <div class="login_psd">
                <span class="pull-left" style="margin-left:1rem;margin-top: 0.2rem;">账号密码登录</span>
            </div>
            <a href="/forgetPwd" class="pull-right" style="margin-right:1rem;margin-top: 0.2rem;color: #000;">忘记密码</a>
        </div>
        <!-- 验证码 -->
        <div class="login_second" style="display: none">
            <div class="top">
                <span class="mui-icon mui-icon-arrowleft goo"></span>
            </div>
            <p class="mall">请输入验证码</p>
            <span class="sendCode">验证码已通过短信发送至  <span class="tel">未知的手机号码</span></span>
            <div class="form_login">
                <div class="form_item">
                    <span class="iconfont">&#xe616;</span>
                    <div class="input_box" style="position:relative">
                        <input id="sms_code" type="text" placeholder="输入验证码" class="codeV" maxlength="4">
                        <button class="second"></button>
                    </div>
                </div>
            </div>
            <input type="button" value="登录" class="sendcode" disabled>
        </div>
        <!-- 密码登录 -->
        <div class="login_three" style="display: none">
            <div class="tops">
                <a href="javascript:void(0);" onclick="jekD()" class="icons"><span class="mui-icon mui-icon-arrowleft edits"></span></a>
                <span style="font-size: 0.4rem">登录天医商城</span>
                <a href="/register" class="reg">注册</a>
            </div>
            <div class="form_login">
                <div class="form_item">
                    <span class="mui-icon mui-icon-person"></span>
                    <div class="input_box">
                        <input type="text" placeholder="手机/用户名" class="users">
                        <i class="mui-icon mui-icon-closeempty user_delete"></i>
                    </div>
                </div>
                <div class="form_item">
                    <span class="mui-icon mui-icon-locked"></span>
                    <div class="input_box">
                        <input type="password" placeholder="请输入密码" class="psds">
                        <i class="mui-icon mui-icon-closeempty psd_delete"></i>
                    </div>
                </div>
            </div>
            <div class="login_btn">
                <span class="login">登录</span>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="/js/wap/login.js"></script>
    <script>
        function jekD()
        {
            document.getElementsByClassName('login_three')[0].style.display = 'none';
            document.getElementsByClassName('login_second')[0].style.display = 'none';
            document.getElementsByClassName('login_first')[0].style.display = 'block';
        }
    </script>
@endsection