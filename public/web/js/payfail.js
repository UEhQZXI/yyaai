
$(function(){
    var toke = localStorage.getItem("token")
    var id = tools.getSearch("id");
    $.ajax({
        type:"GET",
        url:"http://47.100.3.125/api/store/order/" + id,
        headers: {
            'Authorization': `Bearer ` + toke,
        },
        success:function(res){
            console.log(res)
            if(res.status_code == 200){
                var info = {
                    area:res.data.address
                }
                var list = res.data
                $(".order").html(template("tpl_order",{list}))
                $(".address").html(template("tpl_address",info))
                $(".orderNumber").html(template("tpl_info",{list}))
                if(res.data.status == 0){
                    $("span.see").hide()
               }
                if(res.data.status == 1){
                     $("span.status").text("光速发货中,请耐心等待")
                     $("span.Pay").hide()
                     $("span.cancel").hide()
                }
                if(res.data.status == 2){
                    $("span.status").text("已发货")
                    $("span.Pay").hide()
                    $("span.cancel").hide()
                }
                if(res.data.status == 3){
                    $("span.status").text("已签收")
                    $("span.Pay").hide()
                    $("span.cancel").hide()
                } 
            }
        },
        error:function(res){
            if(res.status == 401){
                location.href = "login.html"
            }
        }
    })


})