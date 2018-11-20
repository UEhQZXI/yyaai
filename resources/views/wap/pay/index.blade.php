@extends('wap.public.index')
@section('title')
    支付
@endsection
@section('css')
    <link rel="stylesheet" href="/css/wap/paymethod.css">
@endsection
@section('content')
    <div class="Ty_mall">
        <div class="Ty_header">
            <a href="javascript:history.go(-1)"><span class="mui-icon mui-icon-arrowleft"></span></a>
            <span style="font-size: 0.4rem;">支付订单</span>
        </div>
        <div class="Ty_main">
            <p style="background-color: #fff;width: 100%;text-align: right;padding-right: 0.2667rem;height: 40px;line-height: 40px;color: #000;">需支付:<span style="color:#f24017" class="price"></span></p>
            <div class="method">
                <p>支付方式</p>
                <div class="paymethods">
                    <div class="alipy">
                        <span class="iconfont" style="color: #00a7ff;margin-right: 0.2667rem;">&#xe600;</span>
                        <label>支付宝支付</label>
                        <input type="radio" name="radio1" value="支付宝支付" class="ck" style="z-index:55;color: #fff;">
                        <span class="iconfont icon" style="color:red;font-size: 22px;z-index: 666">&#xe643;</span>
                    </div>
                    <div class="wechat">
                        <span class="iconfont" style="color: #09bb07;margin-right: 0.2667rem;">&#xe630;</span>
                        <label>微信支付</label>
                        <input type="radio" name="radio1" value="微信支付" class="ck" style="z-index:55;color: #fff;">
                        <span class="iconfont icon" style="color:red;font-size: 22px;z-index: 666">&#xe643;</span>
                    </div>
                </div>
            </div>
            <span></span>
        </div>
        <div class="Ty_footer">
            <span class="ft_price">支付  &yen;366</span>
        </div>
    </div>
@endsection
@section('script')
    <script src="/js/wap/paymethod.js"></script>
@endsection