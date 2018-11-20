<!doctype html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>绑定手机号码</title>
    <link rel="stylesheet" href="/lib/mui/css/mui.css" />
    <link rel="stylesheet" href="/css/wap/common.css" />
    <link rel="stylesheet" href="/css/wap/login.css">
    <link rel="stylesheet" href="/lib/fa/css/font-awesome.css" />
    <link rel="stylesheet" href="/css/wap/iconfont.css">
    <style>
        .select-account{
            float: right;padding-right: 0.4rem;opacity: 0.8;
        }
    </style>
</head>
<body style="margin-top: 0.5rem;overflow: hidden">
<div class="Login" style="height: 100%;">
    <div class="login_first" style="height: 100%;overflow: initial">
        <div class="login_top" style="overflow: hidden;padding-top: 0.5rem;">
            <span class="mall">绑定手机号码</span>
            <span class="select-account">
                切换账号
            </span>
        </div>
        <div class="form_login">
            <div class="form_item">
                <span class="iconfont">&#xe66f;</span>
                <div class="input_box">
                    <input type="number" placeholder="请输入手机号码" class="user" maxlength="11">
                    <i class="mui-icon mui-icon-closeempty user_delete"></i>
                </div>
            </div>
            <input type="button" value="获取验证码" class="code" style="border: 0px solid #ffc865;" disabled>
        </div>
        {{--<div class="login_psd" style="text-align: center;font-size: 0.4rem;position: relative;bottom: 0;">--}}
            {{--<span>切换账号</span>--}}
        {{--</div>--}}
    </div>
</div>
<script src="/lib/mui/js/mui.js?t={{ time() }}"></script>
<script src="/lib/zepto/zepto.min.js?t={{ time() }}"></script>
<script src="/lib/artTemplate/template-web.js?t={{ time() }}"></script>
<script src="/lib/lib-flexible/flexible.js?t={{ time() }}"></script>
<script src="/js/wap/common.js?t={{ time() }}"></script>
</body>
</html>