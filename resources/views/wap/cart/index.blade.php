@extends('wap.public.index')
@section('html-style')
    touch-action: none;
@endsection
@section('title')
    购物车
@endsection
@section('css')
    <link rel="stylesheet" href="/css/wap/cart.css">
@endsection
@section('body-style')
    background-color:#fff !important;
@endsection
@section('content')
    <div class="Ty_mall">
        <div class="Ty_header">
            <p>购物车</p>
        </div>
        <div class="Ty_main">
            <div class="mui-scroll-wrapper">
                <div class="mui-scroll">
                    <ul class="mui-table-view">
                        <!-- 模板 -->
                    </ul>
                </div>
            </div>
        </div>
        <div class="revise" data-id="@{{v.id}}">
            <p>修改商品数量</p>
            <span class="number">数量:</span>
            <div class="mui-numbox" data-numbox-step='1' data-numbox-min='1' data-numbox-max='100'>
                <button class="mui-btn mui-numbox-btn-minus" type="button">-</button>
                <input class="mui-numbox-input" type="number" />
                <button class="mui-btn mui-numbox-btn-plus" type="button">+</button>
            </div>
            <div class="choose">
                <span class="confirm">确认</span>
                <span class="cancel">取消</span>
            </div>
        </div>
        <div class="totalPrice mui-clearfix" style="z-index:666">
            <div class="pay">
                <span style="font-size: 0.32rem;">合计： <span style="color:orange">&yen;  <span class="total" style="font-size: 0.35rem">0.00</span></span></span>
                <a href="#" id="pays">结算<span class="chooseNum"></span></a>
            </div>
        </div>
        <!-- 阴影 -->
        <div class="mui-backdrop"></div>
    </div>
@section('footer')
    @include('wap.public.footer')
@endsection
@endsection
@section('script')
    <script type="text/html" id="tpl_car">
        @verbatim
            {{ if list.length == 0}}
                <span style="display:block;text-align:center;padding-top:100px;">购物车竟然是空的</span>
            {{/if}}

            {{each list v i}}
                <li class="mui-table-view-cell mui-transitioning" style="position: relative;padding-left:0px;" data-id="{{v.id}}">
                    <div class="mui-slider-right mui-disabled">
                        <a class="mui-btn mui-btn-blue mui-icon mui-icon-compose btn_edit"
                           data-id="{{v.id}}" data-num="{{v.product_number}}"></a>
                        <a data-id="{{v.id}}" class="mui-btn mui-btn-red mui-icon mui-icon-trash btn_delete"></a>
                    </div>
                    <div class="mui-slider-handle mui-clearfix">
                        <div class="mui-input-row mui-checkbox mui-left" style="width:3.5rem;margin:0" >
                            <input name="checkbox1" value="Item 1" type="checkbox"  style="height:0.4rem;width:0.4rem !important;margin-right:0;margin-top:0.9rem;"class="ck" data-price="{{v.product.current_price}}" data-num="{{v.product_number}}"  data-id="{{v.id}}">
                            <img src="{{v.product.image1}}" alt="" style="width:1.6rem;height:1.6rem;margin-left:1.5rem;margin-top:0.6rem;">
                        </div>
                        <div class="info_box" style="position:absolute;top:0px;left:3.5rem;">
                            <p style="margin-bottom:0.2667rem;margin-top:0.4rem;color:#000;font-size:0.35rem;width:5.5rem;margin-bottom:0px;">{{v.product.title}}</p>
                            <span>数量:{{v.product_number}}</span><br>
                            <span style="color:red">&yen;{{v.product.current_price}}</span>
                        </div>
                    </div>
                </li>
            {{/each}}
        @endverbatim
    </script>
    <script src="/js/wap/cart.js?t={{ time() }}"></script>
@endsection