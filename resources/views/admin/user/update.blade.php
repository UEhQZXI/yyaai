<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
		<script src="/admin/js/jquery-1.9.1.min.js"></script>
        <script src="/admin/assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/admin/Widget/Validform/5.3.2/Validform.min.js"></script>
		<script src="/admin/assets/js/typeahead-bs2.min.js"></script>           	
		<script src="/admin/assets/js/jquery.dataTables.min.js"></script>
		<script src="/admin/assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="/admin/assets/layer/layer.js" type="text/javascript" ></script>          
		<script src="/admin/js/lrtk.js" type="text/javascript" ></script>
         <script src="/admin/assets/layer/layer.js" type="text/javascript"></script>	
        <script src="/admin/assets/laydate/laydate.js" type="text/javascript"></script>
<title>管理员</title>
</head>


<div id="add_administrator_style" class="add_menber">
	<input type="hidden" class="yincang" value="{{ $info->id }}" />
		<div class="form-group">
			<label class="form-label"><span class="c-red">*</span>管理员：</label>
			<div class="formControls">
				<input type="text" class="input-text username" value="{{ $info->username }}" placeholder="" id="user-name" name="username" datatype="*2-16" nullmsg="用户名不能为空" disabled>
			</div>
			<div class="col-4"> <span class="Validform_checktip"></span></div>
		</div>

		<div class="form-group">
			<label class="form-label "><span class="c-red">*</span>手机：</label>
			<div class="formControls ">
				<input type="text" class="input-text phone" value="{{ $info->phone }}" placeholder="" id="user-tel" name="phone" datatype="m" nullmsg="手机不能为空" disabled>
			</div>
			<div class="col-4"> <span class="Validform_checktip"></span></div>
		</div>

		<div class="form-group">
			<label class="form-label"><span class="c-red"><span class="c-red">*</span></span>邮箱：</label>
			<div class="formControls ">
				<input type="text" class="input-text email" placeholder="@" name="email" id="email" datatype="e" value="{{ $info->email }}" disabled>
			</div>
			<div class="col-4"> <span class="Validform_checktip"></span></div>
		</div>
		<div class="form-group">
			<label class="form-label"><span class="c-red">*</span>角色：</label>
			<div class="formControls "> <span class="select-box" style="width:150px;">
				<select class="select role" name="role" size="1">
					<option value="0" {{ $a }}>超级管理员</option>
					<option value="1" {{ $b }}>普通管理员</option>
					<option value="2" {{ $c }}>操作编辑管理员</option>
				</select>
				</span> </div>
		</div>
		<div class="form-group">
			<label class="form-label">备注：</label>
			<div class="formControls">
				<textarea name="description" cols="" rows="" class="textarea description" placeholder="说点什么...100个字符以内" dragonfly="true" onkeyup="checkLength(this);" disabled>{{ $info->description }}</textarea>
				<span class="wordage">剩余字数：<span id="sy" style="color:Red;">100</span>字</span>
			</div>
			<div class="col-4"> </div>
		</div>
		<div> 
        <input class="btn btn-primary radius su" type="submit" id="Add_Administrator" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
   </div>

   <script>
   	$('.su').click(function () {
   		var admin_id = $('.yincang').val();
   		var role = $('.role').val()
   		console.log(admin_id + '---' + role)
   		$.ajax({
   			url: '/admin/user/update/' + admin_id,
   			type: 'patch',
   			data: {
   				role: role
   			},
   			success: function (res) {
   				location.reload()
   				// alert('修改成功');
   			}
   		})
   	})
   </script>