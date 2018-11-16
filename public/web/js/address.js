
$(function(){

    var toke = localStorage.getItem("token")
    $.ajax({
      url: 'http://47.100.3.125/api/store/address',
      headers: {
          'Authorization': `Bearer ` + toke,
      },
      type:"GET",
      success: function(res){
          console.log(res.data);
          if(res.status_code == 200){
              $.each(res.data,function(i,v){
                  if(v.is_default == 1){
                      console.log(v)
                      console.log(i)
                      res.data.splice(i,1)
                      console.log(res.data)
                      res.data.unshift(v)
                      console.log(res.data)
                  }
              })
              $("#addList").html(template("tpl_add",{list:res.data}))       
          }
      }
    });

    $("#addList").on("tap",".addressLIst",function(){
            var areaId = $(this).data("id")
            var search = location.search;
                console.log(search)
                if (search.indexOf("retUrl") != -1) {
                  //说明需要回跳
                  search = search.replace("?retUrl=", "");
                  location.href = search + "?id=" + areaId
                }else{
                  
            }
       })
    
    $(".link").on("tap",function(){
        var search = location.search;
        if (search.indexOf("retUrl") != -1) {
            //说明需要回跳
            search = search.replace("?retUrl=", "");
            location.href = search
          }else{
            location.href = "userInfo.html"
        }
    })
})