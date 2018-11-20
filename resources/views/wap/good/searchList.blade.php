@extends('wap.public.index')
@section('title')
    搜索列表
@endsection
@section('css')
    <link rel="stylesheet" href="/css/wap/searchList.css">
@endsection
@section('content')
    <div class="Ty_mall">

        <div class="Ty_header">
            <a href="javascript:history.go(-1)"><span class="mui-icon mui-icon-arrowleft"></span></a>
            <div class="mui-input-row searchInput">
                <input type="search" class="mui-input-clear search_input">
            </div>
        </div>
        <div class="Ty_main">
            <div class="mui-scroll-wrapper">
                <div class="mui-scroll">
                    <!--这里放置真实显示的DOM内容-->
                    <ul id="goodList">
                        <!-- 模板 -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('script')
    <script type="text/html" id="tpl_searchlist">
        @verbatim
            {{if list.length == 0}}
                <p style="margin:0 auto;text-align:center;margin-top:150px;">没有该商品</p>
            {{/if}}
            {{ each list v i}}
                <a href="/good/detail?id={{v.id}}" data-id="{{v.id}}">
                    <img src="{{v.image1}}" alt="">
                    <p>{{v.title}}</p>
                    <span style="color:red;">{{v.current_price}}</span>
                </a>
            {{/each}}
        @endverbatim
    </script>
    <script src="/js/wap/searchList.js"></script>
@endsection