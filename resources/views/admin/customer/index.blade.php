@extends('admin.public.public')
@section('css')
     
        <link href="/admin/assets/css/codemirror.css" rel="stylesheet">
        <link rel="stylesheet" href="/admin/assets/css/font-awesome.min.css" />
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

		<script src="/admin/assets/js/typeahead-bs2.min.js"></script>
		<script src="/admin/assets/js/jquery.dataTables.min.js"></script>
		<script src="/admin/assets/js/jquery.dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="/admin/js/H-ui.js"></script> 
    <script type="text/javascript" src="/admin/js/H-ui.admin.js"></script> 

        <script>
            jQuery(function($) {
        var oTable1 = $('#sample-table').dataTable( {
        "aaSorting": [[ 1, "desc" ]],//默认第几个排序
    "bStateSave": true,//状态保存
    "aoColumnDefs": [
      //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
      {"orderable":false,"aTargets":[0,8,9]}// 制定列不参与排序
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
      })
/*用户-查看*/
function member_show(title,url,id,w,h){
  layer_show(title,url+'#?='+id,w,h);
}


/*用户-编辑*/
function member_edit(id){
  var flag = true;
    $.ajax({
      url: '/admin/user/userinfo',
      data: {id: id},
      success: function (res) {

        if ((typeof res) == 'string') {
          layer.msg('你没有权限进行此操作', {icon: 5,time: 3000});
        }
        $('input[name="name"]').val(res.name)
        $('input[name="birthday"]').val(res.birthday)
        $('.sex' + res.sex).attr('checked', 'checked')
        $('input[name="create_time"]').val(res.created_at)
        $('input[name="phone"]').val(res.phone)
        $('input[name="address"]').val(res.address)
        $('input[name="integral"]').val(res.integral)
        $('input[name="fans"]').val(res.fans)
      }

    })
    layer.open({
    type: 1,
    title: '查看用户信息',
    maxmin: true, 
    shadeClose:false, //点击遮罩关闭层
    area : ['800px' , ''],
    content:$('#add_menber_style'),
    yes:function(index,layero){ 
      //
    }
    });
}
</script>
@endsection

@section('content')
<div class="page-content clearfix">
    <div id="Member_Ratings">
      <div class="d_Confirm_Order_style">
     <div class="table_menu_list">
       <table class="table table-striped table-bordered table-hover" id="sample-table">
		<thead>
		 <tr>
				<th width="25"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
        <th width="50">头像</th>
				<th width="80">ID</th>
				<th width="100">用户名</th>
				<th width="80">性别</th>
				<th width="120">手机</th>
				<th width="300">地址</th>
				<th width="180">加入时间</th>
				<th width="70">状态</th>                
				<th width="250">操作</th>
			</tr>
		</thead>
	<tbody>
    @foreach ($data as $val)
		<tr>
          <td><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
          <td><img src="{{ $val->avatar }}" width="50px" height="50px"></td>
          <td>{{ $val->id }}</td>
          <td><u style="cursor:pointer" class="text-primary" >{{ $val->name }}</u></td>
          <td>{{ $sex[$val->sex] }}</td>
          <td>{{ $val->phone }}</td>
          <td class="text-l">{{ $val->address }}</td>
          <td>{{ $val->created_at }}</td>
          <td class="td-status"><span class="label label-success radius">已启用</span></td>
          <td class="td-manage">
          <a title="编辑" onclick="member_edit({{ $val->id }})" href="javascript:;"  class="btn btn-xs btn-info" ><i class="icon-edit bigger-120"></i></a> 
          </td>
		</tr>
    @endforeach
      </tbody>
	</table>
   </div>
  </div>
 </div>
</div>
<!--添加用户图层-->
<div class="add_menber" id="add_menber_style" style="display:none">
  
    <ul class=" page-content">
     <li><label class="label_name">用&nbsp;&nbsp;户 &nbsp;名：</label><span class="add_name">
            <input value="" name="name" type="text"  class="text_add" disabled />
    </span><div class="prompt r_f"></div></li>

     <li><label class="label_name">出生日期：</label><span class="add_name">
            <input name="birthday" type="text"  class="text_add" disabled/>
      </span><div class="prompt r_f"></div></li>


     <li><label class="label_name">性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别：</label><span class="add_name">
     <label><input name="sex" type="radio" class="ace sex1" value=1 disabled><span class="lbl">男</span></label>&nbsp;&nbsp;&nbsp;
     <label><input name="sex" type="radio" class="ace sex0" value=0 disabled><span class="lbl">女</span></label>&nbsp;&nbsp;&nbsp;
     <label><input name="sex" type="radio" class="ace sex2" value=2 disabled><span class="lbl">保密</span></label>
     </span>

     <div class="prompt r_f"></div>
     </li>
     <li><label class="label_name">加入时间：</label><span class="add_name"><input name="create_time" disabled type="text"  class="text_add"/></span><div class="prompt r_f"></div></li>
     <li><label class="label_name">移动电话：</label><span class="add_name"><input name="phone" type="text" disabled class="text_add"/></span><div class="prompt r_f"></div></li>
     <!-- <li><label class="label_name">电子邮箱：</label><span class="add_name"><input name="电子邮箱" type="text"  class="text_add"/></span><div class="prompt r_f"></div></li> -->
     <li class="adderss"><label class="label_name">家庭住址：</label><span class="add_name"><input name="家庭住址" type="address"  class="text_add" style=" width:350px;height:28px;margin-left:10px" disabled/></span><div class="prompt r_f"></div></li>
     
    <ul class=" page-content">
     <li><label class="label_name" style="width: 65px">积&nbsp;&nbsp;  &nbsp;分：</label><span class="add_name">
            <input value="" name="integral" type="text"  class="text_add" disabled/>
    </span><div class="prompt r_f"></div></li>

     <li><label class="label_name">粉丝：</label><span class="add_name">
            <input name="fans" type="text"  class="text_add" disabled/>
      </span><div class="prompt r_f"></div></li>

    </ul>
 </div>


@endsection