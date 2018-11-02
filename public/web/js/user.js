
$(function(){

    //  判断是否登录
    var token = localStorage.getItem("token")
    var name = localStorage.getItem("name")
     if(token){
         $(".reg").text(name)
         location.href = "userInfo.html"
     }








})