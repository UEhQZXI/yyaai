@extends('wap.public.index')
@section('html-style')
    background-color:#fff;
@endsection
@section('title')
    首页
@endsection
@section('meta')
    <meta name="viewport"
          content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no,minimal-ui"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="full-screen" content="true"/>
    <meta name="x5-fullscreen" content="true"/>
    <meta name="360-fullscreen" content="true"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no, viewport-fit=cover"/>
    <meta http-equiv="x-dns-prefetch-control" content="on"/>
@endsection
@section('css')
    <link rel="stylesheet" href="/css/wap/index.css"/>
    <link rel="stylesheet" href="http://mall-ty-1252438738.cos.ap-shanghai.myqcloud.com/css/index.css"/>
    <link rel="stylesheet" href="http://mall-ty-1252438738.cos.ap-shanghai.myqcloud.com/css/search_bar.css"/>
    <link rel="stylesheet" href="http://mall-ty-1252438738.cos.ap-shanghai.myqcloud.com/css/yhd.css">
    <style>
        ::-webkit-scrollbar {
            width: 0em;
        }

        ::-webkit-scrollbar:horizontal {
            height: 0em;
        }

        .rec-price-tag {
            border: 1px solid #e4393c;
            color: #e4393c;
            font-size: 10px;
            padding: 0 3px;
            margin-right: 5px;
        }

        .similar-product {
            padding-bottom: 0;
        }

        .sam-price,
        .plus-price,
        .rec-seckill-price {
            padding-left: 4px;
            vertical-align: middle;
        }

        .plus-price {
            display: inline-block;
            height: 14px;
            outline: 14px;
            position: relative;
            font-size: 13px;
            padding-left: 4px;
            vertical-align: middle;
        }

        .rec-seckill-price {
            color: #ccc;
        }

        .similar-product-info {
            position: relative;
            height: 26px;
        }

        .rec-belt-text {
            box-sizing: border-box;
            display: inline-block;
            width: 100%;
            padding: 0 10px;
            vertical-align: bottom;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            color: #fff;
        }

        .similar-product .plus-price:after {
            content: "";
            height: 9px;
            width: 28px;
            position: absolute;
            top: 1px;
            right: -31px;
        }

        .similar-product .recomend-corner-icon {
            position: absolute;
            width: auto;
            max-width: 30px;
            bottom: 0;
            right: 0;
            z-index: 3;
        }
    </style>
    <style>
        .search_wrapper {
            display: block;
            position: fixed;
            left: 0;
            top: 0;
            right: 0;
            z-index: 15;
        }

        .skin_transparent .mjd-header .m_common_container .m_cc_header_inner .jd-header .jd-header-new-bar {
            border-bottom: none;
            background: transparent;
        }

        .box_wrapper {
            background: #fff;
        }

        strong {
            font-weight: lighter;
        }

        .hidden {
            display: none;
        }

        .floor .floor-container:last-child {
            border-bottom: none;
        }

        #m_common_tip {
            position: fixed;
            width: 100%;
            max-width: 640px;
            min-width: 300px;
            margin: 0 auto;
            font-size: 0;
            top: 0;
            overflow: hidden;
            z-index: 20;
        }

        .download-pannel .download-close img,
        .download-pannel .download-logo img {
            position: absolute;
            top: 50%;
            left: 0%;
            -webkit-transform: translate(0%, -50%);
            -moz-transform: translate(0%, -50%);
            transform: translate(0%, -50%);
        }

        .floor-tit-img .tit-img img {
            min-width: 1px;
        }

        .slide-li {
            width: 100%;
        }

        .seckill-slider::-webkit-scrollbar {
            display: none;
        }

        .m-back-to-top {
            display: none;
            position: fixed;
            bottom: -200px;
            right: 9px;
            width: 38px;
            height: 38px;
            background-image: url("https://mall-ty-1252438738.cos.ap-shanghai.myqcloud.com/images/gotoTop.png");
            background-size: 38px 38px;
            background-repeat: no-repeat;
            background-position: 50%;
            z-index: 20;
            opacity: 1;
            transition: all 1s linear;
        }

        /*关闭按钮*/
        .locate_close {
            width: 15px;
            height: 15px;
            position: absolute;
            right: 16px;
            top: 16px;
        }

        .locate_close:before,
        .locate_close:after {
            content: '';
            position: absolute;
            top: 0%;
            width: 15px;
            height: 1px;
            background-color: #888;
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .locate_close:after {
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
        }

        .graphic-tit .line-bg:after {
            display: inline-block;
            width: 24px;
            height: 1px;
            content: '';
            position: relative;
            background: #000;
            top: -5px;
            left: 3px;
        }

        .graphic-tit .line-bg:before {
            display: inline-block;
            width: 24px;
            height: 1px;
            content: '';
            position: relative;
            background: #000;
            top: -5px;
            left: -3px;
        }

        * {
            cursor: pointer !important;
        }

        .box_wrapper .box_list .box {
            display: block;
            float: left;
        }

        .similar-iconC {
            top: 2px;
        }

        .mui-indicator {
            box-shadow: 0 0 1px 1px rgba(130, 130, 130, 0) !important;
            -webkit-box-shadow: 0 0 1px 1px rgba(130, 130, 130, 0) !important;
        }
    </style>
@endsection
@section('body-class')
    _body
@endsection
@section('body-style')
    background-color:#fff !important;
@endsection
@section('content')
    <div class="Ty_mall scroll-box" style="padding:0 !important">
        <div class="search_wrapper skin_transparent j_smart_box_wrapper" style="top: 0px;">
            <div id="searchWrapper" class="search-land main-page2" style="display: block;">
                <div class="mjd-header">
                    <div class="m_common_container">
                        <div class="m_cc_header_inner">
                            <header class="jd-header">
                                <div class="jd-header-new-bar">
                                    <div id="msCancelBtn" class="jd-header-icon-back J_ping" style="display: block;">
                                        <span></span>
                                    </div>
                                    <div class="jd-header-new-title"></div>
                                    <div id="msShortcutMenu" class="jd-header-icon-new-shortcut J_ping"
                                         style="display:block;">
                                        <span></span>
                                    </div>
                                </div>
                            </header>
                        </div>
                        <div class="m-common-header-search">
                            <form action="/search/search.action" class="jd-header-search-form">
                                <div class="jd-header-search-box" id="msSearchBox" style="margin-right: 32px;">
                                    <i id="search-input-left-jd" class="jd-header-icon-jd"></i>
                                    <i id="search-input-left-icon" class="jd-header-icon-fdj"></i>
                                    <div class="jd-header-search-input">
                                        <input value="" style="padding:0 !important" maxlength="20" name="keyword"
                                               id="msKeyWord" type="text" cleardefault="no" autocomplete="off"
                                               placeholder="牙齿护理、美白" class="hilight2"/>
                                        <input name="catelogyList" type="text" value="" style="display:none;"/>
                                        <div class="head-input-icon J_ping" id="msSearchTab"
                                             report-eventid="MSearch_SearchTab" style="display:none;"></div>
                                    </div>
                                    <a href="javascript:void(0);" class="jd-header-icon-close" id="msSearchClearBtn"
                                       style="display:none;"></a>
                                </div>
                                <a href="javascript:void(0)" style="display: none;" id="msSearchBtn"
                                   class="jd-header-icon-search1"><span>搜索</span></a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--轮播图-->
        <div class="mui-slider" style="height:5rem;margin-bottom: .2rem">
            <div class="mui-slider-group mui-slider-loop">
                <div class="mui-slider-item">
                    <a href="#"><img
                                src="https://mall-ty-1252438738.cos.ap-shanghai.myqcloud.com/images/banner/banner1.png"/></a>
                </div>
                <div class="mui-slider-item mui-slider-item-duplicate">
                    <a href="#"><img
                                src="https://mall-ty-1252438738.cos.ap-shanghai.myqcloud.com/images/banner/banner1.png"/></a>
                </div>
                <div class="mui-slider-item">
                    <a href="#"><img
                                src="https://mall-ty-1252438738.cos.ap-shanghai.myqcloud.com/images/banner/banner2.png"/></a>
                </div>
                <div class="mui-slider-item">
                    <a href="#"><img
                                src="https://mall-ty-1252438738.cos.ap-shanghai.myqcloud.com/images/banner/banner3.png"/></a>
                </div>
                <div class="mui-slider-item mui-slider-item-duplicate">
                    <a href="#"><img
                                src="https://mall-ty-1252438738.cos.ap-shanghai.myqcloud.com/images/banner/banner1.png"/></a>
                </div>
            </div>
            <div class="mui-slider-indicator" style="bottom: 15px !important">
                <div class="mui-indicator mui-active"></div>
                <div class="mui-indicator"></div>
                <div class="mui-indicator"></div>
            </div>
        </div>
        <!-- 五个模块图标 -->
        <div style="border:0 solid #000;position:relative;box-sizing:border-box;display:flex;-webkit-box-orient:vertical;flex-direction:column;align-content:flex-start;flex-shrink:0">
            <div style="border:0 solid #000;position:relative;box-sizing:border-box;display:flex;-webkit-box-orient:horizontal;flex-direction:row;place-content:flex-start center;flex-shrink:0;width:100%;-webkit-box-align:center;align-items:center;-webkit-box-pack:center">
                <a href="" style="text-decoration:none;text-align:center;width: 20%;" data-appeared="true">
                    <img src="http://mall-ty-1252438738.cos.ap-shanghai.myqcloud.com/images/meibai.png"
                         style="display:initial;width:48px;height:48px;margin:5px 11px 2px"/>
                    <span style="white-space:pre-wrap;border:0 solid #000;position:relative;box-sizing:border-box;display:block;-webkit-box-orient:vertical;flex-direction:column;align-content:flex-start;flex-shrink:0;font-size:12px;text-align:center;line-height:15px;align-self:center;color:#000">牙齿美白</span>
                </a>
                <a href="" style="text-decoration:none;text-align:center;width: 20%" data-appeared="true"> <img
                            src="http://mall-ty-1252438738.cos.ap-shanghai.myqcloud.com/images/yashua.png"
                            style="display:initial;width:48px;height:48px;margin:5px 11px 2px"/> <span
                            style="white-space:pre-wrap;border:0 solid #000;position:relative;box-sizing:border-box;display:block;-webkit-box-orient:vertical;flex-direction:column;align-content:flex-start;flex-shrink:0;font-size:12px;text-align:center;line-height:15px;align-self:center;color:#000">电动牙刷</span>
                </a>
                <a href="" style="text-decoration:none;text-align:center;width: 20%;" data-appeared="true"> <img
                            src="http://mall-ty-1252438738.cos.ap-shanghai.myqcloud.com/images/huli.png"
                            style="display:initial;width:48px;height:48px;margin:5px 11px 2px"/> <span
                            style="white-space:pre-wrap;border:0 solid #000;position:relative;box-sizing:border-box;display:block;-webkit-box-orient:vertical;flex-direction:column;align-content:flex-start;flex-shrink:0;font-size:12px;text-align:center;line-height:15px;align-self:center;color:#000">口腔护理</span>
                </a>
                <a href="" style="text-decoration:none;text-align:center;width: 20%;" data-appeared="true"> <img
                            src="http://mall-ty-1252438738.cos.ap-shanghai.myqcloud.com/images/child.png"
                            style="display:initial;width:48px;height:48px;margin:5px 11px 2px"/> <span
                            style="white-space:pre-wrap;border:0 solid #000;position:relative;box-sizing:border-box;display:block;-webkit-box-orient:vertical;flex-direction:column;align-content:flex-start;flex-shrink:0;font-size:12px;text-align:center;line-height:15px;align-self:center;color:#000">儿童口腔</span>
                </a>
                <a href="" style="text-decoration:none;text-align:center;width: 20%;" data-appeared="true"> <img
                            src="http://mall-ty-1252438738.cos.ap-shanghai.myqcloud.com/images/cate_icon.png"
                            style="display:initial;width:48px;height:48px;margin:5px 11px 2px"/> <span
                            style="white-space:pre-wrap;border:0 solid #000;position:relative;box-sizing:border-box;display:block;-webkit-box-orient:vertical;flex-direction:column;align-content:flex-start;flex-shrink:0;font-size:12px;text-align:center;line-height:15px;align-self:center;color:#000">分类</span>
                </a>
            </div>
        </div>
        <div style="margin:0.2rem;margin-top: 0.3rem;">
            <img style="border-radius:5px" src="https://mall-ty-1252438738.cos.ap-shanghai.myqcloud.com/images/xrzx.png"
                 alt="">
        </div>
        <div style="margin-top:0.3rem;margin-bottom: 0.3rem;">
            <img src="https://mall-ty-1252438738.cos.ap-shanghai.myqcloud.com/images/15325072354995.png" alt="">
        </div>
        <div class="touchweb_page-index2018">
            <div class="rush-buy J_ping">
                <div class="rush-box">
                    <div class="product-list" id="qianggou">
                    </div>
                </div>
            </div>
        </div>
        <!--商品区域-->
        <div id="mainContent" style="margin-top:0.3rem;padding-bottom: 1.5rem;">
            <div class="floor love-floor" id="recFloor">
                <div class="gray-text">
                    <span class="gray-layout"><span class="gray-text-img"></span>为您推荐</span>
                    <!-- <span>为您推荐</span> -->
                </div>
                <ul class="find-similar-ul j_rec_goods_list" id="new">
                </ul>
                <div style="clear: left;">
                </div>
            </div>
        </div>
    </div>
    <a href="javascript:void(0);" onclick="ScrollTop2(0,300)" data-event_id="MHome_BackTop"
       class="m-back-to-top j_back_to_top" style="display: inline;"></a>
@section('footer')
    @include('wap.public.footer')
@endsection
@endsection
@section('script')
    <script type="text/html" id="tpl_new">
        @verbatim
            {{each list v i}}
                <li event_id="Mhome_BRecommendExpo" event_param="1" class="similar-li j_similar_li j_similar_goods expo_loaded" >
                    <a data-id = {{v.id}} href="/good/detail?id={{v.id}}" >
                        <div class="similar-product">
                            <div class="similar-posre"> <img src="{{v.image1}}"
                                                             class="j_rec_goods_pic opa1 ll_fadeIn" style="opacity: 1;"
                                                             loaded="1">  </div> <span class="similar-product-text">
                                    {{v.title}}</span>
                            <p class="similar-product-info"> <span class="similar-product-price"> ¥&nbsp;<span class="big-price">{{v.current_price}}</span>
                            </span> <span data-event_id="MHomeGuessYouLike_BSimilarities" data-event_level="1"
                                          data-event_param="1_31900259367_1" class="guess-button j_see_similar">找相似</span>
                            </p>
                            <p class="similar-product-info"> </p>
                        </div>
                    </a>
                </li>
            {{/each}}
        @endverbatim
    </script>
    <script type="text/html" id="today_r">
    @verbatim
        {{ each list v i }}
            <div class="product-item J_ping">
                <a class="product-box" href="/good/detail?id={{ v.id }}">
                    <div class="pic-wrap">
                        <div class="pic">
                            <img class="lazyload" src="{{ v.image1 }}"></div>
                    </div>
                    <div class="item-tit">{{ v.title }}</div>
                    <div class="price-box">
                        <div class="now-price">
                            <span class="coin-type">￥</span>{{ v.current_price }}</div>
                        <div class="reference">
                            <span class="old-price">￥{{ v.original_price }}</span>
                        </div>
                    </div>
                </a>
            </div>
        {{ /each }}
    @endverbatim
</script>
<script src="/js/wap/index.js?t={{ time() }}?t=1541556091"></script>
<script src="/js/wap/index_top.js?t={{ time() }}?t=1541556091"></script>
@endsection