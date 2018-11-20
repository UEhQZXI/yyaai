mui('.mui-scroll-wrapper').scroll({
	deceleration: 0.0005 //flick 减速系数，系数越大，滚动速度越慢，滚动距离越小，默认值0.0006
});

$(function(){

   var toke = localStorage.getItem("token")


   $(".orderList .one").on("tap",function(){
    $(this).addClass("now").siblings().removeClass("now")
    $(".all").show().siblings().hide()
    $(".orange").css("left","0.7rem")
    all()
   })
   $(".orderList .two").on("tap",function(){
    $(this).addClass("now").siblings().removeClass("now")
    $(".payment").show().siblings().hide()
    $(".orange").css("left","2.75rem")
    pay()
  })
  $(".orderList .three").on("tap",function(){
    $(this).addClass("now").siblings().removeClass("now")
    $(".delivery_good").show().siblings().hide()
    $(".orange").css("left","4.8rem")
    delivery()
  })
  $(".orderList .four").on("tap",function(){
    $(this).addClass("now").siblings().removeClass("now")
    $(".collect").show().siblings().hide()
    $(".orange").css("left","6.7rem")
    takedelivery()
  })
  $(".orderList .five").on("tap",function(){
    $(this).addClass("now").siblings().removeClass("now")
    $(".evaluate").show().siblings().hide()
    $(".orange").css("left","8.7rem")
    evaluate()
  })

  
  // 获取地址栏参数

  var id = tools.getSearch("id")
  
  if(id == 0){

     all()
  }

  if(id == 1){
     $(".orderList .two").addClass("now").siblings().removeClass("now")
     $(".orange").css("left","0.8rem")
     $(".payment").show().siblings().hide()

     pay() 
  }
  
  if(id == 2){
    $(".orderList .three").addClass("now").siblings().removeClass("now")
    $(".orange").css("left","175px")
    $(".delivery_good").show().siblings().hide()
    
    delivery()
  }

  if(id == 3){
    $(".orderList .four").addClass("now").siblings().removeClass("now")
    $(".orange").css("left","250px")
    $(".collect").show().siblings().hide()

    takedelivery()
  }

  if(id == 4){
    $(".orderList .five").addClass("now").siblings().removeClass("now")
    $(".orange").css("left","325px")
    $(".evaluate").show().siblings().hide()

    evaluate()
  }
  
  // 全部
  function all(){
      $(".loading").show()
      $.ajax({
        url: 'http://47.100.3.125/api/store/user/orders',
        headers: {
            'Authorization': `Bearer ` + toke,
        },
        method: 'GET',
        success: function(res){
            console.log(res);
            if(res.status_code == 200){
              $(".all").html(template("tpl_all",{allList:res.data.data}))
            setTimeout(function(){
              $(".loading").hide()
            },300)
            }
        },
        error:function(res){
          console.log(res)
          if(res.status == 401){
          setTimeout(function(){
            mui.toast("登录过期")
            setTimeout(function(){
              location.href = "/login"
            },800)
          },800)
          }
        }
      });
  }
  all()
  // 待付款
  function pay(){
    $(".loading").show()
    var toke = localStorage.getItem("token")
    $.ajax({
      url: 'http://47.100.3.125/api/store/user/orders',
      headers: {
          'Authorization': `Bearer ` + toke,
      },
      data:{
        status:0
      },
      method: 'GET',
      success: function(res){
          console.log(res);
          if(res.status_code == 200){
            $(".payment").html(template("tpl_payment",{list:res.data.data}))
           setTimeout(function(){
            $(".loading").hide()
           },300)
          }
      },
      error:function(res){
        console.log(res)
        if(res.status == 401){
         setTimeout(function(){
           mui.toast("登录过期")
           setTimeout(function(){
            location.href = "/login"
           },800)
         },800)
        }
      }
    });
  
  }

  // 待发货
  function delivery(){
      $(".loading").show()
        $.ajax({
          url: 'http://47.100.3.125/api/store/user/orders',
          headers: {
              'Authorization': `Bearer ` + toke,
          },
          data:{
            status:1
          },
          method: 'GET',
          success: function(res){
              console.log(res);
            if(res.status_code == 200){
                $(".delivery_good").html(template("tpl_delivery_good",{row:res.data.data}))
                setTimeout(function(){
                  $(".loading").hide()
                },300)
            }
          },
          error:function(res){
            console.log(res)
            if(res.status == 401){
            setTimeout(function(){
              mui.toast("登录过期")
              setTimeout(function(){
                location.href = "/login"
              },800)
            },800)
            }
          }
        });
  }

  // 待收货
  function  takedelivery(){
    $(".loading").show()
      $.ajax({
        url: 'http://47.100.3.125/api/store/user/orders',
        headers: {
            'Authorization': `Bearer ` + toke,
        },
        data:{
          status:2
        },
        method: 'GET',
        success: function(res){
            console.log(res);
          if(res.status_code == 200){
              $(".collect").html(template("tpl_collect",{info:res.data.data}))
              setTimeout(function(){
                $(".loading").hide()
              },300)
          }
        },
        error:function(res){
          console.log(res)
          if(res.status == 401){
          setTimeout(function(){
            mui.toast("登录过期")
            setTimeout(function(){
              location.href = "/login"
            },800)
          },800)
          }
        }
      });
  }

  // 待评价
  function evaluate(){
    $(".loading").show()
      $.ajax({
        url: 'http://47.100.3.125/api/store/user/orders',
        headers: {
            'Authorization': `Bearer ` + toke,
        },
        data:{
          status:3
        },
        method: 'GET',
        success: function(res){
            console.log(res);
          if(res.status_code == 200){
              $(".evaluate").html(template("tpl_evaluate",{elist:res.data.data}))
              setTimeout(function(){
                $(".loading").hide()
              },300)
          }
        },
        error:function(res){
          console.log(res)
          if(res.status == 401){
          setTimeout(function(){
            mui.toast("登录过期")
            setTimeout(function(){
              location.href = "/login?retUrl=/my/orders"
            },800)
          },800)
          }
        }
      });
  }

  
  // 取消订单
  $("body").on("tap",".delete",function(){
    var id = $(this).data("id")
    var toke = localStorage.getItem("token")
    console.log(id)
    // mui.confirm("你确定删除吗",function(e){
    //     console.log(e)
    // })
    $.ajax({
      type:"patch",
      url:"http://47.100.3.125/api/store/order/" + id,
      headers: {
        'Authorization': `Bearer ` + toke,
      },
      data:{
        status:5
      },
      success:function(res){
        console.log(res)
      }
    })
  })


  $("body").on("tap",".content",function(){
    var id = $(this).data("id")
      location.href = "/order/detail?id=" + id
  })

})