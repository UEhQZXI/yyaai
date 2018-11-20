@extends('wap.public.index')
@section('html-style')
    touch-action: none;
@endsection
@section('title')
    订单详情
@endsection
@section('css')
    <link rel="stylesheet" href="/css/wap/orderDetail.css">
@endsection
@section('content')
    <div class="Ty_mall">
        <div class="Ty_header">
            <a href="/my/orders"><span class="mui-icon mui-icon-arrowleft"></span></a>
            <span>订单详情</span>
        </div>
        <div class="Ty_main">
            <div class="mui-scroll-wrapper">
                <div class="mui-scroll">
                    <div class="paying">
                        <span class="status">等待买家付款</span>
                    </div>
                    <div class="address">

                    </div>
                    <div class="order">

                    </div>
                    <!-- 订单编号 -->
                    <div class="orderNumber">

                    </div>
                </div>
            </div>
        </div>
        <div class="Ty_footer">
            <span class="cancel">取消订单</span>
            <span class="Pay">付款</span>
            <span class="see">查看物流</span>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/html" id="tpl_order">
        @verbatim
            {{each list.order_info v i}}
            <div data-id="{{v.id}}">
                <p class="mall">天医商城</p>
                <img src="{{v.product.image1}}" alt="">
                <div class="detail">
                    <span class="logo">{{v.product.title}}</span><br>
                    <span class="price">&yen;  {{v.price}}</span>
                    <span class="num">x{{v.num}}</span>
                </div>
                {{/each}}
                <p class="totalPrice">订单总价:  <span>&yen;  <span class="pric">{{list.sum_price}}</span></span></p>
            </div>
        @endverbatim
    </script>

    <script type="text/html" id="tpl_address">
        @verbatim
            <span class="mui-icon mui-icon-location"></span>
            <span>{{area.user_name}}</span>
            <span class="tel">{{area.user_phone}}</span>
            <p>{{area.area1}}{{area.area2}}{{area.area3}}{{area.address}}</p>
        @endverbatim
    </script>

    <script type="text/html" id="tpl_info">
        @verbatim
            <span>订单信息</span>
            <p><span style="display:inline;font-size:0.33rem;color:#8f8f94">订单编号:   </span><span class="Orders" style="display:inline;font-size:0.33rem;color:#8f8f94">{{list.order_number}}</span></p>
            <p>创建时间:    {{list.created_time}}</p>
        @endverbatim
    </script>

    <script src="/js/wap/orderDetail.js"></script>
@endsection