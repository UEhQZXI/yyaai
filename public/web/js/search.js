
$(function(){
   
    // 设置缓存
    function getHistory(){
         var history = localStorage.getItem("Ty_search") || '[]';
         var arr = JSON.parse(history);
         return arr
    }
    
    // 渲染数据
    function render(){
        var arr = getHistory();
        $(".Ty_histotys").html(template("tpl",{arr:arr}))
    }

    render();
    

   

    //  清空搜索列表
    $(".Ty_histotys").on("click",".btn_empty",function(){
       
        mui.confirm("您是否要清空所有的历史记录？","温馨提示",["取消","确定"],function(e){
            if(e.index == 1){
                localStorage.removeItem("Ty_search")

                render()
            }
        })
    });



    // 删除单个记录
    $(".Ty_histotys").on("touchstart",".btn_delete",function(){
      
        var that = this;
        // mui.confirm("你确定要删除吗","温馨提示",["否","是"],function(e){
            // if(e.index == 1){
               var arr = getHistory();
               var index = $(that).data("index");
               arr.splice(index,1);
               localStorage.setItem("Ty_search",JSON.stringify(arr));
               render()
        //     }
        // })   
    });


 // 添加记录
 $(".sear").on("click",function(){
    // 获取关键字
    var key = $(".search_input").val().trim();
    console.log(key)
    $(".search_input").val("")
    if(key == ""){
        mui.toast("请输入")
        return false;
    }
    
    var arr = getHistory();

    // 重复的删掉
    var index = arr.indexOf(key);
    if(index != -1){
        arr.splice(index,1);
    }

    if(arr.length >=10){
        arr.pop();
    }

    arr.unshift(key);

    localStorage.setItem("Ty_search",JSON.stringify(arr));

    render()


    location.href = "searchList.html?key=" + key;

})


})