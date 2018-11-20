@extends('wap.public.index')
@section('html-style')
    touch-action: none;
@endsection
@section('title')
    分类
@endsection
@section('css')
    <link rel="stylesheet" href="/css/wap/category.css">
@endsection
@section('content')
    <div class="Ty_mall">
        <div class="Ty_header">
            <p>分类</p>
            <a href="/good/search"><span class="mui-icon mui-icon-search"></span></a>
        </div>
        <div class="Ty_main">
            <div class="Ty_category_l">
                <div class="mui-scroll-wrapper">
                    <!--这里放置真实显示的DOM内容-->
                    <ul id="classify" class="mui-scroll">
                    </ul>
                </div>
            </div>
            <div class="Ty_category_r">
                <div class="mui-scroll-wrapper">
                    <!--这里放置真实显示的DOM内容-->
                    <ul class="mui-scroll">
                    </ul>
                </div>
            </div>
        </div>
    </div>
@section('footer')
    @include('wap.public.footer')
@endsection
@endsection
@section('script')
    <script type="text/html" id="tpl_l">
        @verbatim
            {{ each list v i }}
            <li data-id={{ v.id }} class="{{ i==0?'now':'' }}">
                <a href="javascript:void(0);">{{ v.name }}</a>
            </li>
            {{ /each }}
        @endverbatim
    </script>
    <script type="text/html" id="tpl_r">
        @verbatim
            {{ if row.length == 0 }}
                <p style="text-align:center;margin-top:150px;">该分类下没有商品信息</p>
                {{ /if }}
                {{ each row v i }}
                <li data-id={{ v.id }}>
                    <a href="/good/search/list?id={{ v.id }}">
                        <img src="{{ v.image }}" alt="">
                        <span>{{ v.name }}</span>
                    </a>
                </li>
            {{ /each }}
        @endverbatim
    </script>
    <script src="/js/wap/category.js"></script>
@endsection