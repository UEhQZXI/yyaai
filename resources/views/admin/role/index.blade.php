<!DOCTYPE>
<html>
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
	 <script src="/admin/assets/js/typeahead-bs2.min.js"></script>           	
	 <script src="/admin/assets/js/jquery.dataTables.min.js"></script>
	 <script src="/admin/assets/js/jquery.dataTables.bootstrap.js"></script>
       <script src="/admin/assets/layer/layer.js" type="text/javascript" ></script>          
       <script src="/admin/assets/laydate/laydate.js" type="text/javascript"></script>
<title>管理权限</title>
<style>
	table{
		font-size: 13px	
	}
</style>
</head>

<body>
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
                 <a title="编辑" onclick="Competence_modify('560')" href="javascript:;"  class="btn btn-xs btn-info" ><i class="fa fa-edit bigger-120"></i></a>        
                 <a title="删除" href="javascript:;"  onclick="Competence_del(this,'1')" class="btn btn-xs btn-warning" ><i class="fa fa-trash  bigger-120"></i></a>
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
                 <a title="编辑" onclick="Competence_modify('561')" href="javascript:;"  class="btn btn-xs btn-info" ><i class="fa fa-edit bigger-120"></i></a>        
                 
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
                 <a title="编辑" onclick="Competence_modify('562')" href="javascript:;"  class="btn btn-xs btn-info" ><i class="fa fa-edit bigger-120"></i></a>        
               
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
       <div class="col-sm-9"><input type="text" id="form-field-1" placeholder=""  name="权限名称" class="col-xs-10 col-sm-5"></div>
	</div>
     <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 权限说明 </label>
       <div class="col-sm-9"><textarea name="权限说明" class="form-control" id="form_textarea" placeholder="" onkeyup="checkLength(this);"></textarea><span class="wordage">剩余字数：<span id="sy" style="color:Red;">200</span>字</span></div>
	</div>
	<div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 分配管理员 </label>
       <div class="col-sm-9">
       	<input type="radio" name="" id="" style="width:10px;height:10px">
       </div>
	</div>
   </div> 
  </div>
</body>
</html>
<script type="text/javascript">
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
 /*权限-删除*/
function Competence_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$(obj).parents("tr").remove();
		layer.msg('已删除!',{icon:1,time:1000});
	});
}
/*修改权限*/
function Competence_del(id){
		window.location.href ="Competence.html?="+id;
};	
/*字数限制*/
function checkLength(which) {
	var maxChars = 200; //
	if(which.value.length > maxChars){
	   layer.open({
	   icon:2,
	   title:'提示框',
	   content:'您出入的字数超多限制!',	
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
//面包屑返回值
var index = parent.layer.getFrameIndex(window.name);
parent.layer.iframeAuto(index);
$('.Order_form ,#Competence_add').on('click', function(){
	var cname = $(this).attr("title");
	var cnames = parent.$('.Current_page').html();
	var herf = parent.$("#iframe").attr("src");
    parent.$('#parentIframe span').html(cname);
	parent.$('#parentIframe').css("display","inline-block");
    parent.$('.Current_page').attr("name",herf).css({"color":"#4c8fbd","cursor":"pointer"});
	//parent.$('.Current_page').html("<a href='javascript:void(0)' name="+herf+">" + cnames + "</a>");
    parent.layer.close(index);
	
});
</script>