@extends('wap.public.index')
@section('title')
    搜索
@endsection
@section('css')
    <link rel="stylesheet" href="/css/wap/search.css">
@endsection
@section('content')
    <div class="Ty_mall">
        <div class="Ty_header">
            <div class="mui-input-row searchInput">
                <input type="search" class="mui-input-clear search_input" placeholder="请输入要搜索的商品">
            </div>
            <a href="javascript:history.go(-1)" class="goback">取消</a>
            <button class="sear">搜索</button>
        </div>
        <div class="Ty_main">
            <!--滚动容器的父盒子-->
            <div class="mui-scroll-wrapper">
                <!--子盒子-->
                <div class="mui-scroll">
                    <div class="Ty_histotys">
					<!-- 模板 -->
				</div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/html" id="tpl">
        @verbatim
            {{if arr.length === 0}}
                <p style="text-align:center;margin-top:50px;">没有历史记录</p>
            {{/if}}

            {{if arr.length > 0}}
                <div class="title mui-clearfix">
                    <span class="mui-pull-left" style="margin-left:10px;">搜索记录</span>
                    <span class="mui-pull-right mui-icon mui-icon-trash btn_empty" style="margin-right:10px;"></span>
                </div>
                <div class="content">
                    <ul>
                        {{each arr v i}}
                        <li>
                            <a href="/good/search/list?key={{v}}" class="mui-pull-left">{{v}}</a>
                            <span data-index ="{{i}}" class="mui-icon mui-icon-closeempty mui-pull-right btn_delete"></span>
                        </li>
                        {{/each}}
                    </ul>
                </div>
            {{/if}}
        @endverbatim
    </script>
    <script src="/js/wap/search.js"></script>
@endsection