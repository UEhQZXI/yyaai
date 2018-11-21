$(function(){
    if (!localStorage.getItem("token")) {
        window.location.href = '/login';
    }
    var name = localStorage.getItem("name");
    var avatar = localStorage.getItem("avatar");
    $(".userName span").text(name);
    $("#user-avatar").attr('src', avatar);
});