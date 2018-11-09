@extends('admin.public.public')
@section('css')
    <link rel="stylesheet" href="/admin/Widget/zTree/css/zTreeStyle/zTreeStyle.css" type="text/css">
    <link href="/admin/Widget/icheck/icheck.css" rel="stylesheet" type="text/css" />
    <style>
        .clearfix:after {
            display: none !important;
            content: ".";
            height: 0;
            visibility: hidden;
            clear: both;
            font-size: 0;
            line-height: 0;
        }
        #products_list {
            overflow: unset;
        }
        #products_list .table_menu_list {
            float: inherit;
            margin-left: 230px;
            position: unset;
            overflow-y: hidden;
        }
    </style>
@endsection
@section('script')
    <script src="/admin/assets/js/jquery.dataTables.min.js"></script>
    <script src="/admin/assets/js/jquery.dataTables.bootstrap.js"></script>
    <script src="/admin/assets/layer/layer.js" type="text/javascript"></script>
    <script src="/admin/assets/laydate/laydate.js" type="text/javascript"></script>
    <script type="text/javascript" src="/admin/Widget/zTree/js/jquery.ztree.all-3.5.min.js"></script>
    <script src="/admin/js/lrtk.js" type="text/javascript" ></script>
    <script>
        jQuery(function($) {
            var oTable1 = $('#sample-table').dataTable( {
                "aaSorting": [[ 1, "desc" ]],//默认第几个排序
                "bStateSave": true,//状态保存
                "aoColumnDefs": [
                    //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
                    {"orderable":false,"aTargets":[0,2,3,4,5,8,9]}// 制定列不参与排序
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
        laydate({
            elem: '#start',
            event: 'focus'
        });
        $(function() {
            $("#products_style").fix({
                float : 'left',
                //minStatue : true,
                skin : 'green',
                durationTime :false,
                spacingw:30,//设置隐藏时的距离
                spacingh:260,//设置显示时间距
            });
        });
    </script>
    <script type="text/javascript">
        //初始化宽度、高度
        $(".widget-box").height($(window).height()-215);
        $(".table_menu_list").width($(window).width()-260);
        $(".table_menu_list").height($(window).height()-215);
        //当文档窗口发生改变时 触发
        $(window).resize(function(){
            $(".widget-box").height($(window).height()-215);
            $(".table_menu_list").width($(window).width()-260);
            $(".table_menu_list").height($(window).height()-215);
        })

        $(document).ready(function() {
            $.ajax({
                type: "GET",
                url: "/api/store/categorie?type=admin",
                success: function (data) {
                    if (data.status_code == 200) {
                        var data = data.data;
                        console.log(data);
                        var ul1 = '';
                        for (var i = 0; i < data.length; i++) {
                            ul1 += '<ul class="level0 "style="display:block">';
                            ul1 += '<li class="level1"><span id="treeDemo_8_switch" class="button level1 switch noline_open"></span><a class="level1"><span class="button ico_open"></span><span>' + data[i].name + '</span></a>';
                            if (data[i].son.length) {
                                ul1 += '<ul class="level1 ">';
                                for (var j = 0; j < data[i].son.length; j++) {
                                    ul1 += '<li class="level2" onclick="selectCate(this,' + data[i].son[j].id + ')"><span class="button level2 switch noline_docu"></span><a class="level2"><span class="button ico_docu"></span><span class="cate-name">' + data[i].son[j].name + '</span></a></li>';
                                }
                                ul1 += '</ul>';
                            }
                            ul1 += '</li></ul>';
                        }
                        $('#treeDemo').append(ul1);
                    }
                }
            });
        });
        /*产品-停用*/
        function member_stop(obj,id){
            layer.confirm('确认要下架吗？',function(index){
                $.ajax({
                    type: "PATCH",
                    url: "/api/store/products/"+id,
                    data:{
                      status:0
                    },
                    success: function (data) {
                        if (data.status_code == 200) {
                            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" class="btn btn-xs " onClick="member_start(this,id)" href="javascript:;" title="上架"><i class="icon-ok bigger-120"></i></a>');
                            $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
                            $(obj).remove();

                            layer.msg('商品已下架!',{icon: 5,time:1000});
                        }
                    }
                });
            });
        }

        /*产品-启用*/
        function member_start(obj,id){
            layer.confirm('确认要上架吗？',function(index){
                $.ajax({
                    type: "PATCH",
                    url: "/api/store/products/"+id,
                    data:{
                        status:1
                    },
                    success: function (data) {
                        if (data.status_code == 200) {
                            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" class="btn btn-xs btn-success" onClick="member_stop(this,id)" href="javascript:;" title="下架"><i class="icon-ok bigger-120"></i></a>');
                            $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已上架</span>');
                            $(obj).remove();
                            layer.msg('商品已上架!',{icon: 6,time:1000});
                        }
                    }
                });
            });
        }
        /*产品-编辑*/
        function member_edit(title,url){
            window.open(url);
        }

        /*产品-删除*/
        function member_del(obj,id){
            layer.confirm('确认要删除吗？',function(index){
                $(obj).parents("tr").remove();
                layer.msg('已删除!',{icon:1,time:1000});
            });
        }
        //面包屑返回值
        var index = parent.layer.getFrameIndex(window.name);
        parent.layer.iframeAuto(index);
        $('.Order_form').on('click', function(){
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
    </script>
@endsection
@section('content')
    <div class=" page-content clearfix">
            <div class="border clearfix">
       <span class="l_f">
        <a href="/admin/products/add" target="_blank" title="添加商品" class="btn btn-warning Order_form"><i class="icon-plus"></i>添加商品</a>
        {{--<a href="javascript:ovid()" class="btn btn-danger"><i class="icon-trash"></i>批量删除</a>--}}
       </span>
                <span class="r_f">共：<b>{{sizeof($products)}}</b>件商品</span>
            </div>
            <!--产品列表展示-->
            <div class="h_products_list clearfix" id="products_list">
                <div id="scrollsidebar" class="left_Treeview">
                    <div class="show_btn" id="rightArrow"><span></span></div>
                    <div class="widget-box side_content" >
                        <div class="side_title"><a title="隐藏" class="close_btn"><span></span></a></div>
                        <div class="side_list"><div class="widget-header header-color-green2"><h4 class="lighter smaller">产品类型列表</h4></div>
                            <div class="widget-body">
                                <div class="widget-main padding-8">
                                    <div id="treeDemo" class="ztree">

                                    </div></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table_menu_list" id="testIframe">
                    <table class="table table-striped table-bordered table-hover" id="sample-table">
                        <thead>
                        <tr>
                            <th width="25px"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
                            <th width="80px">产品编号</th>
                            <th width="250px">产品名称</th>
                            <th width="80px">颜色/规格</th>
                            <th width="100px">原价</th>
                            <th width="100px">现价</th>
                            <th width="100px">所属分类</th>
                            <th width="180px">创建时间</th>
                            <th width="70px">状态</th>
                            <th width="200px">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td width="25px"><label><input type="checkbox" class="ace" ><span class="lbl"></span></label></td>
                            <td width="80px">{{$product->numbering}}</td>
                            <td width="250px"><u style="cursor:pointer" class="text-primary" onclick="">{{$product->title}}</u></td>
                            <td width="100px">{{$product->model}}</td>
                            <td width="100px">{{$product->original_price}}</td>
                            <td width="100px">{{$product->current_price}}</td>
                            <td class="text-l">{{$product->category->name}}</td>
                            <td width="180px">{{$product->created_at}}</td>
                            <td class="td-status">
                                @if($product->status)
                                    <span class="label label-success radius">已上架</span>
                                @else
                                    <span class="label label-defaunt radius">已下架</span>
                                @endif
                            </td>
                            <td class="td-manage">
                                @if($product->status)
                                    <a onClick="member_stop(this,{{$product->id}})"  href="javascript:;" title="下架"  class="btn btn-xs btn-success"><i class="icon-ok bigger-120"></i></a>
                                @else
                                    <a onClick="member_start(this,{{$product->id}})"  href="javascript:;" title="上架"  class="btn btn-xs"><i class="icon-ok bigger-120"></i></a>
                                @endif
                                <a title="编辑" onclick="member_edit('编辑','/admin/products/{{$product->id}}/edit')" href="javascript:;"  class="btn btn-xs btn-info" ><i class="icon-edit bigger-120"></i></a>
                                {{--<a title="删除" href="javascript:;"  onclick="member_del(this,'1')" class="btn btn-xs btn-warning" ><i class="icon-trash  bigger-120"></i></a>--}}
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection