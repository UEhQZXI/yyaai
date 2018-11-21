$(function(){
    if (!localStorage.getItem("token")) {
        window.location.href = 'my/needLogin';
    }
    var name = localStorage.getItem("name");
    var avatar = localStorage.getItem("avatar");
    $(".userName span").text(name);
    $(".avatar").src(avatar);
});