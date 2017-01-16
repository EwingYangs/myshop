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


<link rel="stylesheet" href="/Public/Home/css/cart.css" type="text/css">
	<script type="text/javascript" src="/Public/Home/js/cart1.js"></script>
	<div style="clear:both;"></div>
	
	<!-- 页面头部 start -->
	<div class="header w990 bc mt15">
		<div class="logo w990">
			<h2 class="fl"><a href="/"><img id="1" src="/Public/Home/images/logo.png" alt="京西商城"></a></h2>
			<div class="flow fr">
				<ul>
					<li class="cur">1.我的购物车</li>
					<li>2.填写核对订单信息</li>
					<li>3.成功提交订单</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- 页面头部 end -->
	
	<div style="clear:both;"></div>

	<!-- 主体部分 start -->
	<div class="mycart w990 mt10 bc">
		<h2><span>我的购物车</span></h2>
		<form method="post" action="<?php echo U('Order/add'); ?>">
		<table>
			<thead>
				<tr>
					<th class="col1">商品名称</th>
					<th class="col2">商品信息</th>
					<th class="col3">单价</th>
					<th class="col4">数量</th>	
					<th class="col5">小计</th>
					<th class="col6">操作</th>
				</tr>
			</thead>
			<tbody>
			<?php $total = 0;?>
			<?php foreach($data as $k=>$v){?>
				<tr>
					<td class="col1">
					<a href="<?php echo U('Index/goods?id='.$v['goods_id'])?>"><?php showImage($v['mid_logo'])?></a>  
					<strong><a href=""><?php echo $v['goods_name']?></a></strong>
					</td>
					<td class="col2">
					 <?php foreach($v['gaData'] as $k1=>$v1){?>
					<p><?php echo $v1['attr_name']?>：<?php echo $v1['attr_value']?></p> 
					<?php }?>
					</td>
					<td class="col3">￥<span><?php echo $v['price']?></span></td>
					<td class="col4"> 
						<a href="javascript:;" class="reduce_num"></a>
						<input type="text" name="goods_number[]" value="<?php echo $v['goods_number']?>" class="amount"/>
						<input type="hidden" name="id[]" value="<?php echo $v['id']?>"/>
						<input type="hidden" name="goods_id[]" value="<?php echo $v['goods_id']?>"/>
						<input type="hidden" name="ac" value="number"/>
						<a href="javascript:;" class="add_num"></a>
					</td>
					<td class="col5">￥<span><?php $total += $v['price']*$v['goods_number']; echo sprintf("%.2f", $v['price']*$v['goods_number'])?></span></td>
					<td class="col6" id="<?php echo $v['id']?>"><a onclick="delete_cart(<?php echo $v['id']?>)" href="javascript:void(0)">删除</a></td>
				</tr>
			<?php }?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="6">购物金额总计： <strong>￥ <span id="total"><?php echo sprintf("%.2f", $total);?></span></strong></td>
				</tr>
			</tfoot>
		</table>
		
		<div class="cart_btn w990 bc mt10">
			<a href="/" class="continue">继续购物</a>
			<!-- <a href="<?php echo U('Order/add'); ?>" class="checkout">结 算</a> -->
			<input type="submit" class="checkout" value="结算">
		</div>
		</form>
	</div>
	<!-- 主体部分 end -->

	<div style="clear:both;"></div>
	<script>
		function delete_cart(id){
			if(confirm('你确定要删除购物车中的商品吗？')){
				//利用ajax删除数据库中的数据
				$.ajax({
					type : "get",
					dataType : "text",
					url : "<?php echo U('ajaxDeleteCart','',false)?>"+"/id/"+id,
					success : function(data){
						if(data == 1){
							//删除成功后就删除tr
							$('#'+id+'').parent().remove();
						}
					}
				});
			}
		}
	</script>



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