
mui('.mui-scroll-wrapper').scroll({
    indicators:false
});

$(function(){
    var toke = localStorage.getItem("token")
    var typeId = tools.getSearch("type");
    var ids = localStorage.getItem("cartId")

    var total = localStorage.getItem("num")
    var pid = localStorage.getItem("productId")
    // 订单详情
    if(typeId == "cart"){
        $.ajax({
            type:"POST",
            url:"http://47.100.3.125/api/store/cart/count",
            headers: {
                'Authorization': `Bearer ` + toke,
            },
            data:{
                huangyingxuan:ids
            },
            success:function(res){
                // console.log(res)
                if(res.status_code == 200){
                    var price = res.data.total_price
                    $("#orderList").html(template("tpl_order",{list:res.data.cart}))
                    mui('.mui-scroll-wrapper').scroll({
                        indicators:false
                    });
                    $(".qian").text(price)
                }
            }
        })
    }else{
        $.ajax({
            type:"GET",
            url:"http://47.100.3.125/api/store/products/" + pid,
            headers: {
                'Authorization': `Bearer ` + toke,
            },
            data:{
                product_number:total
            },
            success:function(res){
                // console.log(res)
                if(res.status_code == 200){
                    var price = res.data.total_price
                    var direct = {
                        info:res.data
                    }
                    $(".goodDetail").html(template("tpl_direct",direct))
                    $(".qian").text(price)
                }
            }
        })
    }
    
    var addlength = []
    // 获取收货地址
    function getAddress(){
        $.ajax({
            url: 'http://47.100.3.125/api/store/address',
            headers: {
                'Authorization': `Bearer ` + toke,
            },
            type:"GET",
            success: function(res){
                // console.log(res);
                if(res.status_code == 200){
                  $(".address").html(template("tpl_address",{row:res.data}))
                  for(var i=0;i<res.data.length;i++){
                    //  console.log(res.data[i])
                     if(res.data[i].is_default == 1){
                         localStorage.setItem("address",res.data[i].id)
                     }
                  }
                }
                addlength.push(res.data)
            }
        })
    }
    getAddress()
    
    // 更新收货地址
    function update(){
        var id = tools.getSearch("id");
        console.log(id)
        $.ajax({
            Method:"GET",
            url:"http://47.100.3.125/api/store/address/"+ id,
            headers: {
                'Authorization': `Bearer ` + toke,
            },
            success:function(res){
                // console.log(res)
                if(res.status_code ==200){
                   $("span.per").text(res.data[0].user_name)
                   $("span.tel").text(res.data[0].user_phone)
                   $("span.areaThose").text(res.data[0].area1 + "-" + res.data[0].area2 + "-" + res.data[0].area3 + res.data[0].address)
                   localStorage.setItem("address",id)
                }
            }
        })
    }
    
    update()
   

    // 添加订单
    $(".sumbit").on("tap",function(){
        if(addlength == ""){
            mui.toast("请填写收货地址")
            return false
        }

        if(typeId == "cart"){
            var address_id = localStorage.getItem("address")
            $.ajax({
                type:"POST",
                url:"http://47.100.3.125/api/store/order",
                headers: {
                    'Authorization': `Bearer ` + toke,
                },
                data:{
                    type:typeId,
                    address_id:address_id,
                    cart_ids:ids
                },
                success:function(res){
                    // console.log(res)
                }
            })
        }else{
            var address_id = localStorage.getItem("address")
            var total = localStorage.getItem("num")
            var pid = localStorage.getItem("productId")
            $.ajax({
                type:"POST",
                url:"http://47.100.3.125/api/store/order",
                headers: {
                    'Authorization': `Bearer ` + toke,
                },
                data:{
                    type:"direct",
                    address_id:address_id,
                    num:total,
                    product_id:pid
                },
                success:function(res){
                    // console.log(res)
                }
            }) 
        }

        var shopId = localStorage.getItem("cartId")
        // 删除掉购物车中的商品
        $.ajax({
            type:"DELETE",
            url:"http://47.100.3.125/api/store/cart/" + shopId,
            headers: {
               'Authorization': `Bearer ` + toke,
           },
           success:function(res){
            //    console.log(res)
           }
        })
    })
})