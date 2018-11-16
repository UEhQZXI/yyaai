mui('.mui-scroll-wrapper').scroll({
    indicators:false
  });
  
  mui(".mui-slider").slider({
    interval: 3000
  });
  

  $(function(){
    //  为你推荐
     $.ajax({
       type:"GET",
       url:"http://47.100.3.125/api/store/products/user/new",
       success:function(res){
         console.log(res)
         $("#new").html(template("tpl_new",{list:res.data}))
       }
     });

     // 每日精选
     $.ajax({
      type:"GET",
      url:"http://47.100.3.125/api/store/products/user/new?today=true",
      success:function(res){
        console.log('------每日精选------');
        console.log(res)
        $("#qianggou").html(template("today_r",{list:res.data}))
      }
    })

    $(".jd-header-search-input").on("tap",function(){
        location.href = "search.html"
    })
  })