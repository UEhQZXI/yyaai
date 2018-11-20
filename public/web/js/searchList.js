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
            console.log(res)
            if(res.status_code == 200){
                $(".loading").hide()
                $("#goodList").html(template("tpl_searchlist",{list:res.data.data}))
        }              
      }
    })
    
    $(".search_input").on("input",function(){
        var content = $(this).val()
        console.log(content)
        if(content.length !== 0){
            $("#close").show()
        }else{
            $("#close").hide()  
        }
    })
    $(".search_input").on("focus",function(){
        $("#close").show()
    })
    // 清空搜索内容
    $("#close").on("tap",function(){
       $(".search_input").val("")
       $(this).hide()
    })
})