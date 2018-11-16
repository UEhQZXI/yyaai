<!DOCTYPE>
<html>
 <head> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
  <link href="/admin/assets/css/bootstrap.min.css" rel="stylesheet" /> 
  <link rel="stylesheet" href="/admin/assets/css/font-awesome.min.css" /> 
  <link rel="stylesheet" href="/admin/assets/css/ace.min.css" /> 
  <link rel="stylesheet" href="/admin/assets/css/ace-rtl.min.css" /> 
  <link rel="stylesheet" href="/admin/assets/css/ace-skins.min.css" /> 
  <link rel="stylesheet" href="/admin/css/style.css" /> 
  <script src="/admin/assets/js/ace-extra.min.js"></script> 
  <script src="/admin/js/jquery-1.9.1.min.js"></script> 
  <script src="/admin/assets/layer/layer.js" type="text/javascript"></script> 
  <title>登陆</title> 
 </head> 
 <body class="login-layout"> 
  <div class="logintop"> 
   <span>天医商城后台管理系统</span> 
   <ul> 
    <li><a href="#">返回首页</a></li> 
    <li><a href="#">帮助</a></li> 
    <li><a href="#">关于</a></li> 
   </ul> 
  </div> 
  <div class="loginbody"> 
   <div class="login-container"> 
    <div class="center"> 
     <h1> <i class="icon-leaf green"></i> <span class="orange">天医商城</span> <span class="white">后台管理系统</span> </h1> 
     <h4 class="white">Background Management System</h4> 
    </div> 
    <div class="space-6"></div> 
    <div class="position-relative"> 
     <div id="login-box" class="login-box widget-box no-border visible" style="height:293px"> 
      <div class="widget-body"> 
       <div class="widget-main"> 
        <h4 class="header blue lighter bigger"> <i class="icon-coffee green"></i> 管理员登陆 </h4> 
        <div class="login_icon">
         <img src="/admin/images/login.png" />
        </div> 
        <form class=""> 
         <fieldset> 
          <label class="block clearfix"> <span class="block input-icon input-icon-right"> <input type="text" class="form-control" placeholder="登录名" name="username" /> <i class="icon-user"></i> </span> </label> 
          <label class="block clearfix"> <span class="block input-icon input-icon-right"> <input type="password" class="form-control" placeholder="密码" name="password" /> <i class="icon-lock"></i> </span> </label> 
          <div class="space"></div> 
          <div class="clearfix"> 
           <label class="inline"> <input type="checkbox" class="ace" /> <span class="lbl">保存密码</span> </label> 
           <button type="button" class="width-35 pull-right btn btn-sm btn-primary do_login" id="login_btn"> <i class="icon-key"></i> 登陆 </button> 
          </div> 
          <div class="space-4"></div> 
         </fieldset> 
        </form> 
        <div class="social-or-login center"> 
         <span class="bigger-110">通知</span> 
        </div> 
        <div class="social-login center">
          <!-- 本网站系统不再对IE8以下浏览器支持，请见谅。  -->
        </div> 
       </div>
       <!-- /widget-main --> 
       <div class="toolbar clearfix"> 
       </div> 
      </div>
      <!-- /widget-body --> 
     </div>
     <!-- /login-box --> 
    </div>
    <!-- /position-relative --> 
   </div> 
  </div> 
  <div class="loginbm">

   <a href="">上海天医数据科技有限公司</a> 
  </div>
  <strong></strong>   
  <script>
$('#login_btn').on('click', function(){
	   var num=0;
		 var str="";
     $("input[type$='text']").each(function(n){
          if($(this).val()=="")
          {
               
			   layer.alert(str+=""+$(this).attr("name")+"不能为空！\r\n",{
                title: '提示框',				
				icon:0,								
          }); 
		    num++;
            return false;            
          } 
		 });

		  if(num>0){  
        return false;
      } else {

        var username = $('input[name="username"]').val()
        var password = $('input[name="password"]').val()
        $.ajax({
          url: '/admin/login',
          type: 'post',
          data: {
            username: username,
            password: password
          },
          success: function(res) {
            if (res.status_code == 200) {
              location.href="/admin/index"
            } else {
              layer.alert(res.message, {
                title: '提示框',
                icon: 1,
              })
              return false;
              layer.close(index);  

            }
          }
        })
          
		  }		  		     						
		
	})


</script>
 </body>
</html>