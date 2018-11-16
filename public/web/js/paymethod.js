
$(function(){
    
    var toke = localStorage.getItem("token")
    var price = tools.getSearch("price")
    var order = tools.getSearch("orderNum")
    $(".price").text(price + "元")
    $(".ft_price").text("支付" + price + "元")
    $(".alipy input").on("tap",function(){
        $(".wechat span.icon").hide()
        $(".wechat input").show()
        // $(this).hide()
        var ss = $(this).val()
        $(".ft_price").text(ss + price + "元")
        $(".alipy span.icon").show()
    })

    $(".wechat input").on("tap",function(){
        $(".alipy span.icon").hide()
        $(".alipy input").show()
        // $(this).hide()
        var s = $(this).val()
        $(".ft_price").text(s + price + "元")
        $(".wechat span").show()
    })
    
    $("body").on("change",".ck",function(){
        var num = $("input[type='radio']:checked").length;
    })
    
    

    $(".Ty_footer").on("touchstart",".ft_price",function(){
        var num = $("input[type='radio']:checked").length
        var val = $("input[type='radio']:checked").val()
        console.log(val)
        console.log(num)
        if(num == 0){
            mui.toast("请选择支付方式")
            return
        }
        if(val == "支付宝支付"){
            location.href = "http://47.100.3.125/api/store/pay/alipay/" + order +"?token=" + toke
        }else{
            location.href = "http://m.iyaa180.com/api/store/wechatpay/index?order_id="+ order + "&pay_device=wap"
        }
    })

})