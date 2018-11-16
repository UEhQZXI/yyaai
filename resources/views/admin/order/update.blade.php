@extends('admin.public.public')
@section('css')
    <link href="/admin/assets/css/codemirror.css" rel="stylesheet">
    <link rel="stylesheet" href="/admin/assets/css/ace.min.css" />
    <link rel="stylesheet" href="/admin/font/css/font-awesome.min.css" />
    <style>
        .main-content {
            float: right;
            width: 90%;
             margin-left: 0px;
            margin-right: 0;
            margin-top: 0;
            min-height: 100%;
            padding: 0;
        }
    </style>
@endsection
@section('script')
    <script src="/admin/assets/js/jquery.dataTables.min.js"></script>
    <script src="/admin/assets/js/jquery.dataTables.bootstrap.js"></script>
    <script src="/admin/assets/layer/layer.js" type="text/javascript" ></script>
    <script src="/admin/assets/laydate/laydate.js" type="text/javascript"></script>
    <script src="/admin/assets/js/jquery.easy-pie-chart.min.js"></script>
    <script src="/admin/js/lrtk.js" type="text/javascript" ></script>
    <script>
        function chagePrice(id)
        {

            layer.open({
                type: 1,
                title: '修改订单价格',
                maxmin: true,
                shadeClose:false,
                area : ['500px' , ''],
                content:$('#Delivery_stop'),
                btn:['确定','取消'],
                yes: function(index, layero){
                    if($('#input-price').val()=="" || $('#input-price').val() < 0.01){
                        layer.alert('订单价格不能小于0.01元！',{
                            title: '提示框',
                            icon:0,
                        })
                    }else{
                        $.ajax({
                            type: "PATCH",
                            url: "/api/store/order/" + id,
                            data: {
                                sum_price:$('#input-price').val()
                            },
                            success: function (data) {
                                if (data.status_code == 200) {
                                    layer.confirm('订单价格修改成功！',function(index){
                                        $('#price').text($('#input-price').val());
                                        layer.close(index);
                                    });

                                }
                            }
                        });
                    }

                }
            })
        }
    </script>
@endsection
@section('content')
    <div class="margin clearfix">
        <div class="Order_Details_style">
            <div class="Numbering">
                订单编号:<b>{{$order->order_number}}</b>
            </div>
        </div>
        <div class="detailed_style">
            <!--下单用户信息-->
            <div class="Receiver_style">
                    <div class="title_name">
                        下单用户信息
                    </div>
                    <div class="Info_style clearfix">
                        <div class="col-xs-4">
                            <label class="label_name" for="form-field-2"> 用户名： </label>
                            <div class="o_content">
                                {{$order->user->name}}
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <label class="label_name" for="form-field-2"> 用户电话： </label>
                            <div class="o_content">
                                {{$order->user->phone}}
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <label class="label_name" for="form-field-2"> 用户ID： </label>
                            <div class="o_content">
                                {{$order->user->id}}
                            </div>
                        </div>
                    </div>
                </div>
            <!--收件人信息-->
            <div class="Receiver_style">
                <div class="title_name">
                    收件人信息
                </div>
                <div class="Info_style clearfix">
                    <div class="col-xs-4">
                        <label class="label_name" for="form-field-2"> 收件人姓名： </label>
                        <div class="o_content">
                            {{$order->address->user_name}}
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <label class="label_name" for="form-field-2"> 收件人电话： </label>
                        <div class="o_content">
                            {{$order->address->user_phone}}
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <label class="label_name" for="form-field-2"> 收件地址： </label>
                        <div class="o_content">
                            {{$order->address->area1}} {{$order->address->area2}} {{$order->address->area3}} {{$order->address->address}}
                        </div>
                    </div>
                </div>
            </div>
            <!--订单信息-->
            <div class="product_style">
                <div class="title_name">
                    商品信息
                </div>
                <div class="Info_style clearfix">
                    <?php $num = 0;$price = 0;?>
                    @foreach($order->orderInfo as $order_info)
                        <?php $num+=$order_info->num ?>
                        <div class="product_info clearfix">
                            <a href="#" class="img_link"><img src="{{$order_info->product->image1}}" width="200" height="200"/></a>
                            <span>
                                <a href="#" class="name_link">{{$order_info->product->title}}</a>
                                {{--<b>也称为姬娜果，饱满色艳，个头小</b>--}}
                                <p>
                                    颜色/规格：{{$order_info->product->model}}
                                </p>
                                <p>
                                    购买数量：{{$order_info->num}}
                                </p>
                                <p>
                                    单价：<b class="price"><i>￥</i>{{$order_info->product->current_price}}</b>
                                </p>
                                <p>
                                    <?php $price += ($order_info->product->current_price * $order_info->num) ?>
                                    小计：<b class="price"><i>￥</i>{{$order_info->product->current_price * $order_info->num}}</b>
                                </p>
                                {{--<p>--}}
                                    {{--状态：<i class="label label-success radius">有货</i>--}}
                                {{--</p>--}}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
            <!--总价-->
            <div class="Total_style">
                <div class="Info_style clearfix">
                    <div class="col-xs-4">
                        <label class="label_name" for="form-field-2"> 支付方式： </label>
                        <div class="o_content">
                            @if($order->pay_type == '1')
                                支付宝
                            @elseif($order->pay_type == '0')
                                微信
                            @else
                                尚未支付
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <label class="label_name" for="form-field-2"> 支付状态： </label>
                        <div class="o_content">
                            @if($order->pay_type == '1' || $order->pay_type == '0')
                                已支付
                            @else
                                尚未支付
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <label class="label_name" for="form-field-2"> 订单生成日期： </label>
                        <div class="o_content">
                            {{$order->created_time}}
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <label class="label_name" for="form-field-2"> 订单支付日期： </label>
                        <div class="o_content">
                            {{$order->pay_time ?? '尚未支付'}}
                        </div>
                    </div>
                </div>
                <div class="Total_m_style">
                    <span class="Total">订单总数：<b><?=$num?></b></span><span class="Total_price">订单总价：<b><?=$price?></b>元</span>
                </div>
                <div class="Total_m_style">
                    @if($order->pay_type == '1' || $order->pay_type == '0')
                        <span class="Total_price">实际支付价格：<b id="price">{{$order->sum_price}}</b>元</span>
                    @else
                        <span style="cursor: pointer" onclick="chagePrice({{$order->id}})" title="点击修改价格" class="Total_price">实际支付价格：<b id="price">{{$order->sum_price}}</b>元</span>
                    @endif
                </div>
            </div>
            <div class="Button_operation">
                <button onclick="window.location.href='/admin/orders/list'" class="btn btn-primary radius" type="submit"><i class="icon-save "></i>返回商品列表</button>
                {{--<button onclick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>--}}
            </div>
        </div>
    </div>
    <div id="Delivery_stop" style=" display:none">
        <div class="">
            <div class="content_style">
                <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 订单价格 </label>
                    <div class="col-sm-9"><input type="text" id="input-price" placeholder="" class="col-xs-10 col-sm-5" style="margin-left:0px;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection