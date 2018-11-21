@extends('wap.public.index')
@section('html-style')
    touch-action: none;
@endsection
@section('title')
    确认
@endsection
@section('css')
    <link rel="stylesheet" href="/css/wap/createOrder.css">
@endsection
@section('content')
    <div class="Ty_mall">
        <div class="Ty_header">
            <div class="top">
                <span class="conf">确认订单</span>
                <a href="/cart" class="link"><span class="mui-icon mui-icon-arrowleft"></span></a>
            </div>
        </div>
        <div class="Ty_main">
            <div class="mui-scroll-wrapper">
                <div class="mui-scroll">
                    <!--这里放置真实显示的DOM内容-->
                    <div class="address">
                        <!-- 模板 -->
                    </div>
                    <div class="goodDetail">
                        <!-- 模板 -->
                        <ul id="orderList">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="Ty_footer">
            <a href="#" class="sumbit">提交订单</a>
            <span class="money" style="color:#000;font-size: 0.4rem;">合计金额:  <span style="color:#fe6200;" class="qian">&yen;  0.00</span></span>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/html" id="tpl_direct">
        @verbatim
            <div class="direct">
                <p class="mall">天医商城</p>
                <div class="picImg">
                    <img src="{{info.product.image1}}" alt="">
                    <p>{{info.product.title}}</p>
                    <span class="price">&yen;{{info.product.current_price}}</span>
                    <span class="number">x{{info.number}}</span>
                </div>
                <span class="totalPrice pull-right" style="margin-right: 0.35rem;margin-top: 0.6667rem;font-size:0.3rem">共{{info.number}}件商品   小计：    &yen;  <span style="color:red">{{info.total_price}}</span></span>
            </div>
        @endverbatim
    </script>

    <script type="text/html" id="tpl_order">
        @verbatim
            {{each list v i}}
                <li data-id="{{v.id}}">
                    <p class="mall">天医商城</p>
                    <div class="despiit">
                        <img src="{{v.product.image1}}" alt="">
                        <p>{{v.product.title}}</p>
                        <span class="price">&yen;{{v.product.current_price}}</span>
                        <span class="number">x{{v.product_number}}</span>
                    </div>
                    <span class="totalPrice pull-right" style="margin-right: 0.35rem;margin-top: 0.6667rem;font-size:0.32rem;">共{{v.product_number}}件商品     小计:  &yen;  <span style="color:red">{{v.total_price}}</span></span>
                </li>
                <div style="height:10px;width:100%;background-color:#f4f4f4;"></div>
            {{/each}}
        @endverbatim
    </script>

    <script type="text/html" id="tpl_address">
        @verbatim

        {{if row.length == 0}}
        <a href="/my/address?retUrl=/order/new" style="width:100%;height:2rem;text-align:center;display:block;line-height:2rem">您还没有默认收货地址,点击添加</a>
        {{/if}}
        <!-- {{each row v i}} -->
        <!-- {{if v.is_default == 1}} -->
        <a href="/my/address?retUrl=/order/new" data-id="{{v.id}}" class="addressid">
            <span class="mui-icon mui-icon-location add"></span>
            <span class="person">收货人:<span class="per">{{row[0].user_name}}</span></span>
            <span class="tel">{{row[0].user_phone}}</span>
            <p>收货地址:<span class="areaThose">{{row[0].area1}}{{row[0].area2}}{{row[0].area3}}{{row[0].address}}</span></p>
            <span class="mui-icon mui-icon-arrowright right"></span>
        </a>
        <!-- {{/if}} -->
        <!-- {{if !v.is_default == 1}}
                <a href="address.html?retUrl=createOrder.html" data-id="{{v.id}}" class="addressid">
            <span class="mui-icon mui-icon-location add"></span>
            <span class="person">收货人:<span class="per">{{row[0].user_name}}</span></span>
            <span class="tel">{{row[0].user_phone}}</span>
            <p>收货地址:<span class="areaThose">{{row[0].area1}}{{row[0].area2}}{{row[0].area3}}{{row[0].address}}</span></p>
            <span class="mui-icon mui-icon-arrowright right"></span>
        </a>
    {{/if}} -->
        <!-- {{/each}} -->
        @endverbatim
    </script>

    <script src="/js/wap/createOrder.js"></script>
@endsection