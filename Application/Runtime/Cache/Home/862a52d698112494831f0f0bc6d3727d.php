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


<link rel="stylesheet" href="/Public/Home/css/goods.css" type="text/css">
<link rel="stylesheet" href="/Public/Home/css/common.css" type="text/css">
<link rel="stylesheet" href="/Public/Home/css/jqzoom.css" type="text/css">
<script type="text/javascript" src="/Public/Home/js/jqzoom-core.js"></script>
<script type="text/javascript" src="/Public/Home/js/goods.js"></script>
<!-- jqzoom 效果 -->
	<script type="text/javascript">
		$(function(){
			$('.jqzoom').jqzoom({
	            zoomType: 'standard',
	            lens:true,
	            preloadImages: false,
	            alwaysOn:false,
	            title:false,
	            zoomWidth:400,
	            zoomHeight:400
	        });
		})
	</script>
<!-- 引入导航条 -->
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
  
 <!-- 商品页面主体 start -->
	<div class="main w1210 mt10 bc">
		<!-- 面包屑导航 start -->
		<div class="breadcrumb">
			<h2>当前位置：
			<a href="/">首页</a>>
			<?php foreach($pData as $k=>$v){?>
			<a href=""><?php echo $v['cat_name']?></a>>
			<?php }?>
			<?php echo $data['goods_name']?></h2>
		</div>
		<!-- 面包屑导航 end -->
		
		<!-- 主体页面左侧内容 start -->
		<div class="goods_left fl">
			<!-- 相关分类 start -->
			<div class="related_cat leftbar mt10">
				<h2><strong>相关分类</strong></h2>
				<div class="leftbar_wrap">
					<ul>
						<li><a href="">笔记本</a></li>
						<li><a href="">超极本</a></li>
						<li><a href="">平板电脑</a></li>
					</ul>
				</div>
			</div>
			<!-- 相关分类 end -->

			<!-- 相关品牌 start -->
			<div class="related_cat	leftbar mt10">
				<h2><strong>同类品牌</strong></h2>
				<div class="leftbar_wrap">
					<ul>
						<li><a href="">D-Link</a></li>
						<li><a href="">戴尔</a></li>
						<li><a href="">惠普</a></li>
						<li><a href="">苹果</a></li>
						<li><a href="">华硕</a></li>
						<li><a href="">宏基</a></li>
						<li><a href="">神舟</a></li>
					</ul>
				</div>
			</div>
			<!-- 相关品牌 end -->

			<!-- 热销排行 start -->
			<div class="hotgoods leftbar mt10">
				<h2><strong>热销排行榜</strong></h2>
				<div class="leftbar_wrap">
					<ul>
						<li></li>
					</ul>
				</div>
			</div>
			<!-- 热销排行 end -->


			<!-- 浏览过该商品的人还浏览了  start 注：因为和list页面newgoods样式相同，故加入了该class -->
			<div class="related_view newgoods leftbar mt10">
				<h2><strong>浏览了该商品的用户还浏览了</strong></h2>
				<div class="leftbar_wrap">
					<ul>
						<li>
							<dl>
								<dt><a href=""><img id="1" src="/Public/Home/images/relate_view1.jpg" alt="" /></a></dt>
								<dd><a href="">ThinkPad E431(62771A7) 14英寸笔记本电脑 (i5-3230 4G 1TB 2G独显 蓝牙 win8)</a></dd>
								<dd><strong>￥5199.00</strong></dd>
							</dl>
						</li>

						<li>
							<dl>
								<dt><a href=""><img id="1" src="/Public/Home/images/relate_view2.jpg" alt="" /></a></dt>
								<dd><a href="">ThinkPad X230i(2306-3V9） 12.5英寸笔记本电脑 （i3-3120M 4GB 500GB 7200转 蓝牙 摄像头 Win8）</a></dd>
								<dd><strong>￥5199.00</strong></dd>
							</dl>
						</li>

						<li>
							<dl>
								<dt><a href=""><img id="1" src="/Public/Home/images/relate_view3.jpg" alt="" /></a></dt>
								<dd><a href="">T联想（Lenovo） Yoga13 II-Pro 13.3英寸超极本 （i5-4200U 4G 128G固态硬盘 摄像头 蓝牙 Win8）晧月银</a></dd>
								<dd><strong>￥7999.00</strong></dd>
							</dl>
						</li>

						<li>
							<dl>
								<dt><a href=""><img id="1" src="/Public/Home/images/relate_view4.jpg" alt="" /></a></dt>
								<dd><a href="">联想（Lenovo） Y510p 15.6英寸笔记本电脑（i5-4200M 4G 1T 2G独显 摄像头 DVD刻录 Win8）黑色</a></dd>
								<dd><strong>￥6199.00</strong></dd>
							</dl>
						</li>

						<li class="last">
							<dl>
								<dt><a href=""><img id="1" src="/Public/Home/images/relate_view5.jpg" alt="" /></a></dt>
								<dd><a href="">ThinkPad E530c(33662D0) 15.6英寸笔记本电脑 （i5-3210M 4G 500G NV610M 1G独显 摄像头 Win8）</a></dd>
								<dd><strong>￥4399.00</strong></dd>
							</dl>
						</li>					
					</ul>
				</div>
			</div>
			<!-- 浏览过该商品的人还浏览了  end -->

			<!-- 最近浏览 start -->
			<div class="viewd leftbar mt10">
				<h2><a href="">清空</a><strong>最近浏览过的商品</strong></h2>
				<div class="leftbar_wrap" id="display_history">
					
				</div>
			</div>
			<!-- 最近浏览 end -->

		</div>
		<!-- 主体页面左侧内容 end -->
		
		<!-- 商品信息内容 start -->
		<div class="goods_content fl mt10 ml10">
			<!-- 商品概要信息 start -->
			<div class="summary">
				<h3><strong><?php echo $data['goods_name']?></strong></h3>
				
				<!-- 图片预览区域 start -->
				<div class="preview fl">
					<div class="midpic">
						<a href="<?php echo $viewPath.$data['mbig_logo']?>" class="jqzoom" rel="gal1">   <!-- 第一幅图片的大图 class 和 rel属性不能更改 -->
							<?php showImage($data['big_logo'])?>              <!-- 第一幅图片的中图 -->
						</a>
					</div>
	
					<!--使用说明：此处的预览图效果有三种类型的图片，大图，中图，和小图，取得图片之后，分配到模板的时候，把第一幅图片分配到 上面的midpic 中，其中大图分配到 a 标签的href属性，中图分配到 img 的src上。 下面的smallpic 则表示小图区域，格式固定，在 a 标签的 rel属性中，分别指定了中图（smallimage）和大图（largeimage），img标签则显示小图，按此格式循环生成即可，但在第一个li上，要加上cur类，同时在第一个li 的a标签中，添加类 zoomThumbActive  -->

					<div class="smallpic">
						<a href="javascript:;" id="backward" class="off"></a>
						<a href="javascript:;" id="forward" class="on"></a>
						<div class="smallpic_wrap">
							<ul>
								<li class="cur">
									<a class="zoomThumbActive" href="javascript:void(0);" rel="{gallery: 'gal1', smallimage: '<?php echo $viewPath.$data['big_logo']?>',largeimage: '<?php echo $viewPath.$data['mbig_logo']?>'}"><?php showImage($data['sm_logo'])?></a>
								</li>
								<?php foreach($goods_pic as $k=>$v){?>
								<li>
									<a href="javascript:void(0);" rel="{gallery: 'gal1', smallimage: '<?php echo $viewPath.$v['mid_pic']?>',largeimage: '<?php echo $viewPath.$v['big_pic']?>'}"><?php showImage($v['sm_pic'])?></a>
								</li>
								<?php }?>
							</ul>
						</div>
						
					</div>
				</div>
				<!-- 图片预览区域 end -->

				<!-- 商品基本信息区域 start -->
				<div class="goodsinfo fl ml10">
					<ul>
						<li><span>商品编号： </span><?php echo $data['goods_sn']?></li>
						<li class="market_price"><span>市场定价：</span><em>￥<?php echo $data['market_price']?></em></li>
						<li class="shop_price"><span>本店价：</span> <strong>￥<?php echo $data['shop_price']?></strong> <a href="">(降价通知)</a></li>
						
						<li>
						<?php if($member_price){?>
						<span>会员价格：</span>
						<?php foreach($member_price as $k=>$v){?>
						<strong><?php echo $v['level_name']?> ￥<?php echo $v['price']?></strong>&nbsp;&nbsp;
						<?php }?>
						<?php }?>
						</li>
						<li class="shop_price"><span>购买价：</span> <strong id="member_price" style="font-size:20px"></strong></li>
						<li><span>上架时间：</span><?php echo $data['addtime']?></li>
						<li class="star"><span>商品评分：</span> <strong></strong><a href="">(已有21人评价)</a></li> <!-- 此处的星级切换css即可 默认为5星 star4 表示4星 star3 表示3星 star2表示2星 star1表示1星 -->
					</ul>
					<form action="<?php echo U('Cart/add');?>" method="post" class="choose">
						<input type="hidden" name="goods_id" value="<?php echo $data['id']?>">
						<ul>
						<?php foreach($mulArr as $k=>$v){?>
							<li class="product">
								<dl>
									<dt><?php echo $k?>：</dt>
									<dd>
										<?php foreach($v as $k1=>$v1){?>
										<a <?php if($k1 == 0){echo 'class="selected"';}?> href="javascript:;"><?php echo $v1['attr_value']?> <input type="radio" name="goods_attr_id[<?php echo $v1['attr_id']?>]" value="<?php echo $v1['id']?>" <?php if($k1 == 0){echo 'checked="checked"';}?> /></a>
										<?php }?>
									</dd>
								</dl>
							</li>
						<?php }?>
							
							<li>
								<dl>
									<dt>购买数量：</dt>
									<dd>
										<a href="javascript:;" id="reduce_num"></a>
										<input type="text" name="goods_number" value="1" class="amount"/>
										<a href="javascript:;" id="add_num"></a>
									</dd>
								</dl>
							</li>

							<li>
								<dl>
									<dt>&nbsp;</dt>
									<dd>
										<input type="submit" value="" class="add_btn" />
									</dd>
								</dl>
							</li>

						</ul>
					</form>
				</div>
				<!-- 商品基本信息区域 end -->
			</div>
			<!-- 商品概要信息 end -->
			
			<div style="clear:both;"></div>

			<!-- 商品详情 start -->
			<div class="detail">
				<div class="detail_hd">
					<ul>
						<li class="first"><span>商品介绍</span></li>
						<li class="on"><span>商品评价</span></li>
						<li><span>售后保障</span></li>
					</ul>
				</div>
				<div class="detail_bd">
					<!-- 商品介绍 start -->
					<div class="introduce detail_div none">
						<div class="attr mt15">
							<ul>
								<li><span>商品名称：</span><?php echo $data['goods_name']?></li>
								<li><span>商品编号：</span><?php echo $data['goods_sn']?></li>
								<li><span>上架时间：</span><?php echo $data['addtime']?></li>
								<?php foreach($uniArr as $k=>$v){?>
								<li><span><?php echo $v['attr_name']?>：</span><?php echo $v['attr_value']?></li>
								<?php }?>
							</ul>
						</div>

						<div class="desc mt10">
							<!-- 此处的内容 一般是通过在线编辑器添加保存到数据库，然后直接从数据库中读出 -->
							<?php echo $data['goods_desc']?>
						</div>
					</div>
					<!-- 商品介绍 end -->
					
					<!-- 商品评论 start -->
					<div class="comment detail_div mt10">
						<div class="comment_summary">
							<div class="rate fl">
								<strong><em class="hao"></em>%</strong> <br />
								<span>好评度</span>
							</div>
							<div class="percent fl">
								<dl>
									<dt>好评（<span class="hao"></span>%）</dt>
									<dd><div id="hao_width"></div></dd>
								</dl>
								<dl>
									<dt>中评（<span class="zhong">%）</dt>
									<dd><div id="zhong_width"></div></dd>
								</dl>
								<dl>
									<dt>差评（<span class="cha">%）</dt>
									<dd><div id="cha_width" ></div></dd>
								</dl>
							</div>
							<div class="buyer fl">
								<dl>
									<dt>买家印象：</dt>
									
								</dl>
							</div>
						</div>

						<div id="comment_container">
						</div>
							

						<!-- 分页信息 start -->
						<div class="page mt20" id="page">
							
						</div>
						<!-- 分页信息 end -->

						<!--  评论表单 start-->
						<div class="comment_form mt20">
							<form id="comment_form">
							<input type="hidden" name="goods_id" value="<?php echo $data['id']?>">
								<ul>
									<li>
										<label for=""> 评分：</label>
										<input type="radio" name="star" value="5" checked='checked'/> <strong class="star star5"></strong>
										<input type="radio" name="star" value="4"/> <strong class="star star4"></strong>
										<input type="radio" name="star" value="3"/> <strong class="star star3"></strong>
										<input type="radio" name="star" value="2"/> <strong class="star star2"></strong>
										<input type="radio" name="star" value="1"/> <strong class="star star1"></strong>
									</li>

									<li>
										<label for="">评价内容：</label>
										<textarea name="content" id="" cols="" rows=""></textarea>
									</li>
									<li id="yx_checkbox"></li>
									<li>
										<label for="">买家印象：</label>
										<input type="text" name="yx_name" size="60"> 多个印象用，号隔开
									</li>
									<li>
										<label for="">&nbsp;</label>
										<input type="button" value="提交评论"  style="line-height:10px" class="comment_btn"/>										
									</li>
								</ul>
							</form>
						</div>
						<!--  评论表单 end-->
						
					</div>
					<!-- 商品评论 end -->

					<!-- 售后保障 start -->
					<div class="after_sale mt15 none detail_div">
						<div>
							<p>本产品全国联保，享受三包服务，质保期为：一年质保 <br />如因质量问题或故障，凭厂商维修中心或特约维修点的质量检测证明，享受7日内退货，15日内换货，15日以上在质保期内享受免费保修等三包服务！</p>
							<p>售后服务电话：800-898-9006 <br />品牌官方网站：http://www.lenovo.com.cn/</p>

						</div>

						<div>
							<h3>服务承诺：</h3>
							<p>本商城向您保证所售商品均为正品行货，京东自营商品自带机打发票，与商品一起寄送。凭质保证书及京东商城发票，可享受全国联保服务（奢侈品、钟表除外；奢侈品、钟表由本商城联系保修，享受法定三包售后服务），与您亲临商场选购的商品享受相同的质量保证。本商城还为您提供具有竞争力的商品价格和运费政策，请您放心购买！</p> 
							
							<p>注：因厂家会在没有任何提前通知的情况下更改产品包装、产地或者一些附件，本司不能确保客户收到的货物与商城图片、产地、附件说明完全一致。只能确保为原厂正货！并且保证与当时市场上同样主流新品一致。若本商城没有及时更新，请大家谅解！</p>

						</div>
						
						<div>
							<h3>权利声明：</h3>
							<p>本商城上的所有商品信息、客户评价、商品咨询、网友讨论等内容，是京东商城重要的经营资源，未经许可，禁止非法转载使用。</p>
							<p>注：本站商品信息均来自于厂商，其真实性、准确性和合法性由信息拥有者（厂商）负责。本站不提供任何保证，并不承担任何法律责任。</p>

						</div>
					</div>
					<!-- 售后保障 end -->

				</div>
			</div>
			<!-- 商品详情 end -->

			
		</div>
		<!-- 商品信息内容 end -->
		
		</div>
		
	<!-- 商品页面主体 end -->
	
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
<script>
	//<dl>
		//<dt>
			//<a href=""><img id="1" src="/Public/Home/images/hpG4.jpg" alt="" /></a>
		//</dt>
		//<dd><a href="">惠普G4-1332TX 14英寸笔记...</a></dd>
	//</dl>
	//****************ajax获取浏览历史************************
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
	//********************ajax获取会员价格**************************
	$.ajax({
		type : "get",
		dataType : "text",
		url : "<?php echo U('ajaxGetMemberPrice?goods_id='.$data['id'])?>",
		success : function(data){
			$('#member_price').html("￥"+data);
		}
	});
	
	
	//********************ajax评论商品****************************
	$('.comment_btn').click(function(){
		$.ajax({
			type : "post",
			dataType : "json",
			data : $('#comment_form').serialize(),
			url : "<?php echo U('Comment/add')?>",
			success : function(data){
				if(data.status == 0){
					//没有发表成功
					//先判断原因是不是没有登录，如果是就先跳出登录的表单，插件
					if(data.info == '必须先登录！'){
						//弹出div
						$( "#dialog_login" ).dialog( "open" );
					}else{
						alert(data.info);
					}
				}else{
					//如果成功就先清空表单，拼凑一个html的字符串
					$('#comment_form').trigger("reset");
					var html = '<div class="comment_items mt10 none"><div class="user_pic"><dl><dt><a href=""><img id="1" src="'+data.info.face+'" alt="" /></a></dt><dd><a href="">'+data.info.username+'</a></dd></dl></div><div class="item"><div class="title"><span>'+data.info.addtime+'</span><strong class="star star'+data.info.star+'"></strong></div><div class="comment_content">'+data.info.content+'</div><div class="btns"><a href="javascript:void(0)" onclick="reply(this,'+data.info.id+')" class="reply">回复(0)</a><a href="javascript:void(0);" onclick="useful(this,'+v.id+')" class="useful">有用(<span>0</span>)</a></div><div class="reply_form"></div><ul class="reply_container"></ul></div><div class="cornor"></div></div>';
					//把整个字符串转换为jquery对象
					html = $(html);
					// 把拼好的评论放到页面中
					$("#comment_container").prepend(html);
					// 让导航条直接滚动第一个评论处
					$("html,body").animate({
						"scrollTop" : "750px"
					}, 1000, function(){
						html.fadeIn(1000);
					});
				}
			}
		});
	});
	
	//*******************ajax获取分页的评论数据************************
	function showpage(url){
		$.ajax({
			type : "get",
			dataType : "json",
			url : url,
			success : function(data){
				var html = '';
				$(data.data).each(function(k,v){
					html += '<div class="comment_items mt10"><div class="user_pic"><dl><dt><a href=""><img id="1" src="'+v.face+'" alt="" /></a></dt><dd><a href="">'+v.username+'</a></dd></dl></div><div class="item"><div class="title"><span>'+v.addtime+'</span><strong class="star star'+v.star+'"></strong></div><div class="comment_content">'+v.content+'</div><div class="btns"><a href="javascript:void(0)" onclick="reply(this,'+v.id+')" class="reply">回复('+v.reply_count+')</a><a href="javascript:void(0);" onclick="useful(this,'+v.id+')" class="useful">有用(<span>'+v.click_count+'</span>)</a></div><div class="reply_form"></div><ul class="reply_container"></ul></div><div class="cornor"></div></div>';
				});
				// 把拼好的评论放到页面中(覆盖)
				//console.log(html);
				$("#comment_container").html(html);
				$('#page').html(data.page);
				
				//把好评影响放到页面中
				if(url == "<?php echo U('Comment/ajaxGetPl?id='.$data['id'],'',false)?>"){
					//放好评
					$('.hao').html(data.hao);
					$('#hao_width').css('width',data.hao+"px");
					
					$('.zhong').html(data.zhong);
					$('#zhong_width').css('width',data.zhong+"px");
					
					$('.cha').html(data.cha);
					$('#cha_width').css('width',data.cha+"px");
					
					//放印象
					var yinxiang = '';
					var yxcheck = '';
					$(data.yxData).each(function(k1,v1){
						yinxiang += '<dd><span>'+v1.yx_name+'</span><em>('+v1.yx_count+')</em></dd>';
						if(v1.yx_count > 1){
							yxcheck  += '<input type="checkbox" name="yx_id[]" value="'+v1.id+'">'+v1.yx_name+' ';
						}
					});
					$('.buyer dl').append(yinxiang);
					
					
					
					$('#yx_checkbox').html('<label for="">买家印象：</label>'+yxcheck+'');
				}
			}
		});
	}
	//首次调用
	showpage("<?php echo U('Comment/ajaxGetPl?id='.$data['id'],'',false)?>");
	
	function useful(btn,commentId){
		var i = $(btn).find('span').html();
		i = parseInt(i);
		$(btn).find('span').html(i+1);
		
		//数据库中加1
		$.ajax({
			type : "get",
			url : "<?php echo U('Comment/ajaxAddCount','',false)?>/comment_id/"+commentId,
			success : function(data){
				
			}
		});
		
	}
	function reply(btn,commentId){
		var div = $(btn).parent().next('div');
		//拼凑恢复的表单，再显示在div中
		var replyForm = '<br /><hr style="clear:both;margin-top:15px;border-color:#5656564d"><form><input type="hidden" name="comment_id" value="'+commentId+'"><textarea name="content" style="width:100%;" rows="5"></textarea><input type="button" onclick="post_reply(this)" value="回复"> <input type="button" value="取消" onclick="close_reply(this)"></form>';
		
		div.html(replyForm);
		
		//在根据评论的id把回复的数据显示出来ul中
		$.ajax({
			type : "get",
			url : "<?php echo U('Comment/ajaxGetReply','',false)?>/comment_id/"+commentId,
			dataType : "json",
			success : function(data){
				//拼成li放放到ul中
				var li = "";
				$(data).each(function(k,v){
					li += '<li><img src="'+v.face+'" />'+v.username+'【'+v.addtime+'】回复：<p>'+v.content+'</p></li>';
				});
				div.next('ul').html(li);
			}
		});
	}
	
	function close_reply(btn){
		//清空ul
		$(btn).parent().parent().next('ul').html('');
		//清空表单所在的div
		$(btn).parent().parent().html('');
		
		
	}
	
	function post_reply(btn){
		var formData = $(btn).parent().serialize();
		$.ajax({
			type : "post",
			dataType : "json",
			data : formData,
			url : "<?php echo U('Comment/reply')?>",
			success : function(data){
				if(data.status == 0){
					//没有发表成功
					//先判断原因是不是没有登录，如果是就先跳出登录的表单，插件
					if(data.info == '必须先登录！'){
						//弹出div
						$( "#dialog_login" ).dialog( "open" );
					}else{
						alert(data.info);
					}
				}else{
					var li = '<li><img src="'+data.info.face+'" />'+data.info.username+'【'+data.info.addtime+'】回复：<p>'+data.info.content+'</p></li>';
					
					//把回复的内容显示在页面上（ul上）
					$(btn).parent().parent().next('ul').append(li);
					$(btn).parent().trigger("reset");
					//重置表单
					alert('回复成功！');
				}
			}
		});
	}
</script>

<!-- 引入帮助 -->

<link href="/Public/jquery-ui-1.9.2.custom/css/blitzer/jquery-ui-1.9.2.custom.css" rel="stylesheet">
<script src="/Public/jquery-ui-1.9.2.custom/js/jquery-ui-1.9.2.custom.js"></script>
<div id="dialog_login" class="none" title="用户登录">
	<form id="login_form">
					<ul>
						<li>
							<label for="">用户名：</label>
							<input type="text" class="txt" name="username" />
						</li>
						<li>
							<label for="">密　码：</label>
							<input type="password" class="txt" name="password" />
							<a href="">忘记密码?</a>
						</li>
						<li class="checkcode">
							<label for="">验证码：</label>
							<input type="text"  name="captcha" />
							 <div style="margin-top:8px;margin-left:60px"><img id="img_check" style="cursor:pointer;" onclick="this.src='<?php echo U('Member/verifyImg');?>#'+Math.random();" src="<?php echo U('Member/verifyImg'); ?>" /></div>
							</br><span style="margin-left:60px">看不清？<a href="javascript:void(0)" onclick="document.getElementById('img_check').src='<?php echo U('Member/verifyImg');?>#'+Math.random();">换一张</a></span>
						</li>
					</ul>
				</form>
</div>
<script>
//配置div
$( "#dialog_login" ).dialog({
	modal : true,//模糊化隔层
	position : {at: "center"},
	resizable : false,//不可以调整大小
	autoOpen: false,
	width: 400,
	buttons: [
		{
			text: "登录",
			click: function() {
				$.ajax({
					type : "post",
					data : $('#login_form').serialize(),
					dataType : "json",
					url : "<?php echo U('Member/login')?>",
					success : function(data){
						if(data.status == 1){
							//关闭表单
							 $('#dialog_login').dialog( "close" );
							//刷新页面
							 window.location.reload();
						}else{
							alert(data.info);
						}
					}
				});
			}
		},
		{
			text: "取消",
			click: function() {
				$( this ).dialog( "close" );
			}
		}
	]
});
</script>
<style>
	#login_form li{margin:5px;}
    #login_form li input{height:25px;}
	.reply_container{margin-top:25px;}
	.reply_container li{min-height:60px;margin:3px;background:#DAF1DA;padding:5px;}
	.reply_container img{float:right;}
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