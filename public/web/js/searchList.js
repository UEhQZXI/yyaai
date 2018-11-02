mui('.mui-scroll-wrapper').scroll({
    indicators:false
  });
  
  mui(".mui-slider").slider({
    interval: 1000
  });
$(function(){
 
    var id = tools.getSearch("id");
    console.log(id)
    var toke = localStorage.getItem("token")
     $.ajax({
         type:"get",
         url:"http://47.100.3.125/api/store/products?category_id=" + id,
         headers: {
            'Authorization': `Bearer ` + toke,
        },
         success:function(res){
             console.log(res)
             var list = res.data.data
             if(res.status_code == 200){
                 $("#goodList").html(template("tpl_list",{list}))
             }
         }
     })


})