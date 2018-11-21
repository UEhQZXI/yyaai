if (!localStorage.getItem("token")) {
    $(".user").attr('href', '/login');
}

var pathname = window.location.pathname;
switch (pathname) {
    case '/':
        $('.shouye').addClass('now');
        break;
    case '/category':
        $('.fenlei').addClass('now');
        break;
    case '/cart':
        $('.gouwuche').addClass('now');
        break;
    case '/my':
        $('.wode').addClass('now');
        break;
}
var tools = {
    getSearchObj:function () {
        //获取地址栏参数,封装成一个对象 
        var search = location.search;
        //对search字符串进行解码
        search = decodeURI(search);
        //去除
        search = search.slice(1);
        //把search切割成一个数组   
        var arr = search.split("&");
        var obj = {};
        //遍历数组
        arr.forEach(function ( v ) {
          var key = v.split("=")[0];
          var value = v.split("=")[1];
          obj[key] = value;
        });
        return obj;
      },
      getSearch: function(key){
        return this.getSearchObj()[key];
      }
}

$(function(){
    
  // function is_browser(){
  //   var ua = navigator.userAgent.toLowerCase();
  //   console.log(ua)
  //   if(ua.match(/MicroMessenger/i)=="micromessenger") {
  //       return true;//微信打开
  //   }else if(ua.match(/qq/i)=="qq"){
  //       return true;//QQ打开
  //   }else if(ua.match(/aliapp/i)=="aliapp"){
  //       return true;//支付宝打开 aliapp
  //   }else{
  //       return false;
  //   }
  // }
   
  // is_browser()

  function isWeiXin(){

    var ua = window.navigator.userAgent.toLowerCase();

    if(ua.match(/MicroMessenger/i) == 'micromessenger'){

        return true;

    }else{

        return false;

    }

}


// if(isWeiXin()){

// alert(1);

// }else{

// alert(2);

// }



})