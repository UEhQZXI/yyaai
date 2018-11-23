
$(function(){

    var $token = localStorage.getItem("token");

    if (!$token) {
        $(".cart-null").show();
        localStorage.removeItem("name");
        localStorage.removeItem("token");
        return false;
    }

    var toke = localStorage.getItem("token");

    $.ajax({
        url: 'http://47.100.3.125/api/store/cart',
        headers: {
            'Authorization': `Bearer ` + toke,
        },
        method:"GET",
        success: function (res) {
            console.log(res);

                if(res.status_code == 200){
                    $("#goods-number").html("购物车("+res.data.cart.length+")");
                    document.getElementById("count-m").value = res.data.cart_total_price;
                    $("#cart-list").html(template("tpl_car",{list:res.data.cart}));
                    $("#cart-count").val(res.data.cart.length);
                }

        },
        error:function(res){
            console.log(res)
            if(res.status == 401){
                localStorage.removeItem("name")
                localStorage.removeItem("token")
                setTimeout(function(){
                    mui.toast("登录过期")
                    setTimeout(function(){
                        location.href = "/login?retUrl=/cart"
                    },1500)
                },1000)

                $(".user").on("tap",function(){
                    location.href = "/my"
                })
            }
        }
    });

    $("body").on("tap","#pays",function(){

        var money = $(".totalPrice .total").text();
        var _arr=[];
        console.log(money)
        if(money == 00){
            mui.toast("请选择商品")
        }else{
            $(":checked").each(function(){
                var id = $(this).data("id");
                _arr.push(id)
            });
             location.href = "/order/new?type=cart";

        }
        localStorage.setItem("cartId",_arr)
    })
});
var selectLength = 0;
var cartArray = [];
function touchstart(that, g)
{
    var e = event || window.event;
    startX = e.changedTouches[0].pageX, startY = e.changedTouches[0].pageY;
}

function touchmove(that, g)
{
    var e = event || window.event;
    // console.log(e);
    endX = e.changedTouches[0].pageX, endY = e.changedTouches[0].pageY;
    distanceX = endX-startX;
    distanceY = endY-startY;
    //判断滑动方向
    if(Math.abs(distanceX)>Math.abs(distanceY) && distanceX>0){
        document.getElementById("smooth-good-"+g).style.left = '0';
        document.getElementById("good-info-btn-text-"+g).innerText = "编辑";
        document.getElementById("flag-"+g).setAttribute('data-flag', 'false');
    }else if(Math.abs(distanceX)>Math.abs(distanceY) && distanceX<0){
        document.getElementById("smooth-good-"+g).style.left = '-1.5rem';
        document.getElementById("good-info-btn-text-"+g).innerText = "完成";
        document.getElementById("flag-"+g).setAttribute('data-flag', 'true');
    }
    // console.log(that);
}

function showDel(that, g)
{
    var n = g;
    var flag = that.getAttribute('data-flag');
    if (flag == "true") {
        document.getElementById("smooth-good-"+n).style.left = '0';
        document.getElementById("good-info-btn-text-"+n).innerText = "编辑";
        that.setAttribute('data-flag', 'false');
    }else{
        document.getElementById("smooth-good-"+n).style.left = '-1.5rem';
        document.getElementById("good-info-btn-text-"+n).innerText = "完成";
        that.setAttribute('data-flag', 'true');
    }
}

function changeNum(that)
{
    var toke = localStorage.getItem("token");
    var id = that.getAttribute('data-id');
    var flag = that.getAttribute('data-flag');
    var num = document.getElementById("gd-num-"+id).value;

    if (flag == 'add') {
        num++;
        document.getElementById("gd-num-"+id).value = num;
    }

    if (flag == 'sub') {
        if (num == 1) {
            num=1;
        } else {
            num--;
        }
        document.getElementById("gd-num-"+id).value = num;
    }

    if (flag == 'input') {
        num = document.getElementById("gd-num-"+id).value;
    }

    if (num == 0 || num == '') {
        num = 1;
        document.getElementById("gd-num-"+id).value = num;
    }

    $.ajax({
        type:"PATCH",
        url:"http://47.100.3.125/api/store/cart/" + id,
        headers: {
            'Authorization': `Bearer ` + toke,
        },
        data:{
            product_number:num
        },
        success:function(res){
            document.getElementById("count-m").value = res.data.cart_total_price;
            countM();
        },
        error:function(res){
            var res = JSON.parse(res.response);
            if(res.status_code == 422){
                if (res.message == 'The given data was invalid.') {
                    res.message = '无效的商品数量'
                }
                layer.open({
                     className:'change-num-layer'
                    ,content: res.message
                    ,style: 'background-color:#ffffff; color:#424242; border:none;font-size: 0.4rem;'
                    ,time: 2
                });
            }
        }
    });
}

function selectGood(that)
{
    var toke = localStorage.getItem("token");
    var id = that.getAttribute('data-id');
    var action = that.getAttribute('data-action');
    var allBtn = document.getElementById('select-all-btn');
    var cartLen = document.getElementById('cart-count').value;

    if (action == 'on') {
        that.firstElementChild.className = 'select-btn-off';
        that.setAttribute('data-action', 'off');
        selectLength--;
        document.getElementsByClassName('cart-sub-btn')[0].innerText = '结算('+selectLength+')';
        var index = cartArray.indexOf(id);
        if (index > -1) {
            cartArray.splice(index, 1);
        }
        countM();
    }

    if (action == 'off') {
        that.firstElementChild.className = 'select-btn-on';
        that.setAttribute('data-action', 'on');
        selectLength++;
        document.getElementsByClassName('cart-sub-btn')[0].innerText = '结算('+selectLength+')';
        cartArray.push(id);
        countM();
    }

    if (selectLength == cartLen) {
        allBtn.className = 'select-btn-on';
        document.getElementsByClassName('cart-footer-left1-left')[0].setAttribute('data-action', 'on');
        document.getElementById('gs').setAttribute('data-action', 'on');
        countM();
    } else {
        allBtn.className = 'select-btn-off';
        document.getElementsByClassName('cart-footer-left1-left')[0].setAttribute('data-action', 'off');
        document.getElementById('gs').setAttribute('data-action', 'off');
        countM();
    }
}

function selectAll(that)
{
    var action = that.getAttribute('data-action');
    var goods = document.getElementsByClassName('cart-good-box');
    var allBtn = document.getElementById('select-all-btn');
    var arr = [];
    if (action == 'on') {
        for (var i = 0; i < goods.length; i++) {
            goods[i].getElementsByClassName('good-select-btn')[0].firstElementChild.className = 'select-btn-off';
            goods[i].getElementsByClassName('good-select-btn')[0].setAttribute('data-action', 'off');
        }
        allBtn.className = 'select-btn-off';
        selectLength = 0;
        that.setAttribute('data-action', 'off');
        document.getElementsByClassName('cart-sub-btn')[0].innerText = '结算('+selectLength+')';
        cartArray = [];
        countM();
    }

    if (action == 'off') {
        for (var i = 0; i < goods.length; i++) {
            goods[i].getElementsByClassName('good-select-btn')[0].firstElementChild.className = 'select-btn-on';
            goods[i].getElementsByClassName('good-select-btn')[0].setAttribute('data-action', 'on');
            arr.push(goods[i].getElementsByClassName('good-select-btn')[0].getAttribute('data-id'));
        }
        allBtn.className = 'select-btn-on';
        selectLength = document.getElementById('cart-count').value;
        that.setAttribute('data-action', 'on');
        document.getElementsByClassName('cart-sub-btn')[0].innerText = '结算('+selectLength+')';
        cartArray = arr;
        countM();
    }
}

function delGood(that)
{
    var token = localStorage.getItem('token');
    var id = that.getAttribute('data-id');
    var cartLen = document.getElementById('cart-count').value;
    layer.open({
        className:'del-goods'
        ,content: '确定要删除这个商品吗？'
        ,btn: ['确定', '取消']
        ,yes: function(index2){
            $.ajax({
                type:"DELETE",
                url:"http://47.100.3.125/api/store/cart/" + id,
                headers: {
                    'Authorization': `Bearer ` + token,
                },
                success:function(res){
                    if(res.status_code == 200){
                        document.getElementById('cart-count').value = document.getElementById('cart-count').value -1;
                        var gs = document.getElementById('gs');
                        $("#goods-number").html("购物车("+res.data.cart.length+")");
                        if (gs.getAttribute('data-action') == 'on' && cartLen == 1) {
                            gs.setAttribute('data-action', 'off');
                            document.getElementById('select-all-btn').className = 'select-btn-off';
                            selectLength--;
                            document.getElementsByClassName('cart-sub-btn')[0].innerText = '结算('+selectLength+')';
                        }
                        if (document.getElementById('smooth-good-'+id).getElementsByClassName('good-select-btn')[0].getAttribute('data-action') == 'on') {
                            selectLength--;
                            document.getElementsByClassName('cart-sub-btn')[0].innerText = '结算('+selectLength+')';
                        }
                        var index = cartArray.indexOf(id);
                        if (index > -1) {
                            cartArray.splice(index, 1);
                        }
                        $('.sequence'+id).remove();
                        document.getElementById("count-m").value = res.data.cart_total_price;
                        countM();
                        layer.close(index2);
                    }
                },
                error:function(res){
                    console.log(res)
                    if(res.status == 422){
                        layer.open({
                            content: '操作异常，请稍后再试'
                            ,skin: 'msg'
                            ,anim: 'scale'
                            ,time: 2 //2秒后自动关闭
                        });
                    }
                }
            })
        }
    });
}

function countM()
{
    var count = document.getElementById('count-m').value;
    var count = count.split('.');
    var cartLen = document.getElementById('cart-count').value;
    if (selectLength == cartLen) {
        document.getElementById('first-money-num').innerText = count[0] + '.';
        document.getElementById('last-money-num').innerText = count[1];
    } else {
        if (cartArray.length == 0) {
            document.getElementById('first-money-num').innerText = '0.';
            document.getElementById('last-money-num').innerText = '00';
        } else {
            var m = 0.00;
            for (var i = 0; i < cartArray.length; i++) {
                var mn = parseFloat(document.getElementById('money-number-'+cartArray[i]).innerText);
                var number = document.getElementById('gd-num-'+cartArray[i]).value;
                m += (mn * number);
            }
            m = toDecimal(m).toString();
            console.log(m);
            var mc = m.split('.');
            document.getElementById('first-money-num').innerText = mc[0] + '.';
            document.getElementById('last-money-num').innerText = mc[1];
        }
    }
}

function subCart()
{
    if (selectLength < 1) {
        return false;
    }

    localStorage.setItem("cartId",cartArray);
    window.location.href = '/order/new?type=cart';

}

function toDecimal(x) {
    var f = parseFloat(x);
    if (isNaN(f)) {
        return false;
    }
    var f = Math.round(x*100)/100;
    var s = f.toString();
    var rs = s.indexOf('.');
    if (rs < 0) {
        rs = s.length;
        s += '.';
    }
    while (s.length <= rs + 2) {
        s += '0';
    }
    return s;
}