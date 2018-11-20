$(function(){
    var phone = $(".user").val();

    $(".user").on("input",function(){
        var phone = $(".user").val();
        if(phone !== ""){
            $(".user_delete").show();
            $(".code").removeAttr("disabled");
        }else{
            $(".user_delete").hide();
            $(".code").attr("disabled","disabled");
        }
    });

    // 发送验证码
    $(".code").on("tap",function(){
        var phone = $(".user").val();
        if(!/^1[34578]\d{9}$/.test(phone)){
            mui.toast("手机号码格式不对");
            return false;
        }else{
            $.ajax({
                type:"POST",
                url:"http://47.100.3.125/api/verificationCodes",
                data:{
                    phone:phone,
                },
                success:function(res){
                    console.log(res)
                    if(res.status_code == 200){
                        localStorage.setItem("key",res.data.key);
                        mui.toast("发送成功");
                        setTimeout(function(){
                            $(".login_second").css("display","block");
                            $(".login_first").hide();
                            setTimeout(function () {
                                $("#sms_code").focus();
                            }, 100);
                            $(".tel").text(phone);
                            sendCode();
                        },800)
                    }
                },
                error:function(res){
                    if(res.status == 422){
                        mui.toast("验证码发送过于频繁,请稍后再试");
                    }
                }
            })
        }
    });

    $(".bind-phone").on("tap", function () {
        var key = localStorage.getItem("key");
        var vCode = $("#sms_code").val();
        var qqId = $("#qqId").val();
        var name = $("#qqName").val();
        var avatar = $("#qqAvatar").val();
        $.ajax({
            type:"POST",
            url:"http://47.100.3.125/api/users",
            data:{
                verification_key:key,
                verification_code:vCode,
                action:'bindPhone',
                qqId:qqId,
                name:name,
                avatar:avatar
            },
            success:function(res){

                if(res.status_code == 200){
                    localStorage.setItem("token",res.data.access_token);
                    setTimeout(function(){
                        mui.toast("登录成功")
                    },300);
                    setTimeout(function(){
                        location.href = "/my"
                    },800);
                }

                if (res.status == 422) {
                    mui.toast(res.message);
                }

            }
        });
    });

    $(".second").on("tap",function(){
        var phone = $(".tel").text();
        $.ajax({
            type:"POST",
            url:"http://47.100.3.125/api/verificationCodes",
            data:{
                phone:phone,
            },
            success:function(res){
                localStorage.setItem("key",res.data.key);
            }
        });
        sendCode();
    });
});

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