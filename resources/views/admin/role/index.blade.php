@extends('admin.public.public')
@section('css')
       <link href="/admin/assets/css/bootstrap.min.css" rel="stylesheet" />
       <link rel="stylesheet" href="/admin/css/style.css"/>       
       <link href="/admin/assets/css/codemirror.css" rel="stylesheet">
       <link rel="stylesheet" href="/admin/assets/css/ace.min.css" />
       <link rel="stylesheet" href="/admin/font/css/font-awesome.min.css" />
       <style>
			table{
				font-size: 13px;
			}
		</style>

@endsection
       
@section('content')
 <div class="margin clearfix">
   <div class="border clearfix">
       <span class="l_f">
        <a href="javascript:void(0)" id="Competence_add" class="btn btn-warning" title="添加权限"><i class="fa fa-plus"></i> 添加权限</a>
       </span>
       <span class="r_f">共：<b>3</b>类</span>
     </div>
     <div class="compete_list">
       <table id="sample-table-1" class="table table-striped table-bordered table-hover">
		 <thead>
			<tr>
			  <th>权限名称</th>
			  <th>人数</th>
              	  <th>用户名称</th>
			  <th class="hidden-480">描述</th>             
			  <th class="hidden-480">操作</th>
             </tr>
		    </thead>
             <tbody>
			  <tr>
				<td>超级管理员</td>
				<td>{{ $data0[0] }}</td>
				<td class="hidden-480">
					@foreach ($data0 as $val)
						@if (is_int($val))
						@continue;
						@else
						{{$val->username}},
						@endif
					@endforeach
				</td>
				<td>拥有至高无上的权利,操作系统的所有权限</td>
				<td>
                 <a title="编辑" href="/admin/role/updateview/0"  class="btn btn-xs btn-info" ><i class="fa fa-edit bigger-120"></i></a>        
				</td>
			   </tr>
               <tr>
				<td>普通管理员</td>
				<td>{{ $data1[0] }}</td>
				<td class="hidden-480">
					@foreach ($data1 as $val)
						@if (is_int($val))
						@continue;
						@else
						{{$val->username}},
						@endif
					@endforeach
				</td>
				<td>拥有网站的系统大部分使用权限，没有权限管理功能。</td>
				<td>
                 <a title="编辑" href="/admin/role/updateview/1"  class="btn btn-xs btn-info" ><i class="fa fa-edit bigger-120"></i></a>        
                 
				</td>
			   </tr>	
               <tr>
				<td>编辑管理员</td>
				<td>{{ $data2[0] }}</td>
				<td class="hidden-480">
					@foreach ($data2 as $val)
						@if (is_int($val))
						@continue;
						@else
						{{$val->username}},
						@endif
					@endforeach
				</td>
				<td>拥有部分权限，主要进行编辑功能，无边界订单功能，权限分配功能。</td>
				<td>
                 <a title="编辑"  href="/admin/role/updateview/2"  class="btn btn-xs btn-info" ><i class="fa fa-edit bigger-120"></i></a>        
               
				</td>
			   </tr>												
		      </tbody>
	        </table>
     </div>
 </div>
 <!--添加权限样式-->
  <div id="Competence_add_style" style="display:none">
   <div class="Competence_add_style">
     <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 权限名称 </label>
       <div class="col-sm-9"><input type="text" placeholder=""  name="name" class="col-xs-10 col-sm-5 name"></div>
	</div>
	<div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 权限路由 </label>
       <div class="col-sm-9"><input type="text" placeholder=""  name="route" class="col-xs-10 col-sm-5 route"></div>
	</div>
     <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 权限说明 </label>
       <div class="col-sm-9"><textarea name="description" class="form-control description" id="form_textarea" placeholder="" onkeyup="checkLength(this);"></textarea><span class="wordage">剩余字数：<span id="sy" style="color:Red;">200</span>字</span></div>
	</div>

	<div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 权限分类 </label>
       <div class="col-sm-9">
       	<label><input type="radio" name="categories" id="" style="width:25px;height:23px" value='store'><span class="wordage">商品</span></label>
       	<label><input type="radio" name="categories" id="" style="width:25px;height:23px" value='order'><span class="wordage">订单</span></label>
       	<label><input type="radio" name="categories" id="" style="width:25px;height:23px" value='categories'><span class="wordage">分类</span></label>
       	<label><input type="radio" name="categories" id="" style="width:25px;height:23px" value='admin'><span class="wordage">管理员</span></label>
       	<label><input type="radio" name="categories" id="" style="width:25px;height:23px" value='user'><span class="wordage">用户</span></label>
       	<label><input type="radio" name="categories" id="" style="width:25px;height:23px" value='role'><span class="wordage">权限</span></label>
       </div>
	</div>

	<div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 路由方式 </label>
       <div class="col-sm-9">
       	<label><input type="radio" name="type" id="" style="width:25px;height:23px" value='get'><span class="wordage">GET</span></label>
       	<label><input type="radio" name="type" id="" style="width:25px;height:23px" value='post'><span class="wordage">POST</span></label>
       	<label><input type="radio" name="type" id="" style="width:25px;height:23px" value='patch'><span class="wordage">PATCH</span></label>
       	<label><input type="radio" name="type" id="" style="width:25px;height:23px" value='delete'><span class="wordage">DELETE</span></label>
       </div>
	</div>

	<button  class="btn btn-primary radius add_role"  style="margin-left:63px"><i class="fa fa-save"></i> 保存并提交</button>
   </div> 
  </div>
@endsection
@section('script')
<script src="/admin/js/jquery-1.9.1.min.js"></script>
       <script src="/admin/assets/js/bootstrap.min.js"></script>
	 <script src="/admin/assets/js/typeahead-bs2.min.js"></script>           	
	 <script src="/admin/assets/js/jquery.dataTables.min.js"></script>
	 <script src="/admin/assets/js/jquery.dataTables.bootstrap.js"></script>
       <script src="/admin/assets/layer/layer.js" type="text/javascript" ></script>          
       <script src="/admin/assets/laydate/laydate.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function () {
	
/*添加权限*/
 $('#Competence_add').on('click', function(){	 
	 layer.open({
        type: 1,
        title: '添加权限',
	  maxmin: true, 
	  shadeClose: false,
        area : ['800px' , '500px'],
        content:$('#Competence_add_style'),
    });			 
 });

/*修改权限*/
function Competence_del(id){
		window.location.href ="Competence.html?="+id;
};	


$('.add_role').click(function () {
	var name = $('.name').val()
	var route = $('.route').val()
	var description = $('.description').val()
	var role = $('input[type="checkbox"]:checked')
	var role_id = [];

	if (name == '') {
		layer.msg('权限名称不能为空',{icon:2,time:1000});
		return false;
	}
	if (route == '') {
		layer.msg('权限路由不能为空', {icon:2, time:1000});
		return false;
	}

	var categories = $('input[name="categories"]:checked').val();
	if (categories == '' || categories == undefined) {
		layer.msg('权限分类不能为空', {icon: 2, time: 1000})
		return false;
	}

	var type = $('input[name="type"]:checked').val()
	if (type == '' || type == undefined) {
		layer.msg('路由方式尚未选择', {icon: 2, time: 1000})
		return false;
	}


	$.ajax({
		url: '/admin/roles',
		type: 'post',
		data: {
			name: name,
			route: route,
			description: description,
			categories: categories,
			type: type
		},
		success: function (res) {
			layer.msg('添加权限成功', {icon: 5, time: 1000})
			location.reload();
		}
	})
})
})
</script>

@endsection