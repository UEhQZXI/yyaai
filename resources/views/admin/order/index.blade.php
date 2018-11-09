@extends('admin.public.public')
@section('css')
    <link href="/admin/assets/css/codemirror.css" rel="stylesheet">
    <link rel="stylesheet" href="/admin/assets/css/ace.min.css" />
    <link rel="stylesheet" href="/admin/font/css/font-awesome.min.css" />
    <style>
        #products_list {
            overflow: inherit !important;
            position: relative;
            border-top: 1px solid #dddddd;
            border-left: 1px solid #dddddd;
            border-right: 1px solid #dddddd;
        }
        #products_list .order_style {
             padding: 0px;
             margin-left: 0px;
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
        //左侧显示隐藏
        $(function() {
            $("#order_list").fix({
                float : 'left',
                //minStatue : true,
                skin : 'green',
                durationTime :false,
                spacingw:50,//设置隐藏时的距离
                spacingh:270,//设置显示时间距
                close_btn:'.close_btn',
                show_btn:'.show_btn',
                side_list:'.side_list',
            });
        });
        //顶部隐藏显示

        //时间选择
        // laydate({
        //     elem: '#start',
        //     event: 'focus'
        // });
        /*订单-删除*/
        function Order_form_del(obj,id){
            layer.confirm('确认要取消该订单吗？',function(index){
                // $(obj).parents("tr").remove();
                $.ajax({
                    type: "PATCH",
                    url: "/api/store/order/" + id,
                    data: {
                        status:5,
                    },
                    success: function (data) {
                        if (data.status_code == 200) {
                            layer.confirm('数据已提交！',function(index){
                                // $(obj).parents("tr").find(".td-manage").prepend('<a style=" display:none" class="btn btn-xs btn-success" onClick="member_stop(this,id)" href="javascript:;" title="已发货"><i class="fa fa-cubes bigger-120"></i></a>');
                                $(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">已取消</span>');
                                $(obj).css('style', 'display:none');
                                // console.log($(obj).prev().prev());
                                obj.previousElementSibling.previousElementSibling.style.display = 'none';
                                $(obj).remove();
                                layer.msg('订单已取消!',{icon:1,time:1000});
                            });
                            layer.close(index);
                        }
                    }
                });


            });
        }
        /**发货**/
        function Delivery_stop(obj,id){
            layer.open({
                type: 1,
                title: '发货',
                maxmin: true,
                shadeClose:false,
                area : ['500px' , ''],
                content:$('#Delivery_stop'),
                btn:['确定','取消'],
                yes: function(index, layero){
                    if($('#express-code').val()==""){
                        layer.alert('快递号不能为空！',{
                            title: '提示框',
                            icon:0,
                        })
                    }else{
                        $.ajax({
                            type: "PATCH",
                            url: "/api/store/order/" + id,
                            data: {
                              status:2,
                              express_type:$('#express-type').val(),
                              express_code:$('#express-code').val()
                            },
                            success: function (data) {
                                if (data.status_code == 200) {
                                    layer.confirm('提交成功！',function(index){
                                        $(obj).parents("tr").find(".td-manage").prepend('<a style=" display:none" class="btn btn-xs btn-success" onClick="member_stop(this,id)" href="javascript:;" title="已发货"><i class="fa fa-cubes bigger-120"></i></a>');
                                        $(obj).parents("tr").find(".td-status").html('<span class="label label-important radius">待收货</span>');
                                        $(obj).remove();
                                        layer.msg('发货成功!',{icon: 6,time:1000});
                                    });
                                    layer.close(index);
                                }
                            }
                        });

                    }

                }
            })
        };
        //面包屑返回值
        var index = parent.layer.getFrameIndex(window.name);
        parent.layer.iframeAuto(index);
        $('.Order_form,.order_detailed').on('click', function(){
            var cname = $(this).attr("title");
            var chref = $(this).attr("href");
            var cnames = parent.$('.Current_page').html();
            var herf = parent.$("#iframe").attr("src");
            parent.$('#parentIframe').html(cname);
            parent.$('#iframe').attr("src",chref).ready();;
            parent.$('#parentIframe').css("display","inline-block");
            parent.$('.Current_page').attr({"name":herf,"href":"javascript:void(0)"}).css({"color":"#4c8fbd","cursor":"pointer"});
            //parent.$('.Current_page').html("<a href='javascript:void(0)' name="+herf+" class='iframeurl'>" + cnames + "</a>");
            parent.layer.close(index);

        });

        //初始化宽度、高度
        $(".hide_style").height($(".hide_style").height());
        var heights=$(".hide_style").outerHeight(true)+90;
        $(".widget-box").height($(window).height()-heights);
        $(".table_menu_list").width($(window).width()-250);
        $(".table_menu_list").height($(window).height()-heights);
        //当文档窗口发生改变时 触发
        // $(window).resize(function(){
        //     $(".widget-box").height($(window).height()-heights);
        //     $(".table_menu_list").width($(window).width()-250);
        //     $(".table_menu_list").height($(window).height()-heights);
        // })
        //比例
        var oldie = /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase());
        $('.easy-pie-chart.percentage').each(function(){
            $(this).easyPieChart({
                barColor: $(this).data('color'),
                trackColor: '#EEEEEE',
                scaleColor: false,
                lineCap: 'butt',
                lineWidth: 10,
                animate: oldie ? false : 1000,
                size:103
            }).css('color', $(this).data('color'));
        });

        $('[data-rel=tooltip]').tooltip();
        $('[data-rel=popover]').popover({html:true});
    </script>
    <script>
        //订单列表
        jQuery(function($) {
            var oTable1 = $('#sample-table').dataTable( {
                "aaSorting": [[ 1, "desc" ]],//默认第几个排序
                "sScrollY":"600px",
                "bStateSave": true,//状态保存
                "aoColumnDefs": [
                    {"orderable":false,"aTargets":[]}// 制定列不参与排序
                ] } );


            $('table th input:checkbox').on('click' , function(){
                var that = this;
                $(this).closest('table').find('tr > td:first-child input:checkbox')
                    .each(function(){
                        this.checked = that.checked;
                        $(this).closest('tr').toggleClass('selected');
                    });

            });
            $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
            function tooltip_placement(context, source) {
                var $source = $(source);
                var $parent = $source.closest('table')
                var off1 = $parent.offset();
                var w1 = $parent.width();

                var off2 = $source.offset();
                var w2 = $source.width();

                if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
                return 'left';
            }
        });
    </script>
@endsection
@section('content')
    <div class="margin clearfix" >
        <!--订单表格-->
        <div class="order_list" id="order_list">
            <div class="h_products_list clearfix" id="products_list">

                <!--订单列表-->
                <div class="table_menu_list order_style" style="width:100%" id="table_order_list">
                    {{--<div class="search_style">--}}
                        {{--<div class="title_names">搜索查询</div>--}}
                        {{--<ul class="search_content clearfix">--}}
                            {{--<li><label class="l_f">订单编号</label><input name="" type="text" class="text_add" placeholder="订单订单编号" style=" width:250px"></li>--}}
                            {{--<li><label class="l_f">时间</label><input class="inline laydate-icon" id="start" style=" margin-left:10px;"></li>--}}
                            {{--<li style="width:90px;"><button type="button" class="btn_search"><i class="fa fa-search"></i>查询</button></li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    <!--订单列表展示-->
                    <table class="table table-striped table-bordered table-hover" id="sample-table">
                        <thead>
                        <tr>
                            <th width="25px"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
                            <th width="120px">订单编号</th>
                            <th width="250px">购买商品</th>
                            <th width="100px">支付金额</th>
                            <th width="100px">订单创建时间</th>
                            <th width="100px">订单支付时间</th>
                            {{--<th width="180px">所属类型</th>--}}
                            <th width="80px">数量</th>
                            <th width="70px">状态</th>
                            <th width="200px">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
                                <td>{{$order->order_number}}</td>
                                <td class="order_product_name">
                                    @foreach($order->orderInfo as $order_info)
                                        <a href="#"><img src="{{$order_info->product->image1}}"  title="{{$order_info->product->title}}"/></a>
                                        {{--<i class="fa fa-plus"></i>--}}
                                    @endforeach
                                </td>
                                <td>{{$order->sum_price}}</td>
                                {{--<td>14</td>--}}
                                <td>{{$order->created_time}}</td>
                                <td>{{$order->pay_time}}</td>
                                {{--<td>食品</td>--}}
                                <?php $num = 0; ?>
                                @foreach($order->orderInfo as $order_info)
                                   <?php $num += $order_info->num ?>
                                @endforeach
                                <td><?=$num?></td>
                                <td class="td-status">
                                    @switch($order->status)
                                        @case(0)
                                            <span class="label label-grey radius">未支付</span>
                                        @break
                                        @case(1)
                                            <span class="label label-info radius">待发货</span>
                                        @break
                                        @case(2)
                                            <span class="label label-important radius">待收货</span>
                                        @break
                                        @case(3)
                                            <span class="label label-success radius">已完成</span>
                                        @break
                                        @case(4)
                                            <span class="label label-danger radius">退货</span>
                                        @break
                                        @case(5)
                                            <span class="label label-danger radius">已取消</span>
                                        @break
                                    @endswitch
                                </td>
                                <td>
                                    @if($order->status == 1)
                                            <a onClick="Delivery_stop(this, '{{$order->id}}')"  href="javascript:;" title="发货"  class="btn btn-xs btn-success"><i class="fa fa-cubes bigger-120"></i></a>
                                    @endif
                                    <a title="订单详细"  href="/admin/orders/{{$order->id}}/edit"  class="btn btn-xs btn-info order_detailed" ><i class="fa fa-list bigger-120"></i></a>
                                    <a title="取消订单" href="javascript:;"  onclick="Order_form_del(this, '{{$order->id}}')" class="btn btn-xs btn-warning" ><i class="fa fa-trash  bigger-120"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--发货-->
        <div id="Delivery_stop" style=" display:none">
            <div class="">
                <div class="content_style">
                    <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1">快递公司 </label>
                        <div class="col-sm-9"><select class="form-control" id="express-type">
                                <option value="">--选择快递--</option>
                                <option value="1">天天快递</option>
                                <option value="2">圆通快递</option>
                                <option value="3">中通快递</option>
                                <option value="4">顺丰快递</option>
                                <option value="5">申通快递</option>
                                <option value="6">邮政EMS</option>
                                <option value="7">邮政小包</option>
                                <option value="8">韵达快递</option>
                            </select></div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 快递号 </label>
                        <div class="col-sm-9"><input type="text" id="express-code" placeholder="快递号" class="col-xs-10 col-sm-5" style="margin-left:0px;"></div>
                    </div>
                    {{--<div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1">货到付款 </label>--}}
                        {{--<div class="col-sm-9"><label><input name="checkbox" type="checkbox" class="ace" id="checkbox"><span class="lbl"></span></label></div>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
@endsection