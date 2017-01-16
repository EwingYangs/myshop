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
<div class="form-div">
  <form action="/index.php/Admin/Attribute/lst" name="searchForm" method="get">
    <img id="search_icon" src="/Public/Admin/Images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH">
    按商品类型显示：
    <select name="type_id" onchange="this.parentNode.submit();">
        <?php foreach($type as $v){?>
            <option value="<?php echo $v['type_id']?>" <?php if($v['type_id'] == I('get.type_id')){echo 'selected=selected';}?>><?php echo $v['type_name']?>
            </option>
        <?php }?>    
    </select>
  </form>
</div>

<div class="list-div" id="listDiv">

  <table cellpadding="3" cellspacing="1">
    <tbody>
		<tr>
      <th><input onclick="selectAll(this)" type="checkbox">编号 </th>
			<th>属性名称</th>
			<th>商品类型</th>
			<th>属性是否可选</th>
			<th>属性值的录入方式</th>
			<th>可选值列表</th>
			<th>操作</th>
		</tr>
      <?php foreach($data as $key=>$v){?>
        <tr class="tron">
			<td nowrap="true" valign="top"><span><input value="<?php echo $v['attr_id']?>" name="checkboxes[]" type="checkbox" onclick="show_delete(this.value)"><?php echo $key+1?></span></td>
			<td class="first-cell" nowrap="true" valign="top"><span onclick="listTable.edit(this, 'edit_attr_name', 1)"><?php echo $v['attr_name']?></span></td>
			<td nowrap="true" valign="top">
        <span><?php echo $v['type_name']?></span>
      </td>
     <td nowrap="true" valign="top">
      <span>
          <?php  if($v['attr_type'] == 0){ echo '唯一'; }else if($v['attr_type'] == 1){ echo '单选'; } ?>
      </span>
    </td>
	<td nowrap="true" valign="top">
      <span>
          <?php  if($v['attr_input_type'] == 0){ echo '手工录入'; }else if($v['attr_input_type'] == 1){ echo '从列表中选择'; } ?>
      </span>
    </td>
			<td valign="top"><span><?php echo $v['attr_value'];?></span></td>
			
			<td align="center" nowrap="true" valign="top">
				<a href="<?php echo U('edit?attr_id='.$v['attr_id'].'&type_id='.I('get.type_id')); ?>" title="编辑"><img id="edit_icon" src="/Public/Admin/Images/icon_edit.gif" border="0" height="16" width="16"></a>
				<a href="<?php echo U('delete?attr_id='.$v['attr_id'].'&type_id='.I('get.type_id')); ?>" onclick="javascript:return window.confirm('你确定要删除吗？')" title="移除"><img id="drop_icon" src="/Public/Admin/Images/icon_drop.gif" border="0" height="16" width="16"></a>
			</td>
      <?php }?>
		</tr>
		<?php if(preg_match('/\d/', $page)): ?>  
        <tr><td align="right" nowrap="true" colspan="99" height="30"><?php echo $page; ?></td></tr> 
        <?php endif; ?> 
      </tbody>
    
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