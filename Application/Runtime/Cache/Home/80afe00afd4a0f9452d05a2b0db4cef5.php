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


<script type="text/javascript" src="/Public/Home/js/list.js"></script>
<link rel="stylesheet" href="/Public/Home/css/list.css" type="text/css">
<link rel="stylesheet" href="/Public/Home/css/common.css" type="text/css">
    <!-- searchBar  B-->
    <div style="clear:both;"></div>

	<!-- 头部 start -->
	<div class="header w1210 bc mt15">
		<!-- 头部上半部分 start 包括 logo、搜索、用户中心和购物车结算 -->
		<div class="logo w1210">
			<h1 class="fl"><a href="/"><img id="logo" src="/Public/Home/images/logo.png" alt="京西商城"></a></h1>
			<!-- 头部搜索 start -->
			<div class="search fl">
				 <div class="search_form">
					<div class="form_left fl"></div>
					<form action="" name="serarch" method="get" class="fl">
						<input type="text" class="txt" value="<?php echo I('get.key','请输入商品关键字')?>" id="key"/>
						<input onclick="location.href='<?php echo U('Search/key_search','',false)?>/key/'+$('#key').val()" type="button" class="btn" value="搜索" />
					</form>
					<div class="form_right fl"></div>
				</div>
				<div style="clear:both;"></div>

				<div class="hot_search">
					<strong>热门搜索:</strong>
					<a href="">D-Link无线路由</a>
					<a href="">休闲男鞋</a>
					<a href="">TCL空调</a>
					<a href="">耐克篮球鞋</a>
				</div>
			</div>
			<!-- 头部搜索 end -->

			<!-- 用户中心 start-->
			<div class="user fl">
				<dl>
					<dt>
						<em></em>
						<a href="">用户中心</a>
						<b></b>
					</dt>
					<dd>
						<div class="prompt">
							您好，请<a href="">登录</a>
						</div>
						<div class="uclist mt10">
							<ul class="list1 fl">
								<li><a href="">用户信息></a></li>
								<li><a href="">我的订单></a></li>
								<li><a href="">收货地址></a></li>
								<li><a href="">我的收藏></a></li>
							</ul>

							<ul class="fl">
								<li><a href="">我的留言></a></li>
								<li><a href="">我的红包></a></li>
								<li><a href="">我的评论></a></li>
								<li><a href="">资金管理></a></li>
							</ul>

						</div>
						<div style="clear:both;"></div>
						<div class="viewlist mt10">
							<h3>最近浏览的商品：</h3>
							<ul>
								<li><a href=""><img id="1" src="/Public/Home/images/view_list1.jpg" alt="" /></a></li>
								<li><a href=""><img id="1" src="/Public/Home/images/view_list2.jpg" alt="" /></a></li>
								<li><a href=""><img id="1" src="/Public/Home/images/view_list3.jpg" alt="" /></a></li>
							</ul>
						</div>
					</dd>
				</dl>
			</div>
			<!-- 用户中心 end-->

			<!-- 购物车 start -->
			<div class="cart fl" id="cart">
				<dl>
					<dt>

						<a href="<?php echo U('Cart/lst')?>">去购物车结算</a>
						<i class="ci-count" id="shopping-amount"><span id="cart_count">0<span></i>
						<b></b>
					</dt>
					<dd>
						<div class="prompt" id="cart_div">
							购物车中还没有商品，赶紧选购吧！
						</div>
					</dd>
				</dl>
			</div>
			<!-- 购物车 end -->
		</div>
		<!-- 头部上半部分 end -->
		
		<div style="clear:both;"></div>
    <!-- searchBar  E-->
    <!-- nav   B-->
    <div class="nav w1210 bc mt10">
			<!--  商品分类部分 start-->
			<div class="category fl <?php if($_show_nav == 0){echo 'cat1';}?>"> <!-- 非首页，需要添加cat1类 -->
				<div class="cat_hd <?php if($_show_nav == 0){echo 'off';}?>">  <!-- 注意，首页在此div上只需要添加cat_hd类，非首页，默认收缩分类时添加上off类，鼠标滑过时展开菜单则将off类换成on类 -->
					<h2>全部商品分类</h2>
					<em></em>
				</div>
				
				<div class="cat_bd <?php if($_show_nav == 0){echo 'none';}?>">
					<?php foreach($catData as $k=>$v){?>
					<?php if($k < 13){?>
					<div class= "cat <?php if($k == 0){echo ' item1';}?>">
						<h3><a href="<?php echo U('Search/cat_search?id='.$v['cat_id'],'',false)?>"><?php echo $v['cat_name']?></a> <b></b></h3>
						<div class="cat_detail">
							<?php foreach($v['children'] as $k1=>$v1){?>
							<dl <?php if($k1 == 0 ){echo 'class="dl_1st"';}?>>
								<dt><a href="<?php echo U('Search/cat_search?id='.$v1['cat_id'],'',false)?>"><?php echo $v1['cat_name']?></a></dt>
								<dd>
								<?php foreach($v1['children'] as $k2=>$v2){?>									
									<a href="<?php echo U('Search/cat_search?id='.$v2['cat_id'],'',false)?>"><?php echo $v2['cat_name']?></a>	
								<?php }?>				
								</dd>
							</dl>
							<?php }?>
						</div>
					</div>
					<?php }?>
					<?php }?>
					
				</div>

			</div>
			<!--  商品分类部分 end--> 

			<div class="navitems fl">
				<ul class="fl">
					<li class="current"><a href="">首页</a></li>
					<li><a href="">电脑频道</a></li>
					<li><a href="">家用电器</a></li>
					<li><a href="">品牌大全</a></li>
					<li><a href="">团购</a></li>
					<li><a href="">积分商城</a></li>
					<li><a href="">夺宝奇兵</a></li>
				</ul>
				<div class="right_corner fl"></div>
			</div>
			
		</div>
		<!-- 导航条部分 end -->
		<div style="clear:both;"></div>
		<script>
		<?php $c = C('IMAGE_CONFIG');?>
		var picView = "<?php echo $c['viewPath'];?>";
		$('#cart').mouseover(function(){
			$.ajax({
				type : "get",
				url : "<?php echo U('Cart/ajaxGetCart')?>",
				dataType : "json",
				success : function(data){
					//拼装出html
					if(data){
					var html = '';
					html = '<div>你的购物车有以下商品！</div><table style="align:center;width:300px" >';
						$(data).each(function(k,v){
							html += '<tr>';
							html += '<td><img width="50" src="'+picView+v.mid_logo+'"></td>';
							html +=	'<td>名称：'+v.goods_name+'</td>';
							html +=	'<td>数量：'+v.goods_number+'件</td>';
							html += '</tr>';
						});
					html += '</table>';
					//放到div中
					$('#cart_div').html(html);
					
					}
				}
			});
		});
		$(function(){
		    $.ajax({
		        type : "get",
		        url : "<?php echo U('Cart/ajaxGetCartCount')?>",
		        dataType : "text",
		        success : function(data1){
		            $('#cart_count').html(data1);
		        }
		    });
		});
		</script>
	<!-- 列表主体 start -->
	<div class="list w1210 bc mt10">
		<!-- 面包屑导航 start -->
		<div class="breadcrumb">
			<h2>当前位置：<a href="/">首页</a> > 
			<?php foreach($parent_cat as $k=>$v){?>
			<a href="<?php echo U('Search/cat_search?id='.$v['cat_id'],'',false)?>">
			<?php echo $v['cat_name']?>
			</a> >
			<?php }?>
			</h2>
			
		</div>
		<!-- 面包屑导航 end -->

		<!-- 左侧内容 start -->
		<div class="list_left fl mt10">
			<!-- 分类列表 start -->
			<div class="catlist">
				<h2>电脑、办公</h2>
				<div class="catlist_wrap">
					<div class="child">
						<h3 class="on"><b></b>电脑整机</h3>
						<ul>
							<li><a href="">笔记本</a></li>
							<li><a href="">超极本</a></li>
							<li><a href="">平板电脑</a></li>
						</ul>
					</div>

					<div class="child">
						<h3><b></b>电脑配件</h3>
						<ul class="none">
							<li><a href="">CPU</a></li>
							<li><a href="">主板</a></li>
							<li><a href="">显卡</a></li>
						</ul>
					</div>

					<div class="child">
						<h3><b></b>办公打印</h3>
						<ul class="none">
							<li><a href="">打印机</a></li>
							<li><a href="">一体机</a></li>
							<li><a href="">投影机</a></li>
							</li>
						</ul>
					</div>

					<div class="child">
						<h3><b></b>网络产品</h3>
						<ul class="none">
							<li><a href="">路由器</a></li>
							<li><a href="">网卡</a></li>
							<li><a href="">交换机</a></li>
							</li>
						</ul>
					</div>

					<div class="child">
						<h3><b></b>外设产品</h3>
						<ul class="none">
							<li><a href="">鼠标</a></li>
							<li><a href="">键盘</a></li>
							<li><a href="">U盘</a></li>
						</ul>
					</div>
				</div>
				
				<div style="clear:both; height:1px;"></div>
			</div>
			<!-- 分类列表 end -->
				
			<div style="clear:both;"></div>	

			<!-- 新品推荐 start -->
			<div class="newgoods leftbar mt10">
				<h2><strong>新品推荐</strong></h2>
				<div class="leftbar_wrap">
					<ul>
					<?php foreach($nGoods as $k=>$v){ if($k < 3){ ?>
						<li>
							<dl>
								<dt><a href="<?php echo U('Index/goods?id='.$v['id'])?>"><?php showImage($v['mid_logo'])?></a></dt>
								<dd><a href="<?php echo U('Index/goods?id='.$v['id'])?>"><?php echo $v['goods_name']?></a></dd>
								<dd><strong>￥<?php echo $v['shop_price']?></strong></dd>
							</dl>
						</li>
					<?php }}?>
						
					</ul>
				</div>
			</div>
			<!-- 新品推荐 end -->

			<!--热销排行 start -->
			<div class="hotgoods leftbar mt10">
				<h2><strong>热销排行榜</strong></h2>
				<div class="leftbar_wrap">
					<ul>
						<li></li>
					</ul>
				</div>
			</div>
			<!--热销排行 end -->

			<!-- 最近浏览 start -->
			<div class="viewd leftbar mt10">
				<h2><a href="">清空</a><strong>最近浏览过的商品</strong></h2>
				<div class="leftbar_wrap" id="display_history">
					
				</div>
			</div>
			<!-- 最近浏览 end -->
		</div>
		<!-- 左侧内容 end -->
	
		<!-- 列表内容 start -->
		<div class="list_bd fl ml10 mt10">
			<!-- 热卖、促销 start -->
			<div class="list_top">
				<!-- 热卖推荐 start -->
				<div class="hotsale fl">
					<h2><strong><span class="none">热卖推荐</span></strong></h2>
					<ul>
					<?php foreach($hGoods as $k=>$v){ if($k < 3){ ?>
						<li>
							<dl>
								<dt><a href="<?php echo U('Index/goods?id='.$v['id'])?>"><?php showImage($v['mid_logo'])?></a></dt>
								<dd class="name"><a href="<?php echo U('Index/goods?id='.$v['id'])?>"><?php echo $v['goods_name']?></a></dd>
								<dd class="price">特价：<strong>￥<?php echo $v['shop_price']?></strong></dd>
								<dd class="buy"><a href="<?php echo U('Index/goods?id='.$v['id'])?>"><span>立即抢购</span></a></dd>
							</dl>
						</li>
						
					<?php }}?>
						
					</ul>
				</div>
				<!-- 热卖推荐 end -->

				<!-- 促销活动 start -->
				<div class="promote fl">
					<h2><strong><span class="none">促销活动</span></strong></h2>
					<ul>
						<li><b>.</b><a href="">DIY装机之向雷锋同志学习！</a></li>
						<li><b>.</b><a href="">京东宏碁联合促销送好礼！</a></li>
						<li><b>.</b><a href="">台式机笔记本三月巨惠！</a></li>
						<li><b>.</b><a href="">富勒A53g智能人手识别鼠标</a></li>
						<li><b>.</b><a href="">希捷硬盘白色情人节专场</a></li>
					</ul>

				</div>
				<!-- 促销活动 end -->
			</div>
			<!-- 热卖、促销 end -->
			
			<div style="clear:both;"></div>
			<style>
				.condition{border:1px solid red;font-size:12px;padding:2px;border-right:none;color:red;margin-left:10px}
				.box{margin:12px}
				.span_condition{font-size:12px;border:1px solid red;padding:2px;border-left:none;}
			</style>
			<div class="box">当前搜索条件：
				<?php $brand = I('get.brand_id'); if($brand){?>
					<span class="condition">
						<font color="black">品牌：</font><?php echo ltrim(strrchr($brand,'-'),'-');?>
						
					</span>
					<span class="span_condition">
						<a href="<?php echo filterUrl('brand_id')?>" style="color:red">✖&nbsp;</a>
						</span>
				<?php }?>
				<?php $price = I('get.price'); if($price){?>
					<span class="condition">
						<font color="black">价格：</font><?php echo $price;?>
						
					</span>
					<span class="span_condition">
						<a href="<?php echo filterUrl('price')?>" style="color:red">✖&nbsp;</a>
						</span>
				<?php }?>
				<?php  foreach($_GET as $k=>$v){ if(strpos($k,'attr_') === 0){ $attrName = strrchr($v,'-'); ?>
					<span class="condition">
						<font color="black"><?php echo ltrim($attrName,'-')?>：</font><?php echo str_replace($attrName,'',$v)?>
						
					</span>
					<span class="span_condition">
						<a href="<?php echo filterUrl($k)?>" style="color:red">✖&nbsp;</a>
						</span>
					<?php }?>
				<?php }?>
			<div>
			<!-- 商品筛选 start -->
			<div class="filter mt10">
				<h2><a href="<?php echo U('Search/cat_search?id='.I('get.id'),'',false)?>">重置筛选条件</a> <strong>商品筛选</strong></h2>		
				<div class="filter_wrap">
					<?php if(!I('get.brand_id') && $info['brand']){?>
					<dl>
						<dt>品牌：</dt>
						<dd class="cur"><a href="">不限</a></dd>
						<?php foreach($info['brand'] as $k=>$v){?>
						<dd><a href="<?php echo $_SERVER['PHP_SELF'];?>/brand_id/<?php echo $v['brand_id'].'-'.$v['brand_name']?>"><?php echo $v['brand_name']?></a></dd>
						<?php }?>
					</dl>
					<?php }?>
					<?php if(!I('get.price') && $info['price']){?>
					<dl>
						<dt>价格：</dt>
						<dd class="cur"><a href="">不限</a></dd>
						<?php foreach($info['price'] as $k=>$v){?>
						<dd><a href="<?php echo $_SERVER['PHP_SELF'];?>/price/<?php echo $v?>"><?php echo $v?></a></dd>
						<?php }?>
					</dl>
					<?php }?>
					
					
					<?php foreach($info['gaData'] as $k=>$v){ $attr_name = 'attr_'.$v[0]['attr_id']; if(isset($_GET[$attr_name])){ continue; } ?>
					<dl>
						<dt><?php echo $k?>：</dt>
						<dd class="cur"><a href="">不限</a></dd>
						<?php foreach($v as $k1=>$v1){?>
						<dd><a href="<?php echo $_SERVER['PHP_SELF'];?>/attr_<?php echo $v[0]['attr_id']?>/<?php echo $v1['attr_value']?>-<?php echo $k?>"><?php echo $v1['attr_value']?></a></dd>
						<?php }?>
					</dl>
					<?php }?>
					
				</div>
			</div>
			<!-- 商品筛选 end -->
			
			<div style="clear:both;"></div>

			<!-- 排序 start -->
			<div class="sort mt10">
				<dl>
				<?php $odby = I('get.odby','xl')?>
					<dt>排序：</dt>
					<dd <?php if($odby == 'xl'){echo 'class="cur"';}?>><a href="<?php echo filterUrl('odby')?>/odby/xl">销量</a></dd>
					<dd <?php if(strpos($odby,'price_') === 0){echo 'class="cur"';}?>>
					<a href="<?php echo filterUrl('odby')?>/odby/<?php echo $odby == 'price_asc'? 'price_desc' : 'price_asc' ;?>">
						价格
						<?php if(strpos($odby,'price_') === 0){ echo $odby == 'price_desc' ? '↓' : '↑' ; } ?>
					</a>
					</dd>
					<!-- <dd><a href="">评论数</a></dd> -->
					<dd <?php if($odby == 'addtime'){echo 'class="cur"';}?>><a href="<?php echo filterUrl('odby')?>/odby/addtime">上架时间</a></dd>
				</dl>
			</div>
			<!-- 排序 end -->
			
			<div style="clear:both;"></div>

			<!-- 商品列表 start-->
			<div class="goodslist mt10">
				<ul>
				<?php foreach($data as $k=>$v){?>
					<li>
						<dl>
							<dt><a href="<?php echo U('Index/goods?id='.$v['id'])?>"><?php showImage($v['mid_logo'])?></a></dt>
							<dd><a href="<?php echo U('Index/goods?id='.$v['id'])?>"><?php echo $v['goods_name']?></a></dt>
							<dd><strong>￥<?php echo $v['shop_price']?></strong></dt>
							<dd>
							<em>已有10人评价</em>
							<em>销量：<?php echo $v['xl']+0?></em>
							</dt>
						</dl>
					</li>
				<?php }?>
					
				</ul>
			</div>
			<!-- 商品列表 end-->

			<!-- 分页信息 start -->
			<div class="page mt20">
				<?php echo $page;?>
			</div>
			<!-- 分页信息 end -->

		</div>
		<!-- 列表内容 end -->
	</div>
	
	</div>
	<!-- 列表主体 end-->
<script>
var viewPath = "<?php echo $viewPath; ?>";
$.ajax({
	type : 'get',
	url : "<?php echo U('Index/displayHistory?id='.$data['id']); ?>",
	dataType : 'json',
	success : function(data){
		var html = "";
		$(data).each(function(k,v){
			html += '<dl><dt><a href="<?php echo U('goods','',false); ?>/id/'+v.id+'"><img src="'+viewPath+v.mid_logo+'" alt="" /></a></dt><dd><a href="<?php echo U('goods','',false); ?>/id/'+v.id+'">'+v.goods_name+'</a></dd></dl>';
		});
		$('#display_history').html(html);
	}
});
</script>
<div style="clear:both;"></div>
<!-- slogen口号  B-->
    <div class="slogen" style="margin-top:20px;">
        <span class="slogen1"></span>
        <span class="slogen2"></span>
        <span class="slogen3"></span>
        <span class="slogen4"></span>
    </div>
    <!-- 底部导航 start -->
	<div class="bottomnav w1210 bc mt10">
	
		<div class="bnav1">
			<h3><b></b> <em>购物指南</em></h3>
			<ul>
				<li><a href="">购物流程</a></li>
				<li><a href="">会员介绍</a></li>
				<li><a href="">团购/机票/充值/点卡</a></li>
				<li><a href="">常见问题</a></li>
				<li><a href="">大家电</a></li>
				<li><a href="">联系客服</a></li>
			</ul>
		</div>
		
		<div class="bnav2">
			<h3><b></b> <em>配送方式</em></h3>
			<ul>
				<li><a href="">上门自提</a></li>
				<li><a href="">快速运输</a></li>
				<li><a href="">特快专递（EMS）</a></li>
				<li><a href="">如何送礼</a></li>
				<li><a href="">海外购物</a></li>
			</ul>
		</div>

		
		<div class="bnav3">
			<h3><b></b> <em>支付方式</em></h3>
			<ul>
				<li><a href="">货到付款</a></li>
				<li><a href="">在线支付</a></li>
				<li><a href="">分期付款</a></li>
				<li><a href="">邮局汇款</a></li>
				<li><a href="">公司转账</a></li>
			</ul>
		</div>

		<div class="bnav4">
			<h3><b></b> <em>售后服务</em></h3>
			<ul>
				<li><a href="">退换货政策</a></li>
				<li><a href="">退换货流程</a></li>
				<li><a href="">价格保护</a></li>
				<li><a href="">退款说明</a></li>
				<li><a href="">返修/退换货</a></li>
				<li><a href="">退款申请</a></li>
			</ul>
		</div>

		<div class="bnav5">
			<h3><b></b> <em>特色服务</em></h3>
			<ul>
				<li><a href="">夺宝岛</a></li>
				<li><a href="">DIY装机</a></li>
				<li><a href="">延保服务</a></li>
				<li><a href="">家电下乡</a></li>
				<li><a href="">京东礼品卡</a></li>
				<li><a href="">能效补贴</a></li>
			</ul>
		</div>
	</div>

	<!-- 底部导航 end -->


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