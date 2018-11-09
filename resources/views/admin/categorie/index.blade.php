@extends('admin.public.public')
@section('css')
        <link href="/admin/assets/css/codemirror.css" rel="stylesheet">
        <link rel="stylesheet" href="/admin/assets/css/ace.min.css" />
        <link rel="stylesheet" href="/admin/Widget/zTree/css/zTreeStyle/zTreeStyle.css" type="text/css">
        <link rel="stylesheet" href="/admin/assets/css/font-awesome.min.css" />
@endsection
@section('script')

	    <script src="/admin/assets/js/typeahead-bs2.min.js"></script>
        <script type="text/javascript" src="/admin/Widget/zTree/js/jquery.ztree.all-3.5.min.js"></script> 
        <script src="/admin/js/lrtk.js" type="text/javascript" ></script>
        <script type="text/javascript" src="/admin/Widget/icheck/jquery.icheck.min.js"></script> 
		<script type="text/javascript" src="/admin/Widget/Validform/5.3.2/Validform.min.js"></script>
		<script type="text/javascript" src="/admin/js/H-ui.js"></script> 
		<script type="text/javascript" src="/admin/js/H-ui.admin.js"></script>
		<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-user-add").Validform({
		tiptype:2,
		callback:function(form){
			form[0].submit();
			var index = parent.layer.getFrameIndex(window.name);
			parent.$('.btn-refresh').click();
			parent.layer.close(index);
		}
	});
});
</script>
<script type="text/javascript"> 
$(function() { 
	$("#category").fix({
		float : 'left',
		//minStatue : true,
		skin : 'green',	
		durationTime :false
	});
});
</script>
<script type="text/javascript">
//初始化宽度、高度  
 $(".widget-box").height($(window).height()); 
 $(".page_right_style").width($(window).width()-220);
 
/**************/
var setting = {
	view: {
		dblClickExpand: false,
		showLine: false,
		selectedMulti: false
	},
	data: {
		simpleData: {
			enable:true,
			idKey: "id",
			pIdKey: "pId",
			rootPId: ""
		}
	},
	callback: {
		beforeClick: function(treeId, treeNode) {
			var zTree = $.fn.zTree.getZTreeObj("tree");
			if (treeNode.isParent) {
				zTree.expandNode(treeNode);
				return false;
			} else {
				demoIframe.attr("src",treeNode.file + ".html");
				return true;
			}
		}
	}
};

var zNodes =[
	{ id:0, pId:0, name:"商城分类列表", open:true},
];

var cates;
		
var code;
		
function showCode(str) {
	if (!code) code = $("#code");
	code.empty();
	code.append("<li>"+str+"</li>");
}
		
$(document).ready(function(){
	

	$.ajax({
	url: '/api/store/categorie',
	async: false,
	data: {type: 'admin'},
	success: function (res) {
		cates = res.data;
		for (var i = 0; i < cates.length; i++) {
			console.log(123123)
			var str = '<option value="'+cates[i].id+'">'+cates[i].name+'</option>';
			$('.cate_list').append(str)
		}

		var k = 1;
		for (var j = 0; j < cates.length; j++) {
			zNodes[k] = {id: cates[j].id, pId: cates[j].pid, name: cates[j].name}
			k++;
			data = cates[j].son
			for (var h = 0; h < data.length; h++) {
				zNodes[k] = {id: data[h].id, pId: data[h].pid, name: data[h].name}
				k++;
			}
			
		}
	}
})
	var t = $("#treeDemo");
	t = $.fn.zTree.init(t, setting, zNodes);
	demoIframe = $("#testIframe");
});	


$('.add_cate').click(function () {
	var name = $('input[name="product-category-name"]').val()
	var pid = $('.cate_list').val()
	var image = $('input[name="yc"]').val()
	$.ajax({
		url: '/api/store/categorie',
		type: 'post',
		data: {
			name: name,
			pid: pid,
			image: image
		},
		success: function (res) {
			console.log(res)
			if (res.status_code == 200) {
				layer.msg('添加分类成功',{icon:1,time:1000});
				location.reload()
			}
		}
	})
})

$('#cate_image').change(function () {
	var file = document.getElementById('cate_image').files[0]
	var formData = new FormData();
	formData.append('file', file)
	$.ajax({
		url: '/api/upload',
		type: 'post',
		data: formData,
		processData:false,
		contentType:false,
		success: function (res) {
			// console.log(res)
			$('input[name="yc"]').val(res.data.path);
			console.log($('input[name="yc"]').val())
		}
	})
})
</script>

@endsection
@section('content')
<div class=" clearfix">
 <div id="category">
    <div id="scrollsidebar" class="left_Treeview">
    <div class="show_btn" id="rightArrow"><span></span></div>
    <div class="widget-box side_content" >
    <div class="side_title"><a title="隐藏" class="close_btn"><span></span></a></div>
     <div class="side_list">
      <div class="widget-header header-color-green2">
          <h4 class="lighter smaller">产品类型列表</h4>
      </div>
      <div class="widget-body">
          <div class="widget-main padding-8">
              <div  id="treeDemo" class="ztree"></div>
          </div>
  </div>
  </div>
  </div>  
  </div>


<div class="type_style">
 <div class="type_title">产品类型信息</div>
  <div class="type_content">
    <div class="Operate_cont clearfix" style="height:39px">
      <label class="form-label" style='width:92px'><span class="c-red" style="color:red">*</span>分类名称：</label>
      <div class="formControls ">
        <input type="text" class="input-text" value="" placeholder="" id="user-name" name="product-category-name">
      </div>
    </div>
	
    <div class="Operate_cont clearfix" style="height:39px">
      <label class="form-label" style='width:92px'><span class="c-red" style="color:red;" >*</span>父分类名称：</label>
      <div class="formControls ">
      	<select name="" id="" style="width:164px;height:28px;margin-left: 10px" class='cate_list'>
      		<option value="0">顶级分类</option>
      	</select>
        <!-- <input type="text" class="input-text" value="" placeholder="" id="user-name" name="product-category-name"> -->
      </div>
</div>
      <div class="Operate_cont clearfix" style="height:39px">
      <label class="form-label" style='width:92px;margin-left: 10px'><span class="c-red" style="color:red">*</span>分类图片：</label>
      <div class="formControls ">
        <input type="file" class="input-text" value="" placeholder="" id="cate_image" name="product-category-name" style="width:68px">
      </div>
    </div>

    


    <div class="" style="width:362px;margin-top:20px">
     <div class="" style=" text-align:center">
      <input class="btn btn-primary radius add_cate" type="submit" value="提交">
      </div>
    </div>
<input type="hidden" name="yc" value="">

  </div>
</div> 
</div>
</div>
@endsection