
$(function(){
  var phone = $(".user").val();
  var psd = $(".psd").val();
  
  $(".user").on("input",function(){
      var phone = $(".user").val();
      if(phone !== ""){
        $(".user_delete").show()
      }else{
        $(".user_delete").hide()
      }
  })

  $(".user_delete").on("tap",function(){
      $(".user").val("")
      $(this).hide()
  })
  $(".psd_delete").on("tap",function(){
    $(".psd").val("")
    $(this).hide()
  })
  $(".psd").on("input",function(){
    var psd = $(".psd").val();
    if(psd !== ""){
      $(".psd_delete").show()
    }else{
      $(".psd_delete").hide()
    }
  })

  $(".login").on("tap",function(){
      var phone = $(".user").val();
      var psd = $(".psd").val();
      var goodId = tools.getSearch("goodId");
      localStorage.setItem("name",phone)
      if(!phone){
        mui.toast("请输入用户名")
        return false
      }
      if(!psd){
        mui.toast("请输入密码")
        return false
      }
     
      if(!/^1[34578]\d{9}$/.test(phone)){
        mui.toast("手机号码格式不对");
        return false;
      }
     
     $.ajax({
         type:"POST",
         url:"http://47.100.3.125/api/authorizations",
         data:{
          phone:phone,
          password:psd
         },
         success:function(res){
             console.log(res)
           if(res.status_code == 200){
              mui.toast("登录成功")
              localStorage.setItem("token",res.data.access_token)
              var id = localStorage.getItem("Pid")
              var search = location.search;
              console.log(search)
              if (search.indexOf("retUrl") != -1) {
                //说明需要回跳
                search = search.replace("?retUrl=", "");
                location.href = search + "?id=" + id
              }else{
                setTimeout(function(){
                    location.href = "userInfo.html"
                  },600)
              }
           }
         },
         error:function(res){
           console.log(res.data)
           if(res.status == 401){
             mui.toast("账号或密码错误")
           }
           if(res.status == 422){
             mui.toast("密码长度至少为6个字符")
           }
         }
     })
     

  })















})