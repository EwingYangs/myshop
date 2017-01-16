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


<div class="form-div">
    <form action="/index.php/Admin/Goods/lst" method="get" name="searchForm">
        <img id="img_icon" src="/Public/Admin/Images/icon_search.gif" width="26" height="22" border="0" alt="search" />
        <!-- 分类 -->
        <select name="cat_id" onchange="this.parentNode.submit();">
            <option value="0">所有分类</option>
                <?php foreach($category_info as $k=>$v){?>
                <option value="<?php echo $v['cat_id']?>" <?php if(I('get.cat_id') == $v['cat_id']){echo 'selected="selected"';}?>>
                	<?php echo str_repeat("&nbsp;&nbsp;&nbsp;",$v['level']).$v['cat_name']?>
                </option>
            	<?php }?>
        </select>
        <!-- 品牌 -->
        <select name="brand_id" onchange="this.parentNode.submit();">
            <option value="0">所有品牌</option>
            <?php foreach($brand_info as $v){?>
            <option value="<?php echo $v['id']?>" <?php if(I('get.brand_id') == $v['id']){echo 'selected="selected"';}?>><?php echo $v['brand_name']?></option>
            <?php }?>
        </select>
        <!-- 推荐 -->
        <select name="intro_type" onchange="this.parentNode.submit();">
            <option value='' <?php if(I('get.intro_type') == ''){echo 'selected="selected"';}?>>全部</option>
            <option value="推荐" <?php if(I('get.intro_type') == '推荐'){echo 'selected="selected"';}?>>推荐</option>
            <option value="新品" <?php if(I('get.intro_type') == '新品'){echo 'selected="selected"';}?>>新品</option>
            <option value="热销" <?php if(I('get.intro_type') == '热销'){echo 'selected="selected"';}?>>热销</option>
        </select>
        <!-- 上架 -->
        
        <select name="is_on_sale" onchange="this.parentNode.submit();">
            <option value='' <?php if(I('get.is_on_sale') == ''){echo 'selected="selected"';}?>>全部</option>
            <option value="是" <?php if(I('get.is_on_sale') == '是'){echo 'selected="selected"';}?>>上架</option>
            <option value="否" <?php if(I('get.is_on_sale') == '否'){echo 'selected="selected"';}?>>下架</option>
        </select>
       
		添加时间：<input type="text" size="10" name="fa" id="fa" value="<?php echo I('get.fa')?>">
		到<input type="text" size="10" name="dao" id="dao" value="<?php echo I('get.dao')?>">
        <!-- 商品名称 -->
       商品名称： <input type="text" name="goods_name" size="10" value="<?php echo I('get.goods_name')?>" />
        <input type="submit" value=" 搜索 " class="button" />
        排序方式：
			<?php $obdy = I('get.odby', 'id_desc');?>
			<input onclick="this.parentNode.submit();" type="radio" name="odby" value="id_desc" <?php if($obdy == 'id_desc') echo 'checked="checked"'; ?> /> 按时间↓
			<input onclick="this.parentNode.submit();" type="radio" name="odby" value="id_asc" <?php if($obdy == 'id_asc') echo 'checked="checked"'; ?> /> 按时间↑
			<input onclick="this.parentNode.submit();" type="radio" name="odby" value="price_desc" <?php if($obdy == 'price_desc') echo 'checked="checked"'; ?> /> 按价格↓
			<input onclick="this.parentNode.submit();" type="radio" name="odby" value="price_asc" <?php if($obdy == 'price_asc') echo 'checked="checked"'; ?> /> 按价格↑
		
    </form>
</div>

<!-- 商品列表 -->

    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>编号</th>
                <th>商品名称</th>
                <th>品牌名称</th>
                <th>主分类</th>
                <th>扩展分类</th>
                <th>货号</th>
                <th>logo</th>
                <th>价格</th>
                <th>上架</th>
                <th>推荐</th>
                <th>新品</th>
                <th>热销</th>
                <th>库存</th>
                <th>添加时间</th>
                <th width="78">操作</th>
            </tr>
            <?php foreach($data['data'] as $key=>$v){?>
            <tr class="tron">
                <td align="center"><?php echo $key+1 ;?></td>
                <td align="center" class="first-cell"><span><?php echo $v['goods_name']?></span></td>
                <td align="center"><span onclick=""><?php echo $v['brand_name']?></span></td>
                <td align="center"><span onclick=""><?php echo $v['cat_name']?></span></td>
                <td align="center"><span onclick=""><?php echo $v['ext_cat_name']?></span></td>
                <td align="center"><span onclick=""><?php echo $v['goods_sn']?></span></td>
                <td align="center"><a href="/Public/Uploads/<?php echo $v['logo']?>" target="brank"><?php showImage($v['sm_logo'])?></a></td>
                <td align="center"><span><?php echo $v['shop_price']?></span></td>
                <td align="center"><img id="img_yes1" src="<?php if($v['is_on_sale'] == '是') {?> /Public/Admin/Images/yes.gif <?php }else{ ?> /Public/Admin/Images/no.gif <?php }?>"/></td>
                <td align="center"><img id="img_yes2" src="<?php if($v['is_rec'] == '推荐') {?> /Public/Admin/Images/yes.gif <?php }else{ ?> /Public/Admin/Images/no.gif <?php }?>"/></td>
                <td align="center"><img id="img_yes3" src="<?php if($v['is_new'] == '新品') {?> /Public/Admin/Images/yes.gif <?php }else{ ?> /Public/Admin/Images/no.gif <?php }?>"/></td>
                <td align="center"><img id="img_yes4" src="<?php if($v['is_hot'] == '热销') {?> /Public/Admin/Images/yes.gif <?php }else{ ?> /Public/Admin/Images/no.gif <?php }?>"/></td>
                <td align="center"><span><?php echo $v['goods_number']?></span></td>
                <td align="center"><span><?php echo $v['addtime']?></span></td>
                <td align="center">
                <a href="<?php echo U('goods_number?id='.$v['id']);?>" title="商品库存量"><img id="img_account" src="/Public/Admin/Images/icon_account.gif" width="16" height="16" border="0" /></a>
                <a href="/index.php/Goods/?goods_id=<<?php echo ($val["goods_id"]); ?>>" target="_blank" title="查看"><img id="img_view" src="/Public/Admin/Images/icon_view.gif" width="16" height="16" border="0" /></a>
                <a href="<?php echo U('edit?id='.$v['id']);?>" title="编辑"><img id="img_edit" src="/Public/Admin/Images/icon_edit.gif" width="16" height="16" border="0" /></a>
                <a href="<?php echo U('delete?id='.$v['id']);?>" onclick="return confirm('你确定要删除吗？');" title="回收站"><img id="img_trash" src="/Public/Admin/Images/icon_trash.gif" width="16" height="16" border="0" /></a></td>
            </tr>
            <?php }?>
        </table>

    <!-- 分页开始 -->
        <table id="page-table" cellspacing="0">
            <tr>
                <td width="80%">&nbsp;</td>
                <td align="center" nowrap="true">
                    <?php echo $data['page']; ?>
                </td>
            </tr>
        </table>
    <!-- 分页结束 -->
    </div>

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
$("#fa").datetimepicker();
$("#dao").datetimepicker();
</script>
<script type="text/javascript" src="/Public/Admin/js/tron.js">
</script>







<div id="footer">
共执行 9 个查询，用时 0.025161 秒，Gzip 已禁用，内存占用 3.258 MB<br />
版权所有 &copy; 2016-2017 广州市倾出于蓝科技有限公司，并保留所有权利。</div>
</body>
</html>