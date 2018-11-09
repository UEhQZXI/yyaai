(function ($) {
	$.Tupload = {
		fileNum: 0,
		uploadFile:[],
		options:null,
		init:function(defaults){
			this.options = defaults;
			this.fileNum = defaults.fileNum;
			this.createHtml(defaults);
			$(".uploading-img li").mouseenter(function(){
				$(this).find(".uploading-tip").stop().animate({height:'25px'},200);
			});
			$(".uploading-img li").mouseleave(function(){
				$(this).find(".uploading-tip").stop().animate({height:'0'},200);
			});
			this.photoImg();
		},
		photoImg:function(){
			var photoImgH = $('.uploading-imgBg').height();
		 	var ImgH = $('.uploading-imgBg img').height();
			if(ImgH>photoImgH){
				$('.uploading-imgBg img').addClass('cur');
			}else{
				$('.uploading-imgBg img').removeClass('cur');	
			}
		},
		createHtml:function(defaults){
			var fileNum=defaults.fileNum, title = defaults.title,divId = defaults.divId,accept=defaults.accept;
			var html = "";
			if(fileNum<0&& fileNum==null){
				fileNum = 5;
			}
			html += '<div class="uploading-img">';
			html += 	'<p>'+title == '' ? '宝贝图片大小不能超过500kb,为使避免图片上传出现问题，请尽量选择完毕图片后再上传': title+'</p>';
			html += 	'<input type="hidden" id="fileNum" value="0">';
			html += 	'<ul>';
		
				for(var i=0;i<fileNum;i++){
					html += '<li>';
					html += '<div class="uploading-imgBg">';
					html += 	'<img id="img_src'+i+'" class="upload_image" src="images/imgadd.png"/>';
					html += '</div>';
					html += '<p id="uploadProgress_'+i+'" class="uploadProgress"></p>';
					html += '<p id="uploadTure_'+i+'" class="uploadTrue"></p>';
					html += '<div id="uploading-tip'+i+'" class="uploading-tip" style="display: none">';
					html += 	'<span class="onLandR" data="left,'+i+'" ><</span>';
					html += 	'<span class="onLandR" data="rigth,'+i+'" >></span>';
					html += 	'<i class="onDelPic" data="'+i+'">x</i>';
					html += '</div></li>';
					
				}
			html += 	'</ul>';
			html += 	'<div class="uploading-imgInput">';
			html += 		'<input readonly="readonly" id="fileText" type="text" class="imgInput-file"/><span id="uploadFile">上传</span>';
			html += 		'<div class="andArea">';
			html += 			'<div class="filePicker">选择</div>';
			html += 			'<input id="fileImage" name="fileImage" type="file" multiple accept='+accept+'>';
			html += 		'</div>';
			html += 	'</div>';
			html += '</div>';
			$("#"+divId).html(html);
		},
		imgLoad:function(i,file){
			var r = new FileReader();
			r.readAsDataURL(file);
			$(r).load(function(){
				while(true){
					if($("#img_src"+i).attr("src") != "images/imgadd.png"){
						i++;
					}else{
						break;
					}
				}
				arrFile[i] = file;
				$("#img_src"+i).attr("src",this.result);
				console.log(this.result);
				$("#uploading-tip"+i).show();
				$.Tupload.setPhotoImg();
			});
		},
		setPhotoImg:function(){
			var divH = $('.uploading-imgBg').height(); //获取容器高度
			var img = $('.uploading-imgBg img');
			for(var i=0;i<img.length;i++){
				var H = $('.uploading-imgBg img').eq(i).height();
				if(H>divH){
					//当图片高度大于容器高度时
					$('.uploading-imgBg img:eq('+i+')').css('margin-top',-(H-divH)/2+"px");
				}else{
					$('.uploading-imgBg img:eq('+i+')').css('margin-top',(divH-H)/2+"px");
				}
			}	
		},
		onLandR:function(flag,i){
			i = parseInt(i);
			if(flag == 'left'){
				if(i!=0){
					var temp = $("#img_src"+i).attr("src");
					$("#img_src"+i).attr("src",$("#img_src"+(i-1)).attr("src"));
					$("#img_src"+(i-1)).attr("src",temp);
					
					var temp = $("#img_src"+i).attr("value");
					$("#img_src"+i).attr("value",$("#img_src"+(i-1)).attr("value"));
					$("#img_src"+(i-1)).attr("value",temp);
					
					var tempFile = arrFile[i];
					arrFile[i] = arrFile[i-1];
					arrFile[i-1] = tempFile;
					
					var tp1 = $("#uploadTure_"+i).css("display")
					var tp2 = $("#uploadTure_"+(i-1)).css("display")
					if(tp1 == 'none'){
						$("#uploadTure_"+(i-1)).hide();
					}else{
						$("#uploadTure_"+(i-1)).show();
					}
					if(tp2 == 'none' || tp2 == undefined){
						$("#uploadTure_"+i).hide();
					}else{
						$("#uploadTure_"+i).show();
					}
					
					var tip1 = $("#uploading-tip"+i).css("display");
					var tip2 = $("#uploading-tip"+(i-1)).css("display");
					if(tip1 == 'none'){
						$("#uploading-tip"+(i-1)).hide();
					}else{
						$("#uploading-tip"+(i-1)).show();
					}
					if(tip2 == 'none' || tip2 == undefined){
						$("#uploading-tip"+i).hide();
					}else{
						$("#uploading-tip"+i).show();
					}
				}
			}else{
				if(i!=($.Tupload.fileNum-1)){
					var temp = $("#img_src"+i).attr("src");
					$("#img_src"+i).attr("src",$("#img_src"+(i+1)).attr("src"));
					$("#img_src"+(i+1)).attr("src",temp);
					
					var temp1 = $("#img_src"+i).attr("value");
					$("#img_src"+i).attr("value",$("#img_src"+(i+1)).attr("value"));
					$("#img_src"+(i+1)).attr("value",temp1);
					
					var tempFile = arrFile[i];
					arrFile[i] = arrFile[i+1];
					arrFile[i+1] = tempFile;
					
					var tp1 = $("#uploadTure_"+i).css("display");
					var tp2 = $("#uploadTure_"+(i+1)).css("display");
					if(tp1 == 'none'){
						$("#uploadTure_"+(i+1)).hide();
					}else{
						$("#uploadTure_"+(i+1)).show();
					}
					if(tp2 == 'none' || tp2 == undefined){
						$("#uploadTure_"+i).hide();
					}else{
						$("#uploadTure_"+i).show();
					}
					
					var tip1 = $("#uploading-tip"+i).css("display");
					var tip2 = $("#uploading-tip"+(i+1)).css("display");
					if(tip1 == 'none'){
						$("#uploading-tip"+(i+1)).hide();
					}else{
						$("#uploading-tip"+(i+1)).show();
					}
					if(tip2 == 'none' || tip2 == undefined){
						$("#uploading-tip"+i).hide();
					}else{
						$("#uploading-tip"+i).show();
					}
				}
			}
			$.Tupload.setPhotoImg();
		},
//		formUpload:function (i,fileObj,FileController){
//			// FormData 对象
//		    var form = new FormData();
//		    form.append("author", "hooyes");                        // 可以增加表单数据
//		    form.append("file", fileObj);                           // 文件对象
//
//		    // XMLHttpRequest 对象
//		    var xhr = new XMLHttpRequest();
//		    xhr.open("post", FileController, true);
//		    xhr.onload = function (data) {
//		    	/*var temp =eval('(' + data.currentTarget.response + ')')
//		    	if(temp.fileName != undefined){
//		    		$("#img_src"+i).attr('value',temp.fileName);
//		    		$("#img_src"+i).attr('name',"upload_img");
//		        	$("#uploadProgress_"+i).hide();
//		        	$("#uploadTure_"+i).show();
//		    	}*/
//		    	arrFile[i] = '';
//		    	$.Tupload.onSuccess(data,i);
//		    	$("#uploadProgress_"+i).hide();
//	        	$("#uploadTure_"+i).show();
//		    	
//		    };
//		    xhr.send(form);
//		},
//		onSuccess:function(data,i){
//			return $.Tupload.options.onSuccess(data,i);
//		},
		onDelete:function(i){
			$.Tupload.options.onDelete(i);
			$("#uploadTure_"+i).hide();
			$("#img_src"+i).attr("value","");
			$("#img_src"+i).attr('name',"");
			var num = parseInt($("#fileNum").val())-1;
			$("#fileNum").val(num);
			$("#fileText").val("选中"+num+"个文件");
			arrFile[i] = '';
			$("#img_src"+i).attr("src","images/imgadd.png");
			$("#uploading-tip"+i).hide();
			$.Tupload.setPhotoImg();
		}
	}
})(jQuery);
var arrFile = [];
$("#fileImage").on('change',function(){
	var num = parseInt($("#fileNum").val())+parseInt(this.files.length);
	if(num < $.Tupload.fileNum+1){
		$("#fileNum").val(num);
		$("#fileText").val("选中"+num+"张文件");
		for(var i=0;i<num;i++){
			for(var j=0;j<num;j++){
				if($("#img_src"+j).attr("src") == "images/imgadd.png"){
					if(this.files.length-1 < i){
						break;
					}else{
						$.Tupload.imgLoad(i,this.files[i]);
						break;
					}
				}
			}
			
		}
	}else{
		alert("只能上传"+$.Tupload.fileNum+"张");
	}
})
//$("#uploadFile").on('click',function(){
//	for(var i=0;i<arrFile.length;i++){
//		if($("#uploadTure_"+i).css("display") == 'none'){
//			if(arrFile[i] != '' && arrFile[i] != undefined){
//				$("#uploadProgress_"+i).show();
//			}
//		}
//	
//		if(arrFile[i] != undefined){
//			var fileObj = arrFile[i]; // js 获取文件对象
//		    var FileController = $.Tupload.options.url; // 接收上传文件的后台地址 
//		    $.Tupload.formUpload(i,fileObj,FileController);
//		}
//		
//	    
//	}
//	
//});
$(".onLandR").on('click',function(){
	var data = $(this).attr("data").split(",");
	$.Tupload.onLandR(data[0],data[1]);
});
$(".onDelPic").on('click',function(){
	$.Tupload.onDelete($(this).attr("data"));
})