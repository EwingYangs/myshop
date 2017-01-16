<?php if (!defined('THINK_PATH')) exit();?><!-- 页头 -->
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="keywords" content="<?php echo $_page_keywords?>" />
	<meta name="description" content="<?php echo $_page_description?>" />
    <title><?php echo $_page_title;?></title>
    <link rel="stylesheet" href="/Public/Home/css/base.css" type="text/css">
	<link rel="stylesheet" href="/Public/Home/css/global.css" type="text/css">
	<link rel="stylesheet" href="/Public/Home/css/header.css" type="text/css">
	<link rel="stylesheet" href="/Public/Home/css/bottomnav.css" type="text/css">
	<link rel="stylesheet" href="/Public/Home/css/footer.css" type="text/css">
    <script type="text/javascript" src="/Public/Home/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="/Public/Home/js/header.js"></script>
</head>
<body>
    <!-- 顶部导航 start -->
	<div class="topnav">
		<div class="topnav_bd w1210 bc">
			<div class="topnav_left">
				
			</div>
			<div class="topnav_right fr">
				<ul>
					<li id="user_info">
	
					</li>
					
					<li class="line">|</li>
					<li><a href="<?php echo U('My/order')?>">我的订单</a></li>
					<li class="line">|</li>
					<li>客户服务</li>

				</ul>
			</div>
		</div>
	</div>
	<!-- 顶部导航 end -->

    <!-- bannerBar  B-->
    <div class="bannerBar">
        <div class="banner w pr" align="center">
            <a href="#">
                <img id="banner" src="/Public/Home/images/banner.jpg" alt=""/>
            </a>
            <span class="close"></span>
        </div>
    </div>
    <!-- bannerBar  E-->


<link rel="stylesheet" href="/Public/Home/css/success.css" type="text/css">
	
	<!-- 页面头部 start -->
	<div class="header w990 bc mt15">
		<div class="logo w990">
			<h2 class="fl"><a href="/"><img id="1" src="/Public/Home/images/logo.png" alt="京东商城"></a></h2>
			<div class="flow fr flow3">
				<ul>
					<li>1.我的购物车</li>
					<li>2.填写核对订单信息</li>
					<li class="cur">3.成功提交订单</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- 页面头部 end -->
	
	<div style="clear:both;"></div>

	<!-- 主体部分 start -->
	<div class="success w990 bc mt15">
		<div class="success_hd">
			<h2>订单提交成功</h2>
		</div>
		<div class="success_bd">
			<p><span></span>订单提交成功，我们将及时为您处理</p>
			<p><?php echo $btn;?><p>
			<p class="message">完成支付后，你可以 <a href="">查看订单状态</a>  <a href="">继续购物</a> <a href="">问题反馈</a></p>
		</div>
	</div>
	<!-- 主体部分 end -->
<style>
.btn
{
  line-height:30px;
  height:30px;
  width:100px;
  color:#ffffff;
  background-color:#ededed;
  font-size:15px;
  font-weight:bold;
  font-family:Arial;
  background:-webkit-gradient(linear, left top, left bottom, color-start(0.05, #f24537), color-stop(1, #c62d1f));
  background:-moz-linear-gradient(top, #f24537 5%, #c62d1f 100%);
  background:-o-linear-gradient(top, #f24537 5%, #c62d1f 100%);
  background:-ms-linear-gradient(top, #f24537 5%, #c62d1f 100%);
  background:linear-gradient(to bottom, #f24537 5%, #c62d1f 100%);
  background:-webkit-linear-gradient(top, #f24537 5%, #c62d1f 100%);
  filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f24537', endColorstr='#c62d1f',GradientType=0);
  border:1px solid #d02718;
  -webkit-border-top-left-radius:6px;
  -moz-border-radius-topleft:6px;
  border-top-left-radius:6px;
  -webkit-border-top-right-radius:6px;
  -moz-border-radius-topright:6px;
  border-top-right-radius:6px;
  -webkit-border-bottom-left-radius:6px;
  -moz-border-radius-bottomleft:6px;
  border-bottom-left-radius:6px;
  -webkit-border-bottom-right-radius:6px;
  -moz-border-radius-bottomright:6px;
  border-bottom-right-radius:6px;
  -moz-box-shadow: inset 0px 1px 0px 0px #f5978e;
  -webkit-box-shadow: inset 0px 1px 0px 0px #f5978e;
  box-shadow: inset 0px 1px 0px 0px #f5978e;
  text-align:center;
  display:inline-block;
  text-decoration:none;
}
.btn:hover{
  background-color:#f5f5f5;
  background:-webkit-gradient(linear, left top, left bottom, color-start(0.05, #c62d1f), color-stop(1, #f24537));
  background:-moz-linear-gradient(top, #c62d1f 5%, #f24537 100%);
  background:-o-linear-gradient(top, #c62d1f 5%, #f24537 100%);
  background:-ms-linear-gradient(top, #c62d1f 5%, #f24537 100%);
  background:linear-gradient(to bottom, #c62d1f 5%, #f24537 100%);
  background:-webkit-linear-gradient(top, #c62d1f 5%, #f24537 100%);
  filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#c62d1f', endColorstr='#f24537',GradientType=0);
}
</style>




<!-- 页脚 -->


   <div style="clear:both;"></div>
	<!-- 底部版权 start -->
	<div class="footer w1210 bc mt10">
		<p class="links">
			<a href="">关于我们</a> |
			<a href="">联系我们</a> |
			<a href="">人才招聘</a> |
			<a href="">商家入驻</a> |
			<a href="">千寻网</a> |
			<a href="">奢侈品网</a> |
			<a href="">广告服务</a> |
			<a href="">移动终端</a> |
			<a href="">友情链接</a> |
			<a href="">销售联盟</a> |
			<a href="">京东论坛</a>
		</p>
		<p class="copyright">
			 © 2005-2013 京东网上商城 版权所有，并保留所有权利。  ICP备案证书号:京ICP证070359号 
		</p>
		<p class="auth">
			<a href="#"><img id="png" src="/Public/Home/images/auth2.png" alt=""/></a>
			<a href="#"><img id="png" src="/Public/Home/images/auth3.jpg" alt=""/></a>
			<a href="#"><img id="png" src="/Public/Home/images/auth4.png" alt=""/></a> 
			<a href="#"><img id="png" src="/Public/Home/images/auth5.jpg" alt=""/></a> 
			<a href="#"><img id="png" src="/Public/Home/images/auth6.jpg" alt=""/></a> 
			<a href="#"><img id="png" src="/Public/Home/images/auth1.png" alt=""/></a>
		</p>
	</div>
	<!-- 底部版权 end -->

	<script type="text/javascript">
		document.execCommand("BackgroundImageCache", false, true);
	</script>
</body>
</html>
</body>
</html>
<script>
	$.ajax({
		type : 'get',
		dataType : 'json',
		url : "<?php echo U('Member/ajaxConfirm')?>",
		success : function(data){
			if(data.login == 1){
				var html = '你好！'+data.username+' [<a href="<?php echo U('Member/logout')?>">退出</a>]';
			}else{
				var html = '您好，欢迎来到京东！[<a href="<?php echo U('Member/login')?>">登录</a>] [<a href="<?php echo U('Member/register')?>">免费注册</a>]'; 
			}
			$('#user_info').html(html);
		}
		
	});
</script>