$(function(){
    $(".conserve").on("tap",function(){
      
        // 判断默认地址是否选中
        if($(".mui-switch").hasClass("mui-active")){
            
            var is_default = 1;

            var username = $("#name").val()
            var tel = $("#password").val() 
            var area = $("#city").text()
            var  diqu = $("#address").val()
            var code = $("#code").val()

            if(!username){
                mui.toast("请输入姓名")
                return false
            }
            if(!tel){
                mui.toast("请输入手机号")
                return false
            }
            if(!area){
                mui.toast("请填写地址")
                return false
            }
            if(!area){
                mui.toast("请填写地址")
                return false
            }
            if(!/^1[34578]\d{9}$/.test(tel)){
                mui.toast("手机号码格式不对");
                return false;
            }
            console.log(area)
            console.log(diqu)
            var area0 = area.split("-")
            console.log(area0)
            var area1 = area0[0]
            console.log(area1)
            var area2 = area0[1]
            console.log(area1)
            var area3 = area0[2]
            console.log(area1)
            var toke = localStorage.getItem("token")
            $.ajax({
               method:"post",
               url:"http://47.100.3.125/api/store/address",
               headers: {
                'Authorization': `Bearer ` + toke,
              },
               data:{
                user_name:username,
                user_phone:tel,
                area1:area1,
                area2:area2,
                area3:area3,
                address:diqu,
                is_default:is_default
               },
               success:function(res){
                   console.log(res)
                   if(res.status_code == 200){
                    var search = location.search;
                    if (search.indexOf("retUrl") != -1) {
                      //说明需要回跳
                      search = search.replace("?retUrl=", "");
                      mui.toast("添加成功")
                      setTimeout(function(){
                        location.href = search;
                      },300)
                    }else{
                      mui.toast("添加成功")
                      setTimeout(function(){                      
                         location.href = "address.html"
                        },300)
                    }
                   }
               }
            })
        }else{
            var username = $("#name").val()
            var tel = $("#password").val() 
            var area = $("#city").text()
            var address = $("#address").val()
            var code = $("#code").val()
            
            if(!username){
                mui.toast("请输入姓名")
                return false
            }
            if(!tel){
                mui.toast("请输入手机号")
                return false
            }
            if(!area){
                mui.toast("请填写地址")
                return false
            }
            if(!area){
                mui.toast("请填写地址")
                return false
            }
            if(!/^1[34578]\d{9}$/.test(tel)){
                mui.toast("手机号码格式不对");
                return false;
            }
            console.log(area)
            console.log(address)
            var area0 = area.split("-")
            console.log(area0)
            var area1 = area0[0]
            console.log(area1)
            var area2 = area0[1]
            console.log(area1)
            var area3 = area0[2]
            console.log(area1)
            var toke = localStorage.getItem("token")
            console.log(toke)
            $.ajax({
               method:"post",
               url:"http://47.100.3.125/api/store/address",
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
                is_default:0
               },
               success:function(res){
                   console.log(res)
                    if(res.status_code == 200){
                        var search = location.search;
                        if (search.indexOf("retUrl") != -1) {
                          //说明需要回跳
                          search = search.replace("?retUrl=", "");
                          mui.toast("添加成功")
                          setTimeout(function(){
                            location.href = search;
                          },300)
                        }else{
                          mui.toast("添加成功")
                          setTimeout(function(){                      
                             location.href = "address.html"
                            },600)
                        }
                    }
               }
            })
        }
         
      
    })
   












})