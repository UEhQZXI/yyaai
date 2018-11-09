@extends('admin.public.public')
@section('css')
  
        <link href="/admin/assets/css/codemirror.css" rel="stylesheet">
        <link rel="stylesheet" href="/admin/font/css/font-awesome.min.css" />
@endsection      
@section('script')
		<script src="/admin/assets/js/typeahead-bs2.min.js"></script>           	
		<script src="/admin/assets/js/jquery.dataTables.min.js"></script>
		<script src="/admin/assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="/admin/js/dragDivResize.js" type="text/javascript"></script>
		<script type="text/javascript">
$(document).ready(function () {
	//初始化宽度、高度  
 $(".left_Competence_add,.Competence_add_style").height($(window).height()).val();; 
 $(".Assign_style").width($(window).width()-500).height($(window).height()).val();
 $(".Select_Competence").width($(window).width()-500).height($(window).height()-40).val();

$('.update_role').click(function () {
	var ch = $('input[name="user-Character-0-0-0"]:checked')
	var role_id = [];
	$.each(ch, function () {
		role_id.push($(this).val())
		
	})
	var role = $('input[name="yincang"]').val()
	$.ajax({
		url: '/admin/role/update',
		type: 'patch',
		dataType: 'json',
		data: {
			role_id: role_id,
			role: role
		},
		success: function (res) {
			if (res.status_code == 10001) {
				alert('你没有此操作的权限，请联系超级管理员')
			} else {
				alert('修改成功');
				location.reload()
			}
		}
	})
})

$('.back_role').click(function () {
	history.go(-1)
})

$('.quxiao').click(function () {
	$('input[type="checkbox"]').attr('checked', false);
})
})
/*按钮选择*/
$(function(){
	$(".permission-list dt input:checkbox").click(function(){
		$(this).closest("dl").find("dd input:checkbox").prop("checked",$(this).prop("checked"));
	});
	$(".permission-list2 dd input:checkbox").click(function(){
		var l =$(this).parent().parent().find("input:checked").length;
		var l2=$(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
		if($(this).prop("checked")){
			$(this).closest("dl").find("dt input:checkbox").prop("checked",true);
			$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",true);
		}
		else{
			if(l==0){
				$(this).closest("dl").find("dt input:checkbox").prop("checked",false);
			}
			if(l2==0){
				$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",false);
			}
		}
		
	});
});

</script>
@endsection

@section('content')
<div class="Competence_add_style clearfix">
  <div class="left_Competence_add">
   <div class="title_name">当前管理员</div>
    <div class="Competence_add">
     <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 管理员 </label>
       <div class="col-sm-9"><input type="text" id="form-field-1" placeholder=""  name="权限名称" class="col-xs-10 col-sm-5" value="{{ $admin[$role_id] }}" disabled></div>
	</div>
     <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 当前人员 </label>
      <div class="col-sm-9"><textarea name="权限描述" class="form-control" id="form_textarea" placeholder="" onkeyup="checkLength(this);" disabled>@foreach ($info as $val){{ $val->username }},@endforeach</textarea><span class="wordage"><span id="sy" style="color:Red;"></span></span></div>
	</div>
    <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1">  </label>
        
   </div>
   <!--按钮操作-->
   <div class="Button_operation">
   				<button  class="btn btn-secondary  btn-warning back_role" type="button"><i class="fa fa-reply"></i> 返回上一步</button>
				<button class="btn btn-primary radius update_role" type="submit"><i class="fa fa-save "></i> 保存并提交</button>
				
				<button  class="btn btn-default radius quxiao" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
   </div>
   </div>
   <!--权限分配-->
   <div class="Assign_style" style="width:1226px;left:689px">
      <div class="title_name">权限分配</div>
      <div class="Select_Competence" >
      <dl class="permission-list">
      	<input type="hidden" name="yincang" value="{{ $role_id }}">
		<dt><label class="middle"><input name="user-Character-0" class="ace" type="checkbox" id="id-disable-check"><span class="lbl">商品管理</span></label></dt>
		<dd>
		 <dl class="cl permission-list2">
		 <dt><label class="middle"><input type="checkbox" value="" class="ace"  name="user-Character-0-0" id="id-disable-check"><span class="lbl">商品权限</span></label></dt>
         <dd>
         	@foreach ($dat['store'] as $val)
		   <label class="middle"><input type="checkbox" value="{{ $val['id'] }}" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-0" @if (in_array($val['id'], $actions)) checked @else @endif><span class="lbl">{{ $val['name'] }}</span></label>
		@endforeach
		</dd>
		</dl>
		</dd>
	    </dl> 
        <!--图片管理-->
         <dl class="permission-list">
		<dt><label class="middle"><input name="user-Character-0" class="ace" type="checkbox" id="id-disable-check"><span class="lbl">订单管理</span></label></dt>
		<dd>
		 <dl class="cl permission-list2">
		 <dt><label class="middle"><input type="checkbox" value="" class="ace"  name="user-Character-0-0" id="id-disable-check"><span class="lbl">订单权限</span></label></dt>
         <dd>
		   @foreach ($dat['order'] as $val)
		   <label class="middle"><input type="checkbox" value="{{ $val['id'] }}" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-0" @if (in_array($val['id'], $actions)) checked @else @endif><span class="lbl">{{ $val['name'] }}</span></label>
		@endforeach
		</dd>
		</dl>
        </dd>
	    </dl> 
        <!--交易管理--> 
        <dl class="permission-list">
		<dt><label class="middle"><input name="user-Character-0" class="ace" type="checkbox" id="id-disable-check"><span class="lbl">用户管理</span></label></dt>
		<dd>
		 <dl class="cl permission-list2">
		 <dt><label class="middle"><input type="checkbox" value="" class="ace"  name="user-Character-0-0" id="id-disable-check"><span class="lbl">用户权限</span></label></dt>
         <dd>
		   @foreach ($dat['user'] as $val)
		   <label class="middle"><input type="checkbox" value="{{ $val['id'] }}" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-0" @if (in_array($val['id'], $actions)) checked @else @endif><span class="lbl">{{ $val['name'] }}</span></label>
		@endforeach
		</dd>
		</dl>
        </dd>
		</dl> 

	 <dl class="permission-list">
		<dt><label class="middle"><input name="user-Character-0" class="ace" type="checkbox" id="id-disable-check"><span class="lbl">商品分类管理</span></label></dt>
		<dd>
		 <dl class="cl permission-list2">
		 <dt><label class="middle"><input type="checkbox" value="" class="ace"  name="user-Character-0-0" id="id-disable-check"><span class="lbl">分类权限</span></label></dt>
         <dd>
		   @foreach ($dat['categories'] as $val)
		   <label class="middle"><input type="checkbox" value="{{ $val['id'] }}" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-0" @if (in_array($val['id'], $actions)) checked @else @endif><span class="lbl">{{ $val['name'] }}</span></label>
		@endforeach
		</dd>
		</dl>
        </dd>
		</dl> 
        
        <dl class="permission-list">
		<dt><label class="middle"><input name="user-Character-0" class="ace" type="checkbox" id="id-disable-check"><span class="lbl">管理员管理</span></label></dt>
		<dd>
		 <dl class="cl permission-list2">
		 <dt><label class="middle"><input type="checkbox" value="" class="ace"  name="user-Character-0-0" id="id-disable-check"><span class="lbl">管理员权限</span></label></dt>
         <dd>
		   @foreach ($dat['admin'] as $val)
		   <label class="middle"><input type="checkbox" value="{{ $val['id'] }}" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-0" @if (in_array($val['id'], $actions)) checked @else @endif><span class="lbl">{{ $val['name'] }}</span></label>
		@endforeach
		</dd>
		</dl>
        </dd>
		</dl> 

	<dl class="permission-list">
		<dt><label class="middle"><input name="user-Character-0" class="ace" type="checkbox" id="id-disable-check"><span class="lbl">权限管理</span></label></dt>
		<dd>
		 <dl class="cl permission-list2">
		 <dt><label class="middle"><input type="checkbox" value="" class="ace"  name="user-Character-0-0" id="id-disable-check" ><span class="lbl">权限</span></label></dt>
         <dd>
		   @foreach ($dat['role'] as $val)
		   <label class="middle"><input type="checkbox" value="{{ $val['id'] }}" class="ace" name="user-Character-0-0-0" id="user-Character-0-0-0" @if (in_array($val['id'], $actions)) checked @else @endif><span class="lbl">{{ $val['name'] }}</span></label>
		@endforeach
		</dd>
		</dl>
        </dd>
		</dl> 
          
      </div> 
  </div>
</div>
@endsection

