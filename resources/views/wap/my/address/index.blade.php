@extends('wap.public.index')
@section('title')
    收货地址
@endsection
@section('css')
    <link rel="stylesheet" href="/css/wap/address.css">
@endsection
@section('body-style')
    background-color:#fff !important;
@endsection
@section('content')
    <div class="address">
        <div class="addressTop">
            <a href="#" class="link"><span class="mui-icon mui-icon-arrowleft"></span></a>
            <span style="font-size: 0.4rem;">管理收货地址</span>
        </div>
        <div class="addressContent">
            <ul id="addList">

            </ul>
        </div>
        <a href="/my/address/new" class="Address">添加收货地址</a>
    </div>
@endsection
@section('script')
    <script type="text/html" id="tpl_add">
        @verbatim
            {{ if list.length == 0}}
                <p style="margin-top:150px;">暂无收货地址</p>
            {{/if}}

            {{each list v i}}
                <li data-id="{{v.id}}" class="addressLIst">
                    <span class="name">{{v.user_name}}</span>
                    <p class="tel">{{v.user_phone}}</p>
                    {{ if v.is_default == 1}}
                    <span id="default">默认</span>
                    {{/if}}
                    <div>
                        <span>{{v.area1}}</span>
                        <span>{{v.area2}}</span>
                        <span>{{v.area3}}</span>
                        <span>{{v.address}}</span>
                    </div>
                    <a href="/my/address/edit?id={{v.id}}"><span class="mui-icon mui-icon-compose eadit"></span></a>
                </li>
            {{/each}}
        @endverbatim
    </script>
    <script src="/js/wap/address.js"></script>
@endsection