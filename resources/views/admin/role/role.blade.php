<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="/admin/role/css/style.css" rel="stylesheet" type="text/css" media="all" />
<script src="/admin/role/js/jquery.min.js"></script>
<link href="/admin/role/css/font-awesome.css" rel="stylesheet">
</head>
<body>
	<div class="main">
		<canvas id="myCanvas"></canvas>
		<div class="agileinfo_404_main">
			<h1>^ 无权限 ^</h1>
			<div class="w3_agile_main">
				<h2>喔唷！你暂无此操作的权限</h2>
				<p>请联系后台超级管理员分配权限.</p>
				<div class="agile_404 w3layouts">
					<div class="agile_404_pos">
						<h3>么<span>么</span>哒<img src="/admin/role/images/1.png" alt=" " /> </h3>
					</div>
					<img src="/admin/role/images/3.png" alt=" " class="w3l"/>
				</div>
			</div>
			<div class="agileits_w3layouts_nav">
				<div class="w3_agileits_nav_left w3">
					<ul>
						<li><a href="/admin/index">首页</a></li>
						<li class='uppage'><a href="javascript:void(0)">返回上一页</a></li>
						<li><a href="https://iqiyi.com">看个电影</a></li>
						<li class='chaoguan'><a href="javascript:void(0)">联系超级管理员</a></li>
					</ul>
				</div>
				<div class="wthree_nav_right">
					<ul class="agileits_social_list w3ls">
						<li><a href="#" class="w3_agile_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<li><a href="#" class="agile_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
						<li><a href="#" class="w3_agile_dribble"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
						<li><a href="#" class="w3_agile_vimeo"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
					</ul>
				</div>
				<div class="clear"> </div>
			</div>
			<div class="agileits_copyright">
				<p>Copyright &copy; 2017.Company name All rights reserved.More Templates <a href="" target="_blank" title=""></a> - Collect from <a href="" title="" target="_blank"></a></p>
			</div>
		</div>
	</div>
	<script src="/admin/role/js/particles.min.js"></script>
    <script>
      window.onload = function() {
        Particles.init({
          selector: '#myCanvas',
          color: '#6b6b6b',
          connectParticles: true,
          minDistance: 100
        });
      };

      $('.uppage').click(function () {
      	history.go(-1)
      })

      $('.chaoguan').click(function () {
      	alert('集齐七颗龙珠召唤超级管理员');
      })
    </script>
</body>
</html>