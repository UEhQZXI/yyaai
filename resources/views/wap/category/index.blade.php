@extends('wap.public.index')
@section('html-style')
    touch-action: none;
@endsection
@section('title')
    分类
@endsection
@section('css')
    <link rel="stylesheet" href="/css/wap/catejd.css">
    <link rel="stylesheet" href="/css/wap/catesh.css">
    {{--<link rel="stylesheet" href="/css/wap/category.css">--}}
@endsection
@section('body-style')
    overflow:hidden;
@endsection
@section('content')
    <div search_land_searchtransformation_show="true" id="containerTop" class="search-land"
         style="display: block;">
        <div class="mjd-header">
            <div class="m_common_container">
                <div class="m_cc_header_inner">
                    <header class="jd-header">
                        <div class="jd-header-new-bar">
                            <div id="msCancelBtn" class="jd-header-icon-back J_ping" style="display: block;">
							<span>
							</span>
                            </div>
                            <div class="jd-header-new-title">
                            </div>
                            <div id="msShortcutLogin" class="jd-header-icon-new-shortcut-text J_ping"
                                 style="display:none;">
							<span>
								登录
							</span>
                            </div>
                            <div id="msShortcutMenu" class="jd-header-icon-new-shortcut J_ping" style="display: block;">
							<span>
							</span>
                            </div>
                        </div>
                    </header>
                </div>
                <div class="m-common-header-search">
                    <form  class="jd-header-search-form">
                        <div class="jd-header-search-box" id="msSearchBox" style="margin-right: 32px;">
                            <i id="search-input-left-jd" class="jd-header-icon-jd">
                            </i>
                            <i id="search-input-left-icon" class="jd-header-icon-fdj">
                            </i>
                            <div class="jd-header-search-input">
                            </div>
                            <a href="javascript:void(0);" class="jd-header-icon-close" id="msSearchClearBtn"
                               style="display:none;">
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="categoryBody" class="category-viewport category-categoryNewUi">
        <div id="rootList" class="jd-category-tab">
            <div style="overflow:hidden;height:823px" id="category3">
                <ul id="category2">

                </ul>
            </div>
        </div>
        <div class="jd-category-content">
            <div id="branchScroll" style="overflow:hidden;height:823px;" class="jd-category-content-wrapper">
                <div id="branchList" style="transform:translateY(0px)">
                    <div class="jd-category-div cur">
                        <ul class="jd-category-style-1">

                            <div style="clear:both">
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--<div class="Ty_mall">--}}
        {{--<div class="Ty_header">--}}
            {{--<p>分类</p>--}}
            {{--<a href="/good/search"><span class="mui-icon mui-icon-search"></span></a>--}}
        {{--</div>--}}
        {{--<div class="Ty_main">--}}
            {{--<div class="Ty_category_l">--}}
                {{--<div class="mui-scroll-wrapper">--}}
                    {{--<!--这里放置真实显示的DOM内容-->--}}
                    {{--<ul id="classify" class="mui-scroll">--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="Ty_category_r">--}}
                {{--<div class="mui-scroll-wrapper">--}}
                    {{--<!--这里放置真实显示的DOM内容-->--}}
                    {{--<ul class="mui-scroll">--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@section('footer')
    @include('wap.public.footer')
@endsection
@endsection
@section('script')
    <script>
        window.onload = function () {
            $("#category3").height($(document.body).height() - $('.Ty_footer').height());
            $("#branchScroll").height($(document.body).height() - $('.Ty_footer').height());
        };
        window.onresize = function () {
            $("#category3").height($(document.body).height());
            $("#branchScroll").height($(document.body).height());
        };
    </script>
    <script type="text/html" id="tpl_l">
        @verbatim
        {{ each list v i }}
            <li class="{{ i==0?'cur':'' }}" data-id={{ v.id }}>
                <a class="J_ping"  href="javascript:void(0);">
                    {{ v.name }}
                </a>
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
                    <a class="J_ping" href="/good/search/list?id={{ v.id }}">
                        <img src="{{ v.image }}">
                        <span>
                            {{ v.name }}
                        </span>
                    </a>
                </li>
            {{ /each }}
        @endverbatim
    </script>
    <script src="/js/wap/category.js"></script>
@endsection