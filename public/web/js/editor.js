
$(function(){
   
    var id = tools.getSearch("id");
    console.log(id)
    var toke = localStorage.getItem("token")
    console.log(toke)
    $.ajax({
        Method:"GET",
        url:"http://47.100.3.125/api/store/address/"+ id,
        headers: {
            'Authorization': `Bearer ` + toke,
        },
        success:function(res){
            console.log(res)
            if(res.status_code ==200){
                $("#name").text(res.data[0].user_name)
                $("#city").text(res.data[0].area1 + "-" + res.data[0].area2 + "-" + res.data[0].area3)
                $("#tel").text(res.data[0].user_phone)
                $("#addres").text(res.data[0].address)
            }
        }
    })

    // 删除收货地址
    $(".top p").on("tap",function(){
        
        mui.confirm("您是否要删除地址？","温馨提示",["取消","确定"],function(e){
            if(e.index == 1){
                $.ajax({
                    type:"delete",
                    url:"http://47.100.3.125/api/store/address/" + id,
                    headers: {
                        'Authorization': `Bearer ` + toke,
                    },
                    success:function(res){
                        console.log(res)
                        if(res.status_code ==200){
                            setTimeout(function(){
                                mui.toast("删除成功")
                                location.href = "address.html" 
                            },300)
                        }
                    }
                })
            }
        })
      
    })

    // 编辑更新收货地址
    $(".baocun").on("tap",function(){
        
        var username = $("#name").text()
        var tel = $("#tel").val() 
        var area = $("#city").text()
        var address = $("#addres").val()

        var add = area.split("-")
        console.log(add)
        var area1 = add[0]
        var area2 = add[1]
        var area3 = add[2]
        if($(".mui-switch").hasClass("mui-active")){
           
            var is_default = 1;
            $.ajax({
                method:"patch",
                url:"http://47.100.3.125/api/store/address/" + id,
                headers: {
                 'Authorization': `Bearer ` + toke,
               },
                data:{
                 user_name:username,
                 user_phone:tel,
                 area1:area1,
                 area2:area2,
                 area3:area3,
                 address:address,
                 is_default:is_default
                },
                success:function(res){
                    console.log(res)
                    if(res.status_code == 200){                      
                          mui.toast("修改成功")
                        setTimeout(function(){
                            location.href = "address.html"
                        },500)
                    }
                }
            })
        }
    })
})