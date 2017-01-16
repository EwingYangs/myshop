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


<div class="main-div">
<div id="tabbar-div">
        <p>
            <span class="tab-front" id="general-tab">通用信息</span>
        </p>
    </div>
    <form name="main_form" method="POST" action="/index.php/Admin/Brand/edit/id/1.html" enctype="multipart/form-data" >
    	<input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
		<input type="hidden" name="old_logo" value="<?php echo $data['logo']; ?>" />
		<input type="hidden" name="old_big_logo" value="<?php echo $data['big_logo']; ?>" />
		<input type="hidden" name="old_mid_logo" value="<?php echo $data['mid_logo']; ?>" />
		<input type="hidden" name="old_sm_logo" value="<?php echo $data['sm_logo']; ?>" />
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">品牌名称：</td>
                <td>
                    <input  type="text" name="brand_name" value="<?php echo $data['brand_name']; ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">品牌官网：</td>
                <td>
                    <input  type="text" name="url" value="<?php echo $data['url']; ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">品牌logo：</td>
                <td>
                	<input type="file" name="logo" /><br /> 
                	<?php showImage($data['logo'], 100); ?>                </td>
            </tr>
            <tr>
                <td class="label">品牌描述：</td>
                <td>
                	<textarea name="brand_desc" rows="6" cols="40"><?php echo $data['brand_desc']; ?></textarea>
                </td>
            </tr>
            <tr>
                <td class="label">排序依据：</td>
                <td>
                    <input  type="text" name="sort_order" value="<?php echo $data['sort_order']; ?>" />
                </td>
            </tr>
            <tr>
                <td colspan="99" align="center">
                    <input type="submit" class="button" value=" 确定 " />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
    </form>
</div>


<script>
</script>

<div id="footer">
共执行 9 个查询，用时 0.025161 秒，Gzip 已禁用，内存占用 3.258 MB<br />
版权所有 &copy; 2016-2017 广州市倾出于蓝科技有限公司，并保留所有权利。</div>
</body>
</html>