
$(function(){
    var name = localStorage.getItem("name")
    var avatar = localStorage.getItem("avatar")
    $(".userName span").text(name)
    $(".avatar").src(avatar)
})