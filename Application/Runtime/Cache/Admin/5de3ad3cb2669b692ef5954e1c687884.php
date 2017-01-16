<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>NBSHOP 管理中心 - <?php echo $_page_title?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
<link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
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


<div class="main-div">
    <form name="theForm" method="POST" action="/index.php/Admin/Attribute/edit/attr_id/26/type_id/1.html" enctype="multipart/form-data" >
    	<input type="hidden" name="attr_id" value="<?php echo $data['attr_id']; ?>" />
        <table width="100%" id="general-table">
      <tbody><tr>
        <td class="label">属性名称：</td>
        <td>
          <input type="text" name="attr_name" value="<?php echo $data['attr_name']?>" size="30">
          <span class="require-field">*</span>        </td>
      </tr>
      <tr>
        <td class="label">所属商品类型：</td>
        <td>
          <?php builtSelect('type','type_id','type_id','type_name',I('get.type_id'),'')?>
          <span class="require-field">*</span>        
        </td>
      </tr>
      
      <tr>
        <td class="label"><a href="javascript:showNotice('noticeAttrType');" title="点击此处查看提示信息"><img id="notice_icon" src="/Public/Admin/Images/notice.gif" width="16" height="16" border="0" alt="点击此处查看提示信息"></a>属性是否可选</td>
        <td>
          <input type="radio" name="attr_type" value="0" <?php if($data['attr_type'] == '0'){echo 'checked=checked';}?>> 唯一属性          <input type="radio" name="attr_type" value="1" <?php if($data['attr_type'] == '1'){echo 'checked=checked';}?>> 单选属性                  <br><span class="notice-span" style="display:block" id="noticeAttrType">选择"单选/复选属性"时，可以对商品该属性设置多个值，同时还能对不同属性值指定不同的价格加价，用户购买商品时需要选定具体的属性值。选择"唯一属性"时，商品的该属性值只能设置一个值，用户只能查看该值。</span>
        </td>
      </tr>
      <tr>
        <td class="label">该属性值的录入方式：</td>
        <td>
          <input type="radio" name="attr_input_type" value="0" <?php if($data['attr_input_type'] == '0'){echo 'checked=checked';}?> onclick="radioClicked(0)">
          手工录入          <input type="radio" name="attr_input_type" value="1" onclick="radioClicked(1)" <?php if($data['attr_input_type'] == '1'){echo 'checked=checked';}?>>
          从下面的列表中选择（一行代表一个可选值）                  
        </td>
      </tr>
      <tr>
        <td class="label">可选值列表：</td>
       <td>
          <textarea name="attr_value" cols="30" rows="5" <?php if(empty($data['attr_value'])){echo "disabled=''";}?>><?php if(!empty($data['attr_value'])){echo $data['attr_value'];}?></textarea>
        </td>
      </tr>
      <tr>
        <td colspan="2">
        <div class="button-div">
          <input type="submit" value=" 确定 " class="button">
          <input type="reset" value=" 重置 " class="button">
        </div>
        </td>
      </tr>
      </tbody></table>
    </form>
</div>



<script type="text/javascript">
/**
 * 点击类型按钮时切换选项的禁用状态
 */
function radioClicked(n)
{
  document.forms['theForm'].elements["attr_value"].disabled = n > 0 ? false : true;
}


</script>

<div id="footer">
共执行 9 个查询，用时 0.025161 秒，Gzip 已禁用，内存占用 3.258 MB<br />
版权所有 &copy; 2016-2017 广州市倾出于蓝科技有限公司，并保留所有权利。</div>
</body>
</html>