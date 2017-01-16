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


<!-- 商品列表 -->
<form method="post" action="/index.php/Admin/Goods/goods_number/id/20.html" name="listForm">
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
               <?php foreach($_gaData as $k=>$v){?>
               	<th><?php echo $k; ?></th>
               <?php }?>
               	<th>库存</th>
                <th>操作</th>
            </tr>
            <?php if($goods_number){ foreach($goods_number as $k0=>$v0){ $goods_attr_ids = explode(',',$v0['goods_attr_id']); ?>
            <tr id="tr_obj">
            	<?php
 $count = count($_gaData); foreach($_gaData as $k2=>$v2){ ?>
            		<td>
            			<select name="goods_attr_id[]">
            				<option value=''>请选择...</option>
            				<?php foreach($v2 as $k3=>$v3){?>
            					<option value="<?php echo $v3['id']?>" <?php if(in_array($v3['id'],$goods_attr_ids)){echo 'selected=selected';}?>>
            						<?php echo $v3['attr_value']?>
            					</option>
            				<?php }?>
            			</select>
            		</td>
            	<?php }?>
            	<td width="180">
               <input type="text" size="22" name="goods_number[]" value="<?php echo $v0['goods_number']?>">
            	</td>
            	<td align="center">
                <a href="javascript:"><img onclick="add(this)" class="img_add" <?php echo $k0 == 0? 'src="/Public/Admin/Images/btn_maximize.gif"' : 'src="/Public/Admin/Images/btn_minimize.gif"'?> width="20" height="20" border="0" /></a>
            	</td>
            </tr>
            <?php }?>
			<?php }else{?>
            <tr id="tr_obj">
            	<?php
 $count = count($_gaData); foreach($_gaData as $k1=>$v2){?>
            		<td>
            			<select name="goods_attr_id[]">
            				<option value=''>请选择...</option>
            				<?php foreach($v2 as $k3=>$v3){?>
            					<option value="<?php echo $v3['id']?>">
            						<?php echo $v3['attr_value']?>
            					</option>
            				<?php }?>
            			</select>
            		</td>
            	<?php }?>
            	<td width="180">
               <input type="text" size="22" name="goods_number[]">
            	</td>
            	<td align="center">
                <a href="javascript:"><img onclick="add(this)" class="img_add" src="/Public/Admin/Images/btn_maximize.gif" width="20" height="20" border="0" /></a>
            	</td>
            </tr>
            <?php }?>
      		<tr>
      			<td align="center" colspan="<?php echo $count+2?>"><input type="submit" value="提交">&nbsp;<input type="reset" value="重置"></td>
      		</tr>
        </table>

    </div>
</form>


<script type="text/javascript" src="/Public/Admin/js/tron.js">
</script>
	
<script>

function add(img_obj){
	var tr = $(img_obj).parent().parent().parent();
	if($(img_obj).attr('src') == '/Public/Admin/Images/btn_maximize.gif'){
		var newTr = tr.clone();
		newTr.find('img').attr('src','/Public/Admin/Images/btn_minimize.gif');
		tr.after(newTr);
	}else{
		tr.remove();
	}
}
</script>





<div id="footer">
共执行 9 个查询，用时 0.025161 秒，Gzip 已禁用，内存占用 3.258 MB<br />
版权所有 &copy; 2016-2017 广州市倾出于蓝科技有限公司，并保留所有权利。</div>
</body>
</html>