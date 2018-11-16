

mui('.mui-scroll-wrapper').scroll({
    indicators:false
  });
  
$(function(){
    
    // 渲染一级分类
    $.ajax({
        url:"http://47.100.3.125/api/store/categorie",
        type:"get",
        success:function(res){
           console.log(res)
           $(".Ty_category_l .mui-scroll").html(template("tpl_l",{list:res.data}))
           renderSecond(res.data[0].id);
       }
    })
    
    // 二级分类
    function renderSecond(id){
       
        $.ajax({
           type:"get",
           url:"http://47.100.3.125/api/store/categorie",
           data:{
               pid:id
           },
           success:function(res){
               console.log(res)
               $(".Ty_category_r .mui-scroll").html(template("tpl_r", {row:res.data}));
           }

        })
   
    }

    // 一级分类点击事件
    $(".Ty_category_l .mui-scroll").on("tap", "li", function () {

        $(this).addClass("now").siblings().removeClass("now");
    
        var id = $(this).data("id");
        renderSecond(id);
    
        mui('.mui-scroll-wrapper').scroll()[1].scrollTo(0,0,500);//100毫秒滚动到顶2
    
      });



})