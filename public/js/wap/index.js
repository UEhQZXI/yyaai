mui('.mui-scroll-wrapper').scroll({
    indicators: false
});

mui(".mui-slider").slider({
    interval: 3000
});

if (!localStorage.getItem("token")) {
    $(".user").attr('href', '/login');
    $("#msShortcutMenu").on('click', function () {
        window.location.href = '/login';
    });
} else {
    $("#msShortcutMenu").on('click', function () {
        window.location.href = '/my';
    });
}

$(function() {
    //  为你推荐
    $.ajax({
        type: "GET",
        url: "http://47.100.3.125/api/store/products/user/new",
        success: function(res) {
            $("#new").html(template("tpl_new", {
                list: res.data
            }));
        }
    });

    // 每日精选
    $.ajax({
        type: "GET",
        url: "http://47.100.3.125/api/store/products/user/new?today=true",
        success: function(res) {
            $("#qianggou").html(template("today_r", {
                list: res.data
            }));
        }
    });

    $(".jd-header-search-input").on("tap",
        function() {
            location.href = "/good/search"
        });
});