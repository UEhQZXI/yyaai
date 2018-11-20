@extends('wap.public.index')
@section('title')
    添加收货地址
@endsection
@section('css')
    <link rel="stylesheet" href="/css/wap/addAddress.css">
    <script src="/lib/address/jquery-1.11.3.min.js"></script>
    <script src="/lib/address/Popt.js"></script>
    <script src="/lib/address/cityJson.js"></script>
    <script src="/lib/address/citySet.js"></script>
    <style type="text/css">
        ._citys {
            width: 100%;
            height: 100%;
            display: inline-block;
            position: relative;
        }

        ._citys span {
            color: #333;
            height: 15px;
            width: 15px;
            line-height: 15px;
            text-align: center;
            border-radius: 3px;
            position: absolute;
            right: 1em;
            top: 10px;
            border: 1px solid #56b4f8;
            cursor: pointer;
        }

        ._citys0 {
            width: 100%;
            height: 34px;
            display: inline-block;
            border-bottom: 2px solid #56b4f8;
            padding: 0;
            margin: 0;
        }

        ._citys0 li {
            float: left;
            height: 34px;
            line-height: 34px;
            overflow: hidden;
            font-size: 15px;
            color: #888;
            width: 80px;
            text-align: center;
            cursor: pointer;
        }

        .citySel {
            background-color: #56b4f8;
            color: #fff !important;
        }

        ._citys1 {
            width: 100%;
            height: 80%;
            display: inline-block;
            padding: 10px 0;
            overflow: auto;
        }

        ._citys1 a {
            height: 35px;
            display: block;
            color: #666;
            padding-left: 6px;
            margin-top: 3px;
            line-height: 35px;
            cursor: pointer;
            font-size: 13px;
            overflow: hidden;
        }

        ._citys1 a:hover {
            color: #fff;
            background-color: #56b4f8;
        }

        .ui-content {
            border: 1px solid #EDEDED;
        }

        li {
            list-style-type: none;
        }

        span#city {
            color: #666 !important;
            display: block;
            padding-top: 10px;
        }
    </style>
@endsection
@section('content')
    <div class="add">
        <div class="addTop">
            <a href="javascript:history.go(-1)"><span class="mui-icon mui-icon-arrowleft"></span></a>
            <span style="font-size: 0.4rem;">添加收货地址</span>
        </div>
        <div class="addContent">
            <div class="mui-input-group">
                <div class="mui-input-row">
                    <label>收件人姓名</label>
                    <input type="text" class="mui-input-clear" placeholder="请填写姓名" id="name">
                </div>
                <div class="mui-input-row">
                    <label>手机号码</label>
                    <input type="text" class="" placeholder="请填写手机号" id="password" maxlength="11">
                </div>
                <div class="mui-input-row" style="position:relative">
                    <label>所在地区</label>
                    <span id="city" style="color:#d7d7d7;padding-left:5px;">市，区</span>
                    <span class="mui-icon mui-icon-arrowright" style="position:absolute;top: 10px;right:10px;font-size: 18px;"></span>
                </div>
                <div class="mui-input-row">
                    <label>详细地址</label>
                    <input type="text" class="" placeholder="请填写详细地址" id="address">
                </div>
                <div class="mui-input-row">
                    <label>设置为默认地址</label>
                    <div class="mui-switch mui-switch-mini mui-active">
                        <div class="mui-switch-handle">
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="mui-btn mui-btn-warning mui-btn-outlined conserve" data-loading-text="保存中">保存</button>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $("#city").click(function (e) {
            SelCity(this,e);
            console.log(this);
        });
    </script>
    <script src="/js/wap/addAddress.js"></script>
@endsection