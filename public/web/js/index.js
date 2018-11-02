mui('.mui-scroll-wrapper').scroll({
    indicators:false
  });
  
  mui(".mui-slider").slider({
    interval: 1000
  });
  

  $(function(){
      
    //  新手专享
     $.ajax({
       type:"GET",
       url:"http://47.100.3.125/api/store/products/user/new",
       success:function(res){
         console.log(res)
         $("#new").html(template("tpl_new",{list:res.data}))
       }
     })






  })