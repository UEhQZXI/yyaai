mui('.mui-scroll-wrapper').scroll({
    indicators:false
  });
  
  mui(".mui-slider").slider({
    interval: 1000
  });


    $(function(){
        var key = tools.getSearch("key")
        $(".search_input").val(key)
        
        $.ajax({
            type:"get",
            url:"http://47.100.3.125/api/store/products/",
            data:{
                key:key
            },
            success:function(res){
                console.log(res.data.data)
                $("#goodList").html(template("tpl_searchlist",{list:res.data.data}))
            }
        })
 

    })