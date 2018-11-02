
mui('.mui-scroll-wrapper').scroll({
    indicators:false
  });
  
mui(".mui-slider").slider({
    interval: 1000
  })

  

$(function(){
    
    var id = tools.getSearch("id");
    localStorage.setItem("Pid",id)
    var toke = localStorage.getItem("token")
    $.ajax({
        type:"get",
        url:"http://47.100.3.125/api/store/products/" + id,
        headers: {
           'Authorization': `Bearer ` + toke,
       },
       success:function(res){
           console.log(res)
           var list={
                data:res.data
           }
           var picList = []
           var show = {
               row:res.data.linked[0]
           }
           var s = {
               id:1,
               picName:res.data.image1
            }
           var ss = {
               id:2,
               picName:res.data.image2
            }
            var sss = {
                id:3,
                picName:res.data.image3
             }
           picList.push(s)
           picList.push(ss)
           picList.push(sss)
           var list={
            data:res.data,
            pt:picList
           }
           console.log(list)
           if(res.status_code == 200){
              $(".mui-scroll").html(template("tpl_good",list))
            //   $(".showlist").html(template("tpl_show",show))
              $(".showlist").html(template("tpl_show",list))
              mui(".mui-slider").slider({
                interval: 1000
              })
           }
       }
    })

    $(".showlist").on("tap",".title",function(){
        $(this).addClass("now")
    })
    
    // 加入购物车
    $(".add_car").on("tap",function(){
        $(".showlist").toggle()
        $(".ying").toggle()
        mui(".mui-numbox").numbox()
    
    })
    $(".buy").on("tap",function(){
        $(".showlist").toggle()
        $(".ying").toggle()
        mui(".mui-numbox").numbox()
    
    })

    $("body").on("tap"," .mui-icon-closeempty",function(){
        $(".showlist").hide();
        $(".ying").hide()
        mui(".mui-numbox").numbox()
    })
    
    // 添加到购物车
    $("body").on("tap",".showlist .add_car",function(){
        if(!$("span.title").hasClass("now")){
            mui.toast("请选择商品")
            return false
        }
        var id = $("span.title").data("id")
        console.log(id)
        var num = mui(".mui-numbox").numbox().getValue()
        console.log(num)
        var toke = localStorage.getItem("token")
        $.ajax({
            type:"post",
            url:"http://47.100.3.125/api/store/cart",
            headers: {
                'Authorization': `Bearer ` + toke,
            },
            data:{
                product_id:id,
                product_number:num
            },
            success:function(res){
                console.log(res)
                if(res.status_code == 200){
                    mui.toast("添加成功")
                }
            },
            error:function(res){
                console.log(res)
                if(res.status == 401){
                    localStorage.removeItem("name")
                    localStorage.removeItem("token")
                   setTimeout(function(){
                    mui.toast("登录过期")
                    setTimeout(function(){
                        location.href = "login.html?retUrl=searchGood.html"
                    },1500)
                   },1000)
                                   
                }
            }
        })
    })

    // 立即购买
    $("body").on("tap",".showlist .buy",function(){
        if(!$("span.title").hasClass("now")){
            mui.toast("请选择商品")
            return false
        }
        var id = $("span.title").data("id")
        console.log(id)
        var total = mui(".mui-numbox").numbox().getValue()
        localStorage.setItem("num",total)
        localStorage.setItem("productId",id)
        console.log(total)
        setTimeout(function(){
            location.href = "createOrder.html"
        },200)
    })

})