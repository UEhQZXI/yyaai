
$(function(){

   $(".loginOut").on("tap",function(){
        mui.confirm("确认退出",function(e){
            console.log(e)
            if(e.index == 1){
               location.href = "/my/needLogin"
               localStorage.removeItem("token")
               localStorage.removeItem("name")
            }
        })
   })


})