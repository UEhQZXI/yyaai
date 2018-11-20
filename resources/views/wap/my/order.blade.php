@extends('wap.public.index')
@section('html-style')
    touch-action: none;
@endsection
@section('title')
    我的订单
@endsection
@section('css')
    <link rel="stylesheet" href="/css/wap/myOder.css">
@endsection
@section('body-style')
    background-color:#fff !important;
@endsection
@section('content')
    <div class="Ty_mall">
        <div class="Ty_header">
            <a class="icon_left" href="/my"><span class="mui-icon mui-icon-arrowleft" style=" color: #333"></span></a>
            <span style="margin-top:15px;display: block;font-size: 0.4rem">我的订单</span>
            <div class="orderList">
                <ul class="mui-clearfix" style="font-size:0.33rem;">
                  <li class="now one">全部</li>
                  <li class="two">待付款</li>
                  <li class="three">待发货</li>
                  <li class="four">待收货</li>
                  <li class="five">已完成</li>
                </ul>
                <!-- <div class="orange"></div> -->
            </div>
        </div>
        <div class="Ty_main">
            <div class="mui-scroll-wrapper">
                <div class="mui-scroll">
                    <div class="loading"></div>
                    <!-- 全部 -->
                    <div class="all">
                  <!-- 模板 -->
              </div>
                    <!-- 待付款 -->
                    <div class="payment" style="display:none">

                    </div>
                    <!-- 待发货 -->
                    <div class="delivery_good" style="display:none">

                    </div>
                    <!-- 待收货 -->
                    <div class="collect" style="display:none">

                    </div>
                    <!-- 待评价 -->
                    <div class="evaluate" style="display:none">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/html" id="tpl_all">
        @verbatim
            {{ if allList.length == 0 }}
                <p style="position:absolute;top:3.5rem;left:40%">暂时没有订单</p>
                <a href="/" style="position:absolute;top:4.5rem;left:45%;color:#333;border:1px solid #dedede;width:50px;text-align:center">去逛逛</a>
            {{ /if }}
            {{ each allList v i }}
                {{ if v.status == 0 }}
                    <div class="content" data-id="{{ v.id }}">
                        <span class="mall">天医商城</span>
                        <span class="status pull-right">等待买家付款</span>
                        {{ each v.order_info v i }}
                        <div style="margin-bottom:30px;overflow: hidden;" class="goodTotal">
                            <img src="{{ v.product.image1 }}" alt="">
                            <p class="goods">{{ v.product.title }}</p>
                            <span class="price">&yen;{{ v.price }}</span>
                            <span class="nums">x{{ v.num }}</span>
                        </div>
                        {{ /each }}
                        <p class="numb"> 合计：&yen;{{ v.sum_price }}</p>
                        <span class="pay">付款</span>
                        <span class="delete" data-id="{{ v.id }}">取消订单</span>
                    </div>
                {{ /if }}
                {{ if v.status == 1 }}
                    <div class="content" data-id="{{ v.id }}">
                        <span class="mall">天医商城</span>
                        <span class="status pull-right">卖家正在发货中</span>
                        {{ each v.order_info v i }}
                        <div style="margin-bottom:30px;overflow: hidden;" class="goodTotal">
                            <img src="{{ v.product.image1 }}" alt="">
                            <p class="goods">{{ v.product.title }}</p>
                            <span class="price">&yen;{{ v.price }}</span>
                            <span class="nums">x{{ v.num }}</span>
                        </div>
                        {{ /each }}
                        <p class="numb"> 合计：&yen;{{ v.sum_price }}</p>
                    </div>
                {{ /if }}
                {{ if v.status == 2 }}
                    <div class="content" data-id="{{ v.id }}">
                        <span class="mall">天医商城</span>
                        <span class="status pull-right">卖家已发货</span>
                        {{ each v.order_info v i }}
                        <div style="margin-bottom:30px;overflow: hidden;" class="goodTotal">
                            <img src="{{ v.product.image1 }}" alt="">
                            <p class="goods">{{ v.product.title }}</p>
                            <span class="price">&yen;{{ v.price }}</span>
                            <span class="nums">x{{ v.num }}</span>
                        </div>
                        {{ /each }}
                        <p class="numb"> 合计：&yen;{{ v.sum_price }}</p>
                        <span class="wuliu" data-id="{{ v.id }}">查看物流</span>
                    </div>
                {{ /if }}
                {{ if v.status == 3 }}
                    <div class="content" data-id="{{ v.id }}">
                        <span class="mall">天医商城</span>
                        <span class="status pull-right">已签收</span>
                        {{ each v.order_info v i }}
                        <div style="margin-bottom:30px;overflow: hidden;" class="goodTotal">
                            <img src="{{ v.product.image1 }}" alt="">
                            <p class="goods">{{ v.product.title }}</p>
                            <span class="price">&yen;{{ v.price }}</span>
                            <span class="nums">x{{ v.num }}</span>
                        </div>
                        {{ /each }}
                        <p class="numb"> 合计：&yen;{{ v.sum_price }}</p>
                    </div>
                {{ /if }}
            {{ /each }}
        @endverbatim
    </script>

    {{--代付款--}}
    <script type="text/html" id="tpl_payment">
        @verbatim
            {{if list.length == 0}}
                <p style="position:absolute;top:3.5rem;left:40%">暂时没有订单</p>
                <a href="/" style="position:absolute;top:4.5rem;left:45%;color:#333;border:1px solid #dedede;width:50px;text-align:center">去逛逛</a>
            {{/if}}
            {{each list v i}}
                {{if v.status == 0}}
                    <div class="content" data-id="{{v.id}}">
                        <span class="mall">天医商城</span>
                        <span class="status pull-right">等待买家付款</span>
                        {{each v.order_info v i}}
                        <div style="margin-bottom:30px;overflow: hidden;" class="goodTotal">
                            <img src="{{v.product.image1}}" alt="">
                            <p class="goods">{{v.product.title}}</p>
                            <span class="price">&yen;{{v.price}}</span>
                            <span class="nums">x{{v.num}}</span>
                        </div>
                        {{/each}}
                        <p class="numb"> 合计：&yen;{{v.sum_price}}</p>
                        <span class="pay">付款</span>
                        <span class="delete" data-id="{{v.id}}">取消订单</span>
                    </div>
                {{/if}}
            {{/each}}
        @endverbatim
    </script>

    <script type="text/html" id="tpl_delivery_good">
        @verbatim
        {{if row.length == 0}}
            <p style="position:absolute;top:3.5rem;left:40%">暂时没有订单</p>
            <a href="/" style="position:absolute;top:4.5rem;left:45%;color:#333;border:1px solid #dedede;width:50px;text-align:center">去逛逛</a>
        {{/if}}
        {{each row v i}}
            {{if v.status == 1}}
                <div class="content" data-id="{{v.id}}">
                    <span class="mall">天医商城</span>
                    <span class="status pull-right">卖家正在发货中</span>
                    {{each v.order_info v i}}
                    <div style="margin-bottom:30px;overflow: hidden;" class="goodTotal">
                        <img src="{{v.product.image1}}" alt="">
                        <p class="goods">{{v.product.title}}</p>
                        <span class="price">&yen;{{v.price}}</span>
                        <span class="nums">x{{v.num}}</span>
                    </div>
                    {{/each}}
                    <p class="numb"> 合计：&yen;{{v.sum_price}}</p>
                </div>
            {{/if}}
        {{/each}}
        @endverbatim
    </script>

    <script type="text/html" id="tpl_collect">
        @verbatim
        {{if info.length == 0}}
            <p style="position:absolute;top:3.5rem;left:40%">暂时没有订单</p>
            <a href="/" style="position:absolute;top:4.5rem;left:45%;color:#333;border:1px solid #dedede;width:50px;text-align:center">去逛逛</a>
        {{/if}}
        {{each info v i}}
            <div class="content" data-id="{{v.id}}">
                <span class="mall">天医商城</span>
                <span class="status pull-right">卖家已发货</span>
                {{each v.order_info v i}}
                <div style="margin-bottom:30px;overflow: hidden;" class="goodTotal">
                    <img src="{{v.product.image1}}" alt="">
                    <p class="goods">{{v.product.title}}</p>
                    <span class="price">&yen;{{v.price}}</span>
                    <span class="nums">x{{v.num}}</span>
                </div>
                {{/each}}
                <p class="numb"> 合计：&yen;{{v.sum_price}}</p>
            </div>
        {{/each}}
        @endverbatim
    </script>

    <script type="text/html" id="tpl_evaluate">
        @verbatim
        {{if elist.length == 0}}
            <p style="position:absolute;top:3.5rem;left:40%">暂时没有订单</p>
            <a href="/" style="position:absolute;top:4.5rem;left:45%;color:#333;border:1px solid #dedede;width:50px;text-align:center">去逛逛</a>
        {{/if}}
        {{each elist v i}}
            <div class="content" data-id="{{v.id}}">
                <span class="mall">天医商城</span>
                <span class="status pull-right">已签收</span>
                {{each v.order_info v i}}
                <div style="margin-bottom:30px;overflow: hidden;" class="goodTotal">
                    <img src="{{v.product.image1}}" alt="">
                    <p class="goods">{{v.product.title}}</p>
                    <span class="price">&yen;{{v.price}}</span>
                    <span class="nums">x{{v.num}}</span>
                </div>
                {{/each}}
                <p class="numb"> 合计：&yen;{{v.sum_price}}</p>
            </div>
        {{/each}}
        @endverbatim
    </script>
    <script src="/js/wap/myOder.js"></script>
@endsection