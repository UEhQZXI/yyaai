
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="Cache-Control" content="no-siteapp" />
         <link href="/admin/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/admin/css/style.css"/>       
        <link href="/admin/assets/css/codemirror.css" rel="stylesheet">
        <link rel="stylesheet" href="/admin/assets/css/ace.min.css" />
        <link rel="stylesheet" href="/admin/font/css/font-awesome.min.css" />
		
<title>管理员</title>
</head>

<body>
<div class="page-content clearfix">
  <div class="administrator">
       <div class="d_Confirm_Order_style">
    <!-- <div class="search_style" style='height:80px'>
      <div class="title_names">搜索查询</div>
      <ul class="search_content clearfix">
       <li><label class="l_f">管理员名称</label><input name="" type="text"  class="text_add" placeholder=""  style=" width:400px"/></li>
       <li><label class="l_f">添加时间</label><input class="inline laydate-icon" id="start" style=" margin-left:10px;"></li>
       <li style="width:90px;"><button type="button" class="btn_search"><i class="fa fa-search"></i>查询</button></li>
      </ul>
    </div> -->
    <!--操作-->
     <div class="border clearfix">
       <span class="l_f">
        <a href="javascript:void(0);" onclick="add()" id="administrator_add" class="btn btn-warning"><i class="fa fa-plus"></i> 添加管理员</a>
        <a href="javascript:void(0);" class="btn btn-danger"><i class="fa fa-trash"></i> 批量删除</a>
       </span>
       <span class="r_f">共：<b>{{ $admin_num }}</b>人</span>
     </div>
     <!--管理员列表-->
     <div class="clearfix administrator_style" id="administrator">
      <div class="left_style">
      <div id="scrollsidebar" class="left_Treeview">
        <div class="show_btn" id="rightArrow"><span></span></div>
        <div class="widget-box side_content" >
         <div class="side_title"><a title="隐藏" class="close_btn"><span></span></a></div>
         <div class="side_list"><div class="widget-header header-color-green2"><h4 class="lighter smaller">管理员分类列表</h4></div>
         <div class="widget-body">
           <ul class="b_P_Sort_list">
           <li><i class="fa fa-users green"></i> <a href="#">全部管理员（{{ $admin_num }}）</a></li>
            <li><i class="fa fa-users orange"></i> <a href="#">超级管理员（）</a></li>
            <li><i class="fa fa-users orange"></i> <a href="#">普通管理员（）</a></li>
            <li><i class="fa fa-users orange"></i> <a href="#">产品编辑管理员（）</a></li>
           </ul>
        </div>
       </div>
      </div>  
      </div>
      </div>
      <div class="table_menu_list"  id="testIframe" style='width:1460px'>
           <table class="table table-striped table-bordered table-hover" id="sample_table">
		<thead>
		 <tr>
				<th width="25px"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
				<th width="80px">编号</th>
				<th width="80px">登录名</th>
				<th width="100px">手机</th>
				<th width='50px'>性别</th>
				<th width="100px">邮箱</th>
                <th width="100px">角色</th>				
				<th width="180px">上次登陆时间</th>
				<th width="70px">状态</th>                
				<th width="200px">操作</th>
			</tr>
		</thead>
	<tbody>
	@foreach ($data as $val)
     <tr>
      <td><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
      <td>{{ $val->id }}</td>
      <td>{{ $val->username }}</td>
      <td>{{ $val->phone }}</td>
      <td>{{ $sex[$val->sex] }}</td>
      <td>{{ $val->email }}</td>
      <td>{{ $role[$val->role] }}</td>
      <td>{{ $val->login_time }}</td>
      @if ($val->status == 1)
      <td class="td-status"><span class="label label-success radius">{{ $status[$val->status] }}</span></td>
      @else
      <td class="td-status"><span class="label label-error radius">{{ $status[$val->status] }}</span></td>
      @endif
      <td class="td-manage">
        <a onClick="member_stop(this,'{{ $val->id }}')"  href="javascript:;" title="{{ $status[abs($val->status - 1)] }}"  class="btn btn-xs btn-success"><i class="fa fa-check  bigger-120"></i></a>  
        <a title="编辑" onclick="member_edit('编辑','member-add.html','{{ $val->id }}','','510')" href="javascript:;"  class="btn btn-xs btn-info edit" ><i class="fa fa-edit bigger-120"></i></a>       
        <a title="删除" href="javascript:;"  onclick="member_del(this,'{{ $val->id }}')" class="btn btn-xs btn-warning" ><i class="fa fa-trash  bigger-120"></i></a>
       </td>
     </tr> 
     @endforeach
    </tbody>
    </table>
      </div>
     </div>
  </div>
</div>
 <!--添加管理员-->
 <div id="add_administrator_style" class="add_menber" style="display:none">
    <form action="" method="post" id="form-admin-add">
		<div class="form-group">
			<label class="form-label"><span class="c-red">*</span>管理员：</label>
			<div class="formControls">
				<input type="text" class="input-text username" value="" placeholder="" id="user-name" name="username" datatype="*2-16" nullmsg="用户名不能为空">
			</div>
			<div class="col-4"> <span class="Validform_checktip"></span></div>
		</div>
		<div class="form-group">
			<label class="form-label"><span class="c-red">*</span>初始密码：</label>
			<div class="formControls">
			<input type="password" placeholder="密码" name="password" autocomplete="off" value="" class="input-text password" datatype="*6-20" nullmsg="密码不能为空">
			</div>
			<div class="col-4"> <span class="Validform_checktip"></span></div>
		</div>

		<div class="form-group">
			<label class="form-label "><span class="c-red">*</span>性别：</label>
			<div class="formControls  skin-minimal">
		      <label><input name="sex" type="radio" class="ace" checked="checked" value=2><span class="lbl" value=2>保密</span></label>&nbsp;&nbsp;
            	<label><input name="sex" type="radio" class="ace" value=1><span class="lbl" value=1>男</span></label>&nbsp;&nbsp;
            	<label><input name="sex" type="radio" class="ace" value=0><span class="lbl" value=0>女</span></label>
			</div>
			<div class="col-4"> <span class="Validform_checktip"></span></div>
		</div>
		<div class="form-group">
			<label class="form-label "><span class="c-red">*</span>手机：</label>
			<div class="formControls ">
				<input type="text" class="input-text phone" value="" placeholder="" id="user-tel" name="phone" datatype="m" nullmsg="手机不能为空">
			</div>
			<div class="col-4"> <span class="Validform_checktip"></span></div>
		</div>
		<div class="form-group">
			<label class="form-label"><span class="c-red"><span class="c-red">*</span></span>邮箱：</label>
			<div class="formControls ">
				<input type="text" class="input-text email" placeholder="@" name="email" id="email" datatype="e">
			</div>
			<div class="col-4"> <span class="Validform_checktip"></span></div>
		</div>
		<div class="form-group">
			<label class="form-label"><span class="c-red">*</span>角色：</label>
			<div class="formControls "> <span class="select-box" style="width:150px;">
				<select class="select role" name="role" size="1">
					<option value="0">超级管理员</option>
					<option value="1">普通管理员</option>
					<option value="2">操作编辑管理员</option>
				</select>
				</span> </div>
		</div>
		<div class="form-group">
			<label class="form-label">备注：</label>
			<div class="formControls">
				<textarea name="description" cols="" rows="" class="textarea description" placeholder="说点什么...100个字符以内" dragonfly="true" onkeyup="checkLength(this);"></textarea>
				<span class="wordage">剩余字数：<span id="sy" style="color:Red;">100</span>字</span>
			</div>
			<div class="col-4"> </div>
		</div>
		<div> 
        <input class="btn btn-primary radius" onclick="yanzheng()"c id="Add_Administrator" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
	</form>

   </div>


    <!--添加管理员-->
</body>

<script src="/admin/js/jquery-1.9.1.min.js"></script>
<script src="/admin/assets/js/bootstrap.min.js"></script>
<script src="/admin/assets/js/typeahead-bs2.min.js"></script>               
<script src="/admin/assets/js/jquery.dataTables.min.js"></script>
<script src="/admin/assets/js/jquery.dataTables.bootstrap.js"></script>
<script src="/admin/assets/layer/layer.js" type="text/javascript" ></script>          
<script src="/admin/js/lrtk.js" type="text/javascript" ></script>
<script src="/admin/assets/layer/layer.js" type="text/javascript"></script> 
<script src="/admin/assets/laydate/laydate.js" type="text/javascript"></script>
<script type="text/javascript" src="/admin/Widget/Validform/5.3.2/Validform.min.js"></script>


<script type="text/javascript">
jQuery(function($) {
		var oTable1 = $('#sample_table').dataTable( {
		"aaSorting": [[ 1, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0,2,3,4,5,7,8,]}// 制定列不参与排序
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
<script type="text/javascript">

//字数限制
function checkLength(which) {
	var maxChars = 100; //
	if(which.value.length > maxChars){
	   layer.open({
	   icon:2,
	   title:'提示框',
	   content:'您输入的字数超过限制!',	
    });
		// 超过限制的字数了就将 文本框中的内容按规定的字数 截取
		which.value = which.value.substring(0,maxChars);
		return false;
	}else{
		var curr = maxChars - which.value.length; //250 减去 当前输入的
		document.getElementById("sy").innerHTML = curr.toString();
		return true;
	}
};


/*用户-停用*/
function member_stop(obj,id){
	layer.confirm('确认要' + $(obj).attr('title') + '吗？',function(index){

   		$.ajax({
   			url: '/admin/user/update/' + id,
   			type: 'patch',
   			data: {
   				status: true
   			},
   			success: function (res) {
   				if ($(obj).attr('title') == '禁用') {
   					var icon = 5
   				} else {
   					var icon = 1
   				}
   				layer.msg('已'+$(obj).attr('title')+'!',{icon: icon,time:1000});
   				location.reload()
   			}
   		})
	});
}

/*产品-编辑*/
function member_edit(title,url,id,w,h){
	// console.log(url, id, w, h)
	layer.open({
    	type: 2,
	title:'修改管理员',
	area: ['700px','450px'],
	shadeClose: false,
	content: '/admin/user/updateview/' + id,
	});
}

/*产品-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$(obj).parents("tr").remove();
		$.ajax({
			url: '/admin/user/destroy',
			type: 'delete',
			data: {admin_id: id},
			success: function (res) {
				layer.msg('已删除!',{icon:1,time:1000});
			}
		})
		
	});
}

/*添加管理员*/
function add (){
	layer.open({
    	type: 1,
	title:'添加管理员',
	area: ['700px',''],
	shadeClose: false,
	content: $('#add_administrator_style'),
	});
}
	//表单验证提交
function yanzheng () {
	//
	var username = $('.username').val()
	var password = $('.password').val()
	var sex = $('input[name="sex"]:checked').val()
	var phone = $('.phone').val()
	var email = $('.email').val()
	var role = $('.role').val()

	if (username == '') {
		layer.msg('用户名不能为空!',{icon: 3,time:1000});
		return false;
	}
	if (password == '') {
		layer.msg('密码不能为空!',{icon: 4,time:1000});
		return false;
	}
	if (phone == '') {
		layer.msg('电话不能为空!',{icon: 5,time:1000});
		return false;
	}
	if (email == '') {
		layer.msg('邮箱不能为空!',{icon: 7,time:1000});
		return false;
	}
	var description = $('.description').val()
	$.ajax({
		url: '/admin/admin',
		type: 'post',
		data: {
			username: username,
			password: password,
			sex: sex,
			phone: phone,
			email: email,
			role: role,
			description: description
		},
		success: function (res)
		{
			console.log(res)
			layer.msg('添加成功', {icon: 1,time: 3000});
			location.reload();
		}
	})
}

</script>