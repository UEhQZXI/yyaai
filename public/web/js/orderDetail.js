mui('.mui-scroll-wrapper').scroll({
    indicators:false
  });
  

$(function(){
    var toke = localStorage.getItem("token")
    var id = tools.getSearch("id")
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
                    $("span.Pay").show()
                    $("span.cancel").show()
               }
                if(res.data.status == 1){
                     $("span.status").text("光速发货中,请耐心等待")
                     $("span.see").show()
                }
                if(res.data.status == 2){
                    $("span.status").text("已发货")
                    $("span.see").show()
                }
                if(res.data.status == 3){
                    $("span.status").text("已签收")
                    $("span.see").show()
                } 
            }
        },
        error:function(res){
            if(res.status == 401){
                location.href = "login.html"
            }
        }
    })

    
  function isWeiXin(){

    var ua = window.navigator.userAgent.toLowerCase();

        if(ua.match(/MicroMessenger/i) == 'micromessenger'){

            return true;

        }else{

            return false;

        }

    }

    $("span.Pay").on("tap",function(){
        var orderId = $(".Orders").text()
        if(isWeiXin()){          
            $.ajax({
                type:"GET",
                url:"http://m.iyaa180.com/api/store/wechatpay/index",
                data:{
                    order_id:orderId
                },
                success:function(res){
                    console.log(res)
                }
            })
        }else{
            location.href = "http://47.100.3.125/api/store/pay/alipay/" + orderId +"?token=" + toke
        }
      
    })

})