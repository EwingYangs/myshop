<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>NBSHOP 管理中心 - <?php echo $_page_title?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
<link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/Public/umeditor1_2_2-utf8-php/third-party/jquery.min.js"></script>
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo $_page_btn_link;?>"><?php echo $_page_btn_name?></a>
    </span>
    <span class="action-span1"><a href="__GROUP__">NBSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - <?php echo $_page_title?> </span>
    <div style="clear:both"></div>
</h1>

<!-- 内容 -->


<div class="tab-div">
    <div id="tabbar-div">
        <p>
            <span class="tab-front" id="general-tab">通用信息</span>
            <span class="tab-back" id="describe-tab">商品描述</span>
            <span class="tab-back" id="member-tab">会员价格</span>
            <span class="tab-back" id="properties-tab">商品属性</span>
            <span class="tab-back" id="gallery-tab">商品相册</span>
        </p>
    </div>
    <div id="tabbody-div">
        <form enctype="multipart/form-data" action="/index.php/Admin/Goods/edit/id/6.html" method="post" onsubmit="">
            <table width="90%" id="general-tab-tb" align="center">
            	<input type="hidden" name="id" value="<?php echo $info['id']?>">
                <tr>
                    <td class="label">商品名称：</td>
                    <td><input type="text" name="goods_name" size="30" value="<?php echo $info['goods_name']?>"/>
                    <span class="require-field">*</span></td>
                </tr>
                 <tr>
                    <td class="label">商品货号： </td>
                    <td>
                        <input type="text" name="goods_sn" size="20" value="<?php echo $info['goods_sn']?>"/>
                        <span id="goods_sn_notice"></span><br />
                        <span class="notice-span"id="noticeGoodsSN">如果您不输入商品货号，系统将自动生成一个唯一的货号。</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">商品logo：</td>
                    <?php if(!empty($info['mid_logo'])){?>
                    <td><?php showImage($info['mid_logo'])?></br>
                    <span class="notice-span">你已经上传图片，再次上传将会覆盖</span>
                    <?php }?>
                    </br></br>
                    <input type="file" name="logo" value=""size="30" />
                    </td>
                </tr>
                <tr>
                    <td class="label">商品分类：</td>
                    <td>
                        <select name="cat_id">
                            <option value="">请选择...</option>
                            <?php foreach($category_info as $v){?>
                            <option value="<?php echo $v['cat_id']?>" <?php if($v['cat_id'] == $info['cat_id']){echo 'selected=selected';}?>>
                            	<?php echo str_repeat("&nbsp;&nbsp;&nbsp;",$v['level']).$v['cat_name']?>
                            </option>                           
                            <?php }?>
                        </select>
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">扩展分类：</td>
                    
                    <td id="cat_td">
                    	<?php foreach($goods_cats as $k1=>$v1){?>
                    	<select name="ext_cat_id[]">
                            <option value="">请选择...</option>
                            <?php foreach($category_info as $k=>$v){?>
                            <option value="<?php echo $v['cat_id']?>" <?php if($v1['cat_id'] == $v['cat_id']){echo 'selected="selected"';}?> >
                            	<?php echo str_repeat("&nbsp;&nbsp;&nbsp;",$v['level']).$v['cat_name']?>
                            </option>                           
                            <?php }?>
                        </select></br>
                        <?php }?>
                        
                    	<span id="clone_cat">
                        <select name="ext_cat_id[]">
                            <option value="">请选择...</option>
                            <?php foreach($category_info as $v){?>
                            <option value="<?php echo $v['cat_id']?>">
                            	<?php echo str_repeat("&nbsp;&nbsp;&nbsp;",$v['level']).$v['cat_name']?>
                            </option>                           
                            <?php }?>
                        </select>
                        </span>
                        <input type="button" value="添加分类" id="cat_btn">
                        </br>
                    </td>
                </tr>
                <tr>
                 <tr>
                    <td class="label">商品品牌：</td>
                    <td>
                        <select name="brand_id">
                            <option value="0">请选择...</option>
                            <?php foreach($brand_info as $v){?>
                            <option value="<?php echo $v['id']?>" <?php if($info['brand_id'] == $v['id']){echo 'selected=selected';}?>><?php echo $v['brand_name']?></option>
                            <?php }?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="label">市场售价：</td>
                    <td>
                        <input type="text" name="market_price" size="20" value="<?php echo $info['market_price']?>"/>
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">本店售价：</td>
                    <td>
                        <input type="text" name="shop_price" size="20" value="<?php echo $info['shop_price']?>"/>
                        <span class="require-field">*</span>
                    </td>
                </tr>
                
                 
                <tr>
                    <td class="label">是否上架：</td>
                    <td>
                        <input type="radio" name="is_on_sale" value="是" <?php if($info['is_on_sale'] == "是"){echo 'checked=checked';}?>/> 是
                        <input type="radio" name="is_on_sale" value="否" <?php if($info['is_on_sale'] == "否"){echo 'checked=checked';}?> /> 否
                    </td>
                </tr>
            	<tr>
                    <td class="label">加入推荐：</td>
                    <td>
                        <input type="checkbox" name="is_rec" value="推荐" <?php if($info['is_rec'] == "推荐"){echo 'checked=checked';}?> /> 推荐 
                        <input type="checkbox" name="is_new" value="新品" <?php if($info['is_new'] == "新品"){echo 'checked=checked';}?> /> 新品 
                        <input type="checkbox" name="is_hot" value="热销" <?php if($info['is_hot'] == "热销"){echo 'checked=checked';}?> /> 热销
                    </td>
                </tr>
               <tr>
                    <td class="label">促销价格：</td>
                    <td>
                        <input type="text" name="promote_price" size="8" value="<?php echo $info['promote_price']?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">促销时间：</td>
                    <td>
                        <input type="text" id="promote_start_date" name="promote_start_date" size="10" value="<?php echo $info['promote_start_date']?>"/>到
                        <input type="text" id="promote_end_date" name="promote_end_date" size="10" value="<?php echo $info['promote_end_date']?>"/>
                    </td>
                </tr>
                 <tr>
                    <td class="label">排序：</td>
                    <td>
                        <input type="text" name="sort_num" size="10" value="<?php echo $info['sort_num']?>"/>
                    </td>
                </tr>
                
            </table>
            <!-- 商品描述 -->
            <table width="80%" id="describe-tab-tb" align="center" style="display:none">
            	<tr>
                    <td>
                        <textarea id="goods_desc" name="goods_desc"><?php echo $info['goods_desc']?></textarea>
                    </td>
                </tr>
            </table>
            
            <!-- 会员价格 -->
            <table width="30%" id="member-tab-tb" align="center" style="display:none">
                <?php foreach($member_level as $k=>$v){?>
                	<tr>
                		<td class="label"><?php echo $v['level_name']?>:</td>
                		<td>
                        <input type="text" name="member_price[<?php echo $v['id']?>]" size="18" value="<?php echo $arr[$v['id']]?>"/>
                   		</td>
                	</tr>
                <?php }?>
            </table>
            
            <!-- 商品属性 -->
           <table width="30%" id="properties-tab-tb" align="center" style="display:none">
            	<tr>
            	<td>
					商品属性：   &nbsp;  &nbsp;  &nbsp;<?php builtSelect('type','type_id','type_id','type_name',$info['type_id'])?></br>
					<span class="notice-span"id="noticeGoodsSN">请选择商品的所属类型，完善此商品的属性.</span>
            	</td>
            	</tr>
            	<tr>
				<td id="tbody-goodsAttr">
					<table width='100%' id='attrTable'>
        				<?php foreach($AttrData as $k=>$v){?>
        					<tr>
        					<td><?php echo $v['attr_name']?>：</td>
        					<input type="hidden" name="goods_attr_id[]" value="<?php echo $v['goods_attr_id']?>">
        					<td><?php if($v['attr_input_type'] == 0){?>
        						<input name="attr_value[<?php echo $v['attr_id']?>][]" type='text' size='15' value="<?php echo $v['goods_attr_value']?>">
        					<?php }else if($v['attr_type'] == 0 && $v['attr_input_type'] == 1 && $v['attr_value'] !=''){ $attr_value = preg_split('/\s+/', $v['attr_value']); ?>
        						<select name="attr_value[<?php echo $v['attr_id']?>][]">
        						<option value=''>请选择...</option>
								
        						<?php foreach($attr_value as $k1=>$v1){?>
        							<option value="<?php echo $v1?>" <?php if($v1 == $v['goods_attr_value']){echo 'selected=selected';} ?>><?php echo $v1?></option>
        						<?php }?>
        						</select>
        					<?php }else if($v['attr_type'] == 1 && $v['attr_input_type'] == 1 && $v['attr_value'] !=''){ $attr_value = preg_split('/\s+/', $v['attr_value']); $goods_attr_value = explode(',',$v['goods_attr_value']); foreach($attr_value as $k2=>$v2){?>
										<?php echo $v2?><input type='checkbox' name="attr_value[<?php echo $v['attr_id']?>][]" value="<?php echo $v2?>" <?php if(in_array($v2,$goods_attr_value)){echo 'checked=checked';}?>>
        						<?php }?>
        					<?php }?></td>
        					</tr>
        				<?php }?>
        			</table>
				<td>
				<tr>
				<td>
					<span style="color:red">*注意：修改商品的属性也要修改库存量*</span>
            	</td>
            	</tr>
				
            </table>
            
            <!-- 商品相册 -->
            <table width="90%" id="gallery-tab-tb" align="center" style="display:none">
            	<?php foreach($pics as $k=>$v){?>
            	<tr id="<?php echo $v['id']?>">
            		<td class="delete_td">
            			<span style='cursor:pointer;'><font color="red">【删除】</font></span>
            			商品相册图片
            		</td>
            		<td>
            			<?php showImage($v['mid_pic'],150)?>
            		</td>
            	</tr>
            	<?php }?>
           		 <tr>
                        <td><span style='cursor:pointer;' onclick="add_item()">[+]</span>商品相册</td>
                        <td><input type='file' name='goods_pics[]' id="goods_pics_0" />
                        <div id="goods_pics_dv_0"><img src="" alt="" width="160" height="160" id="goods_pics_im_0"/></div>
                        </td>
                 </tr>
            </table>
            <div class="button-div">
                <input type="submit" value=" 确定修改 " class="button"/>
                <input type="reset" value=" 重置 " class="button" />
            </div>
        </form>
    </div>
</div>


<!-- 导入在线编辑器 -->
    <link href="/Public/umeditor1_2_2-utf8-php/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="/Public/umeditor1_2_2-utf8-php/third-party/jquery.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Public/umeditor1_2_2-utf8-php/umeditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Public/umeditor1_2_2-utf8-php/umeditor.min.js"></script>
    <script type="text/javascript" src="/Public/umeditor1_2_2-utf8-php/lang/zh-cn/zh-cn.js"></script>
    <script>
    	UM.getEditor('goods_desc',{
    		initialFrameWidth:"100%",
    		initialFrameHeight:300,
    	});
    </script>
    
    <!-- 实现点击添加扩展分类的效果 -->
    <script>
    	$('#cat_btn').click(function(){
    		//获取span
    		$('#cat_td').append($('#clone_cat').clone());
    		$('#cat_td').append('</br>');
    	});
    </script>
    <!-- 实现标签栏点击效果 -->
    <script>
    	$("#tabbar-div p span").click(function(){
    		//全部变标签变暗
    		$("#tabbar-div p span").attr('class','tab-back');
    		//当前的标签高亮显示
    		$(this).attr('class','tab-front');
    		//全部table隐藏
    		$('table').hide();
    		//当前的table显示
    		var id = $(this).attr('id');
    		$("#"+id+"-tb").show();
    		//清空table的style样式
    		$('#tbody-goodsAttr').find('table').attr('style','');
    	});
    </script>
     <!-- 实现点击属性下拉框效果 -->
    <script>
    	$(function(){
    		
    	});
    	$("select[name='type_id']").change(function(){
    		//获取选中的value值，即type_id的值
    		var typeId = $(this).val();
    		//利用ajax根据该type_id的值找出对应的商品属性
    		if(typeId>0){
    			$.ajax({
        			type 		:	'get',
        			url 		:	"<?php echo U('ajaxGetAttr','',false)?>/type_id/"+typeId,
        			dataType 	:	'json',
        			success 	:	function(data){
        				var table = "";
        				//拼装html语句table
        				table += "<table width='100%' id='attrTable'>";
        				//循环data
        				$(data).each(function(k,v){
        					table += "<tr>";
        					table += "<td>"+v.attr_name+"：</td>";
        					table += "<td>";
        					if(v.attr_input_type == 0){
        						//这里拼装的是文本框
        						table += "<input name='attr_value["+v.attr_id+"][]' type='text' size='15'>";
        					}else if(v.attr_type == 0 && v.attr_input_type == 1 && v.attr_value !=''){
        						//这里拼装的是下拉列表
        						table += "<select name='attr_value["+v.attr_id+"][]'>";
        						table += "<option value=''>请选择...</option>";
        						var _attr_value = v.attr_value.split('\r\n');
        						for(var i=0;i<_attr_value.length;i++){
        							table += "<option value='"+_attr_value[i]+"'>"+_attr_value[i]+"</option>";
        						}
        						table += "</select>";
        					}else if(v.attr_type == 1 && v.attr_input_type == 1 && v.attr_value !=''){
        						//这里拼装的是多选框
        						var _attr_value = v.attr_value.split('\r\n');
        						for(var i=0;i<_attr_value.length;i++){
        							table += _attr_value[i]+"<input type='checkbox' name='attr_value["+v.attr_id+"][]' value='"+_attr_value[i]+"'>";
        						}
        					}
        					table += "</td>";
        					table += "</tr>";
        				});
        				table += "</table>";
        				$('#tbody-goodsAttr').html(table);
        			}
        			
        		});
    			
    		}
    		else{
				$('#tbody-goodsAttr').html('');
			}
    	});
    </script>
    <!-- 相册的js代码 -->
     <script type="text/javascript">
                $(function(){
                    new uploadPreview({ UpBtn: "goods_pics_0", DivShow: "goods_pics_dv_0", ImgShow: "goods_pics_im_0" });
                });
    </script>
    <script type="text/javascript" src="/Public/Admin/Js/uploadPreview.js"></script>
    <script type="text/javascript">
                var p_num = 1;  //相册计数器
                function add_item(){
                    //增加相册的项目
                    var s = "<tr><td><span style='cursor:pointer;' onclick='$(this).parent().parent().remove()'>[-]</span>商品相册</td><td><input type='file' name='goods_pics[]' id='goods_pics_"+p_num+"'/><div id='goods_pics_dv_"+p_num+"'><img src='' alt='' width='160' height='160' id='goods_pics_im_"+p_num+"'/></div></td></tr>";
                    $('#gallery-tab-tb').append(s);

                    //设置立即显示上传好的图片效果
                    new uploadPreview({ UpBtn: "goods_pics_"+p_num, DivShow: "goods_pics_dv_"+p_num, ImgShow: "goods_pics_im_"+p_num });

                    p_num++;  //每增加一个相册，计数器的值要累加
                }
    </script>
    
<!-- js和ajax实现单张图片的删除功能 -->
<script>
	$('.delete_td').find('span').click(function(){
		if(window.confirm("你确定要删除吗？")){
			//删除其父节点的父节点
			$(this).parent().parent().remove();
			//利用ajax删除数据库中的图片数据还有服务器中的硬盘数据
			//获得id属性
			var id = $(this).parent().parent().attr('id');
			$.ajax({
				type	:	'GET',
				//url		: 	"<?php echo U('ajaxDelPic',array('picid'=>"+id+"),false)?>",
				url 	:	"<?php echo U('ajaxDelPic','',false)?>/picid/"+id,
				dataType:	'text',	
				success	:	function(data){
					
				}
			});
		}
	});
</script>

<!-- 时间插件 -->
<script type="text/javascript" src="/Public/umeditor1_2_2-utf8-php/third-party/jquery.min.js"></script>
<link href="/Public/datetimepicker/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" charset="utf-8" src="/Public/datetimepicker/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/datetimepicker/datepicker-zh_cn.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="/Public/datetimepicker/time/jquery-ui-timepicker-addon.min.css" />
<script type="text/javascript" src="/Public/datetimepicker/time/jquery-ui-timepicker-addon.min.js"></script>
<script type="text/javascript" src="/Public/datetimepicker/time/i18n/jquery-ui-timepicker-addon-i18n.min.js"></script>
<script>
$.timepicker.setDefaults($.timepicker.regional['zh-CN']);
$("#promote_start_date").datetimepicker();
$("#promote_end_date").datetimepicker();
</script>

<div id="footer">
共执行 9 个查询，用时 0.025161 秒，Gzip 已禁用，内存占用 3.258 MB<br />
版权所有 &copy; 2016-2017 广州市倾出于蓝科技有限公司，并保留所有权利。</div>
</body>
</html>