@extends('wap.public.index')
@section('title')
    编辑收货地址
@endsection
@section('css')
    <link rel="stylesheet" href="/css/wap/editor.css">
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
    <div class="eadit">
        <div class="top">
            <a href="javascript:history.go(-1);"><span class="mui-icon mui-icon-arrowleft"></span></a>
            <span style="font-size: 0.4rem;">编辑收货人</span>
            <p>删除</p>
        </div>
        <div class="mui-input-group">
            <!-- 模板 -->
            <div class="mui-input-row">
                <label>收件人:</label>
                <textarea name="" id="name" class="mui-input-clear"></textarea>
            </div>
            <div class="mui-input-row">
                <label>手机号码:</label>
                <textarea name="" id="tel"></textarea>
            </div>
            <div class="mui-input-row">
                <label>所在地区:</label>
                <textarea name="" id="city" ></textarea>
            </div>
            <div class="mui-input-row">
                <label>详细地址:</label>
                <textarea name="" id="addres"></textarea>
            </div>
            <div class="mui-input-row">
                <label style=" width: 200px;display: inline-block;">设置为默认地址</label>
                <div class="mui-switch mui-switch-mini">
                    <div class="mui-switch-handle"></div>
                </div>
            </div>
        </div>
        <button type="button" class="baocun">保存</button>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $("#city").click(function (e) {
            SelCity(this,e);
            console.log(this);
        });
    </script>
    <script type="text/html" id="tpl_person">

    </script>
    <script src="/js/wap/editor.js"></script>
@endsection