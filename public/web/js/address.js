
$(function(){

    var toke = localStorage.getItem("token")
    console.log(toke)
    $.ajax({
      url: 'http://47.100.3.125/api/store/address',
      headers: {
          'Authorization': `Bearer ` + toke,
      },
      type:"GET",
      success: function(res){
          console.log(res);
          if(res.status_code == 200){
              $("#addList").html(template("tpl_add",{list:res.data}))
          }
      }
    });

    $("#addList").on("tap",".addressLIst",function(){
            var areaId = $(this).data("id")
        //  location.href = "createOrder.html?id=" + areaId

            var search = location.search;
                console.log(search)
                if (search.indexOf("retUrl") != -1) {
                  //说明需要回跳
                  search = search.replace("?retUrl=", "");
                  location.href = search + "?id=" + areaId
                }else{
                  
            }
    })
})