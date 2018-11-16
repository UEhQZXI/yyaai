<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src='https://yk.eeboo.cn/js/jquery-1.8.3.js'></script>
	<script src='./js/qrcode.min.js'></script>
</head>
<body>
	<img src="./qrcode/3.png" alt="">
</body>
<script>
	var getObjectURL = function(file){
	    var url = null ; 
	    if (window.createObjectURL!=undefined) { // basic
	        url = window.createObjectURL(file) ;
	    } else if (window.URL!=undefined) { // mozilla(firefox)
	        url = window.URL.createObjectURL(file) ;
	    } else if (window.webkitURL!=undefined) { // webkit or chrome
	        url = window.webkitURL.createObjectURL(file) ;
	    }
    	return url ;
	}

	var ob = getObjectURL("./qrcode/3.png");
	console.log(ob)
</script>
</html>