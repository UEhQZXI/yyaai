
$(function(){
    var phone = $(".user").val();
    var psd = $(".psd").val();
  
    $(".user").on("input",function(){
        var phone = $(".user").val()
        if(phone !== ""){
          $(".user_delete").show()
          $(".code").removeAttr("disabled")
        }else{
          $(".user_delete").hide()
          $(".code").attr("disabled","disabled")
        }
    })
    $(".users").on("input",function(){
      var phone = $(".users").val();
      if(phone !== ""){
        $(".user_delete").show()
        $(".code").removeAttr("disabled")
      }else{
        $(".user_delete").hide()
        $(".code").attr("disabled","disabled")
      }
    })
    $(".codeV").on("input",function(){
        var code = $(".codeV").val();
        if(code !== ""){
          $(".sendcode").removeAttr("disabled")
        }else{
          $(".sendcode").attr("disabled","disabled")
        }
     })

    $(".user_delete").on("tap",function(){
        $(".user").val("")
        $(".users").val("")
        $(this).hide()
    })
    $(".psd_delete").on("tap",function(){
        $(".psd").val("")
        $(".psds").val("")
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
    $(".psds").on("input",function(){
      var psd = $(".psds").val();
      if(psd !== ""){
        $(".psd_delete").show()
      }else{
        $(".psd_delete").hide()
      }
  })
    // 账号密码登录
    $("body").on("tap",".login_psd",function(){
           $(".login_first").hide()
           $(".login_three").show()
    })
    // 发送验证码
    $(".code").on("tap",function(){
       var phone = $(".user").val()
       if(!/^1[34578]\d{9}$/.test(phone)){
            mui.toast("手机号码格式不对");
            return false;
        }else{
          $.ajax({
            type:"POST",
            url:"http://47.100.3.125/api/verificationCodes",
            data:{
              phone:phone,
              action:"login"
            },
            success:function(res){
              console.log(res)
              if(res.status_code == 200){
                localStorage.setItem("key",res.data.key)
                 mui.toast("发送成功")
                 setTimeout(function(){
                    $(".login_second").css("display","block")
                    $(".login_first").hide();
                    setTimeout(function () {
                        $("#sms_code").focus();
                    }, 100);
                    $(".tel").text(phone);
                    sendCode()
                 },800)  
              }
            },
            error:function(res){
              console.log(res)
              if(res.status == 422){
                mui.toast("验证码发送过于频繁,请稍后再试")
              }
            }
          })
        }   
    })

      $(".goo").on("tap",function(){
          $(".login_second").hide()
          $(".login_first").show()
      })

      function sendCode(){
        var count = 60;
        var timer = setInterval(function () {
          count--;
          $(".second").text(count+"s重新发送");

          //当时间为0
          if(count === 0){
            clearInterval(timer);
            //让按钮能点
            $(".second").text("重新发送");
          }

        }, 1000);
      }

      $(".second").on("tap",function(){
        var phone = $(".user").val()
        $.ajax({
          type:"POST",
          url:"http://47.100.3.125/api/verificationCodes",
          data:{
            phone:phone,
            action:"login"
          },
          success:function(res){
            console.log(res)
            localStorage.setItem("key",res.data.key) 
          }
        })
         sendCode()
      })
      
    $(".codeV").on("input",function(){
        var code =  $(".codeV").val();
        if(code.length==4){
           $(".sendcode").val("登录中").attr("disabled",)
           login()
        }
    })
    
    function login(){
      var goodId = tools.getSearch("goodId");
      var phone = $(".user").text();
      var key = localStorage.getItem("key");
      var code = $(".codeV").val();
      if(code == ""){
        mui.toast("请输入验证码");
        return false
      }else{
        $.ajax({
          type:"POST",
          url:"http://47.100.3.125/api/authorizations",
          data:{
              phone:phone,
              verification_key:key,
              verification_code:code,
              action:"phoneLogin"
          },
          success:function(res){
            console.log(res)
            if(res.status_code == 200){
                localStorage.setItem("token",res.data.access_token);
                setTimeout(function(){
                  mui.toast("登录成功")
                },300)
                var id = localStorage.getItem("Pid")
                var search = location.search
                if (search.indexOf("retUrl") != -1) {
                    //说明需要回跳
                    search = search.replace("?retUrl=", "");
                    location.href = search + "?id=" + id
                    }else{
                      setTimeout(function(){
                      location.href = "/my"
                    },800)
                }
              }
          },
          error:function(res){
            console.log(res)
            if(res.status == 401){
              mui.toast("验证码错误")
            }
          }
        })
      }

    }
      $(".sendcode").on("tap",function(){
          // var goodId = tools.getSearch("goodId");
          // var phone = $(".tel").text()
          // localStorage.setItem("name",phone)
          // var key = localStorage.getItem("key")
          // var code = $(".codeV").val()
          // if(code == ""){
          //   mui.toast("请输入验证码")
          //   return false
          // }else{
          //   $.ajax({
          //     type:"POST",
          //     url:"http://47.100.3.125/api/authorizations",
          //     data:{
          //         phone:phone,
          //         verification_key:key,
          //         verification_code:code,
          //         login_type:"phone_login"
          //     },
          //     success:function(res){
          //       console.log(res)
          //       if(res.status_code == 200){
          //           mui.toast("登录成功")
          //           localStorage.setItem("token",res.data.access_token)
          //           var id = localStorage.getItem("Pid")
          //           var search = location.search
          //           if (search.indexOf("retUrl") != -1) {
          //               //说明需要回跳
          //               search = search.replace("?retUrl=", "");
          //               location.href = search + "?id=" + id
          //               }else{
          //                 setTimeout(function(){
          //                 location.href = "userInfo.html"
          //               },600)
          //           }
          //         }
          //     },
          //     error:function(res){
          //       console.log(res)
          //       if(res.status == 401){
          //         mui.toast("验证码错误")
          //       }
          //     }
          //   })
          // }

      })
      

  $(".login").on("tap",function(){
      var phone = $(".users").val();
      var psd = $(".psds").val();
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
                    location.href = "/my"
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