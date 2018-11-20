
$(function(){
    
    var toke = localStorage.getItem("token")
    
    // 安卓下拉刷新不生效解决
    var h5pullDown = true;
  
    // 删除购物车商品
    $(".mui-scroll").on("tap",".btn_delete",function(){
      
         var id = $(this).data("id")   
         mui.confirm("您是否要删除商品？","温馨提示",["取消","确定"],function(e){
            if(e.index == 1){
                $.ajax({
                    type:"DELETE",
                    url:"http://47.100.3.125/api/store/cart/" + id,
                    headers: {
                       'Authorization': `Bearer ` + toke,
                   },
                   success:function(res){
                       console.log(res)
                       if(res.status_code == 200){
                           mui.toast("删除成功")
                           mui(".mui-scroll-wrapper").pullRefresh().pulldownLoading();
                          setTimeout(function(){
                            $(".ck").attr("checked", false);
                            $(".totalPrice .total").text("");
                          },800)
                       }
                   }
                })
            }
        })
    })

     //下拉刷新功能
    mui.init({

        //配置下拉刷新以及上拉加载
        pullRefresh: {
        container: ".mui-scroll-wrapper",
        down: {
            auto: true,
            //下拉刷新时触发
            callback: function () {
            //获取购物车的数据
            $.ajax({
                url: 'http://47.100.3.125/api/store/cart',
                headers: {
                    'Authorization': `Bearer ` + toke,
                },
                method:"GET",
                success: function (res) {
                    console.log(res);
                    setTimeout(function () {
                        if(res.status_code == 200){
                            $(".mui-scroll").html(template("tpl_car",{list:res.data.cart}))
                        }
                        //结束下拉刷新
                        mui(".mui-scroll-wrapper").pullRefresh().endPulldownToRefresh();
                    }, 1000);
                },
                error:function(res){
                    console.log(res)
                    if(res.status == 401){
                        localStorage.removeItem("name")
                        localStorage.removeItem("token")
                       setTimeout(function(){
                        mui.toast("登录过期")
                        setTimeout(function(){
                            location.href = "/login?retUrl=/cart"
                        },1500)
                       },1000)
                       
                       $(".user").on("tap",function(){
                           location.href = "/my"
                       })                   
                    }
                }
            });
            }
        }
      }

    });

    // 计算总金额
        $("body").on("change", ".ck", function () {
            //获取到选中的哪些checkbox
            var total = 0;
            
            var num = $("input[type='checkbox']:checked").length;
            $(".chooseNum").text("(" + num + ")")
            if(num==0){
                $(".chooseNum").text("")
            }

            $(":checked").each(function () {
              var price = $(this).data("price");
              var num = $(this).data("num");
              
              total += price * num;
            });
            
            $(".totalPrice .total").text(total.toFixed(2));
        });
    
     

    $("body").on("tap","#pays",function(){
       
        var money = $(".totalPrice .total").text();
        var _arr=[];
        console.log(money)
        if(money == 00){
            mui.toast("请选择商品")
        }else{
            $(":checked").each(function(){
                var id = $(this).data("id");
                _arr.push(id)           
            });
             location.href = "/order/new?type=cart";
      
        }
        localStorage.setItem("cartId",_arr)
    })
    
    
    $("body").on("tap",".btn_edit",function(){
        var id = $(this).data("id")
        localStorage.setItem("cartID",id)
        mui(".mui-numbox").numbox()
        var mask = mui.createMask
        $(".revise").show();
        $(".mui-backdrop").show()
        
    })
    
    // 确认
    $("body").on("tap",".confirm",function(){
        var id = localStorage.getItem("cartID")
        var ss = mui(".mui-numbox").numbox().getValue()
        $.ajax({
            type:"PATCH",
            url:"http://47.100.3.125/api/store/cart/" + id,
            headers: {
                'Authorization': `Bearer ` + toke,
            },
            data:{
                product_number:ss
            },
            success:function(res){
                console.log(res)
                if(res.status_code == 200){
                    setTimeout(function(){
                      mui.toast("修改成功")
                      $(".revise").hide();
                      $(".mui-backdrop").hide()
                      mui(".mui-scroll-wrapper").pullRefresh().pulldownLoading();
                      mui(".mui-numbox").numbox()
                    },300)
                }
            },
            error:function(res){
                console.log(res)
                if(res.status == 422){
                    mui.toast(res.data.message)
                }
            }
        })
    })

    // 取消
    $("body").on("tap",".cancel",function(){
        $(".revise").hide();
        $(".mui-backdrop").hide()
        localStorage.removeItem("cartID")
    })


})