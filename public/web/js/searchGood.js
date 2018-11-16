
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

    function show(){
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
                if(res.data.image2){
                    var ss = {
                        id:2,
                        picName:res.data.image2
                     }
                }
                if(res.data.image3){
                    var sss = {
                        id:3,
                        picName:res.data.image3
                    }
                }
                if(res.data.image4){
                var aa = {
                    id:4,
                    picName:res.data.image4
                }
                }
                if(res.data.image5){
                var bb = {
                    id:5,
                    picName:res.data.image5
                }
                }
               picList.push(s)
            //    picList.push(ss)
            //    picList.push(sss)
               if(res.data.image2){
                 picList.push(ss)
              }
               if(res.data.image3){
                 picList.push(sss)
              }
               if(res.data.image4){
                 picList.push(aa)
               }
               if(res.data.image5){
                 picList.push(bb)
               }                    
               var list={
                data:res.data,
                pt:picList
               }
               console.log(list)
            //    console.log(list.data)
               if(res.status_code == 200){
                  $(".mui-scroll").html(template("tpl_good",list))
                  $(".showlist").html(template("tpl_show",list))
                  mui(".mui-slider").slider({
                    interval: 1000
                  })
               }
           }
        })
    }
    show()

    var flag = false;

    $(".showlist").on("tap",".title",function(){
        $(this).addClass("now")
    })
    
    // 加入购物车
    $(".add_car").on("tap",function(){
        // $(".showlist").toggle()
        $(".showlist").css('bottom', '0px');
        $(".showlist").css('opacity', '1');
        $(".ying").toggle()
        mui(".mui-numbox").numbox()
        flag = true;
    
    })
    $(".buy").on("tap",function(){
        // $(".showlist").toggle()
        $(".showlist").css('bottom', '0px');
        $(".showlist").css('opacity', '1');
        $(".ying").toggle()
        mui(".mui-numbox").numbox()
        flag = true;
    })

    $("body").on("tap"," .mui-icon-closeempty",function(){
        // $(".showlist").hide();
        $(".ying").hide()
        mui(".mui-numbox").numbox()
        show()
        $(".showlist").css('bottom', '-1000px');
        $(".showlist").css('opacity', '0');
        flag = false;
        // var timer = setInterval(function () {
        //     var bottom = parseInt($(".showlist").css('bottom'));
        //     if (bottom == -1000) {
        //         clearTimeout(timer);
        //         $(".showlist").css('display', 'none');
        //     }
        // });
    })
    
    $("body").on("tap",".title",function(){
        $(this).addClass("now").siblings().removeClass("now")
        var src = $(this).data("src")
        var price = $(this).data("price")
        var invent = $(this).data("inventory")
        $("#showImg").attr("src",src);
        $("#price").text("价格:" + price)
        $("#invent").text("库存:" + invent)
    })
    // 添加到购物车
    $("body").on("tap",".showlist .add_car",function(){
        if (flag) {
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
            });
        } else {
            // $(".showlist").toggle()
            $(".showlist").css('bottom', '0px');
            $(".showlist").css('opacity', '1');
            $(".ying").toggle()
            mui(".mui-numbox").numbox()
            flag = true;
        }
       
    });

    // 立即购买
    $("body").on("tap",".showlist .buy",function(){
        if (flag) {
            if(!$("span.title").hasClass("now")){
                mui.toast("请选择商品")
                return false
            }
            var id = $("span.title").data("id")
            var total = mui(".mui-numbox").numbox().getValue()
            localStorage.setItem("num",total)
            localStorage.setItem("productId",id)
            if(!toke){
                setTimeout(function(){
                  mui.toast("您尚未登录")
                  setTimeout(function(){
                    location.href = "login.html?retUrl=searchGood.html"
                  },800)
                },300)
            }else{
                setTimeout(function(){
                    location.href = "createOrder.html"
                },200)
            }
        } else {
            // $(".showlist").toggle()
            $(".showlist").css('bottom', '0px');
            $(".showlist").css('opacity', '1');
            $(".ying").toggle()
            mui(".mui-numbox").numbox()
            flag = true;
        }
        
       
    });

    // 分享
    $("#shares").on("tap",function(){
         $(".share").show()
    })
    $(".shareChose").on("tap",function(){
         $(".choose").show()
         $(".share").hide()
         $(".ying").show()
    })

    $(".Ty_main").on("tap",function(){
        $(".share").hide()
    })

    $(".ying").on("tap",function(){
        $(".choose").hide()
        $(this).hide()
        $(".showlist").css('bottom', '-1000px');
        $(".showlist").css('opacity', '0');
        flag = false;
        // var timer = setInterval(function () {
        //     var bottom = parseInt($(".showlist").css('bottom'));
        //     if (bottom == -1000) {
        //         clearTimeout(timer);
        //         $(".showlist").css('display', 'none');
        //     }
        // });
        
    })

})