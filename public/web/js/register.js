
$(function () {

  //获取验证码功能
  $(".btn_vcode").on("click", function () {

    //1. 只要点击了，先禁用按钮
    var tel = $("#tel").val()
    console.log(tel)
    if(!tel){
      mui.toast("请输入手机号")
      return false
    }
    var $this = $(this);
    $this.prop("disabled", true).addClass("disabled").text("发送中...");
    var count = 5;
    var timer = setInterval(function () {
      count--;
      $this.text(count+"秒后再次发送");

      //当时间为0
      if(count === 0){
        clearInterval(timer);
        //让按钮能点
        $this.prop("disabled", false).removeClass("disabled").text("再次发送");
      }

    }, 1000);

    //2. 发送ajax请求
    $.ajax({
      type:"POST",
      url:"http://47.100.3.125/api/verificationCodes",
      data:{
        phone:tel
      },
      success:function(res){
        console.log(res)
        localStorage.setItem("key",res.data.key)
       console.log(typeof(res.data.key))
      }
    });

  });


  //注册功能
  $(".btn_register").on("click", function (e) {
    e.preventDefault();

    var username = $("[name='username']").val();
    var password = $("[name='password']").val();
    var repassword = $("[name='repassword']").val();
    var mobile = $("[name='mobile']").val();
    var vCode = $("[name='vCode']").val();

    // if(!username){
    //   mui.toast("请输入用户名");
    //   return false;
    // }

    if(!password){
      mui.toast("请输入密码");
      return false;
    }

    // if(repassword != password){
    //   mui.toast("两次输入的密码不一致");
    //   return false;
    // }

    if(!mobile){
      mui.toast("请输入手机号");
      return false;
    }

    if(!/^1[34578]\d{9}$/.test(mobile)){
      mui.toast("手机号码格式不对");
      return false;
    }

    if(!vCode){
      mui.toast("请输入手机验证码");
      return false;
    }
    
    var key = localStorage.getItem("key")
    console.log(key)
    
    $.ajax({
      type:"POST",
      url:"http://47.100.3.125/api/users",
      data:{
        verification_key:key,
        verification_code:vCode,
        password:password
      },
      success:function(res){
        if(res.avatar){
           mui.toast("注册成功")
           location.href = "login.html"
        }
       
      }
    });

  });

});