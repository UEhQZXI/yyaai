<!doctype html>
<html lang="zh-CN" style="@yield('html-style')" @yield('plugin')>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('meta')
    <link rel="stylesheet" href="/lib/mui/css/mui.css" />
    <link rel="stylesheet" href="/css/wap/common.css" />
    <link rel="stylesheet" href="/lib/fa/css/font-awesome.css" />
    @yield('css')
    <title>@yield('title')</title>
</head>
<body class="@yield('body-class')" style="@yield('body-style')">
@yield('content')
@yield('footer')
<script src="/lib/mui/js/mui.js?t={{ time() }}"></script>
<script src="/lib/zepto/zepto.min.js?t={{ time() }}"></script>
<script src="/lib/artTemplate/template-web.js?t={{ time() }}"></script>
<script src="/lib/lib-flexible/flexible.js?t={{ time() }}"></script>
<script src="/js/wap/common.js?t={{ time() }}"></script>
@yield('script')
</body>
</html>