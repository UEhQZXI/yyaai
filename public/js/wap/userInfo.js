$(function(){
    if (!localStorage.getItem("token")) {
        window.location.href = '/login';
    } else {
        var token = localStorage.getItem("token");
        $.ajax({
            type: "GET",
            url: "http://47.100.3.125/api/user",
            headers: {
                'Authorization': `Bearer ` + token,
            },
            success: function(res) {
                if (res.status_code == 200) {
                    $(".userName span").text(res.data.name);
                    $("#user-avatar").attr('src', res.data.avatar);
                } else {
                    var name = localStorage.getItem("name");
                    var avatar = localStorage.getItem("avatar");
                    $(".userName span").text(name);
                    $("#user-avatar").attr('src', avatar);
                }
            }
        });
    }
});