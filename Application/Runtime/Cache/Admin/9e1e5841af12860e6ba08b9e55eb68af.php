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


<!-- 列表 -->
<div class="list-div" id="listDiv">
	<table cellpadding="3" cellspacing="1">
    	<tr>
            <th>类型名称</th>
            <th>属性数</th>
			<th width="120">操作</th>
        </tr>
		<?php foreach ($data as $k => $v): ?>            
			<tr class="tron">
				<td><?php echo $v['type_name']; ?></td>
				<td><?php echo $v['type_num']; ?></td>
		        <td align="center">
		        	<a href="<?php echo U('Attribute/lst?type_id='.$v['type_id']); ?>" title="属性列表"><img id="edit_icon" src="/Public/Admin/Images/icon_edit.gif" border="0" height="16" width="16"></a> 
		        	<a href="<?php echo U('edit?type_id='.$v['type_id'].'&p='.I('get.p')); ?>" title="编辑"><img id="edit_icon" src="/Public/Admin/Images/icon_edit.gif" border="0" height="16" width="16"></a> 
	                <a href="<?php echo U('delete?type_id='.$v['type_id'].'&p='.I('get.p')); ?>" onclick="return confirm('确定要删除吗？');" title="移除"><img id="drop_icon" src="/Public/Admin/Images/icon_drop.gif" border="0" height="16" width="16"></a> 
		        </td>
	        </tr>
        <?php endforeach; ?> 
		<?php if(preg_match('/\d/', $page)): ?>  
        <tr><td align="right" nowrap="true" colspan="99" height="30"><?php echo $page; ?></td></tr> 
        <?php endif; ?> 
	</table>
</div>

<script>
</script>

<script src="/Public/Admin/Js/tron.js"></script>

<div id="footer">
共执行 9 个查询，用时 0.025161 秒，Gzip 已禁用，内存占用 3.258 MB<br />
版权所有 &copy; 2016-2017 广州市倾出于蓝科技有限公司，并保留所有权利。</div>
</body>
</html>