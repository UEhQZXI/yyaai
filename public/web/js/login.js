
$(function(){

    $(".login_btn").on("tap",function(){
        var phone = $(".mui-input-clear").val().trim();
        var psd = $(".mui-input-password").val().trim();
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
           }
       })
       

    })















})