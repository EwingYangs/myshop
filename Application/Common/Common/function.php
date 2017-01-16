<?php
//************发邮件**************
function sendMail($to,$title,$content){
    //引入类文件
    require ROOT.'/PHPMailer/_lib/class.phpmailer.php';
    $mail = new PHPMailer();
    //设置为要发邮件
    $mail->IsSMTP();
    //是否允许发送HTML代码为邮件内容
    $mail->IsHTML(true);
    $mail->CharSet='UTF-8';
    //是否需要身份验证
    $mail->SMTPAuth = TRUE;
    //邮件账号和密码的配置
    $mailInfo = C('EMAIL');
    $mail->From = $mailInfo['user'].'@163.com';
    $mail->FromName = $mailInfo['user'];
    $mail->Host = $mailInfo['host'];
    $mail->Username = $mailInfo['user'];
    $mail->Password = $mailInfo['password'];
    //设置端口号
    $mail->Port = 25;
    //收件人$to
    $mail->AddAddress($to);
    //标题
    $mial->Subject = $title;
    //邮件内容
    $mail->Body = $content;
    return ($mail->Send());
}



//搜索中获取正则匹配后的Url
function filterUrl($param){
    //取出当前的url地址
    $url = $_SERVER['PHP_SELF'];
    //构建正则
    $re = "/\/$param\/[^\/]+/";
    return preg_replace($re,'', $url);
}
/*
 * 生成支付宝支付的按钮
 */
function builtAlipayBtn($order_id,$btnName="去支付宝支付"){
    return require('./alipay/alipayapi.php');
}


/**
 * 构造一个建立下拉框的函数
 * @param 表的名字 $tableName
 * @param 下拉框的名字 $selectName
 * @param option的值 $valueName
 * @param option里面的文本 $textName
 * @param 被选中的内容 $selectedValue
 */
function builtSelect($tableName,$selectName,$valueName,$textName,$selectedValue,$value='0'){
    //从表中取出数据
    $data = D($tableName)->field("$valueName,$textName")->select();
    $select = "<select name='$selectName' ><option value=$value>请选择...</option>";
    foreach($data as $k=>$v){
        if($selectedValue && $selectedValue == $v[$valueName]){
               $selected = "selected = selected";
        }else{
               $selected = "";
        }
        $select .= '<option '.$selected.' value="'.$v[$valueName].'">'.$v[$textName].'</option>';
    }
    $select .= "</select>";
    echo $select;
}




/**
 * 上传图片并生成缩略图
 * 用法：
 * $ret = uploadOne('logo', 'Goods', array(
 array(600, 600),
 array(300, 300),
 array(100, 100),
 ));
 返回值：
 if($ret['ok'] == 1)
 {
 $ret['images'][0];   // 原图地址
 $ret['images'][1];   // 第一个缩略图地址
 $ret['images'][2];   // 第二个缩略图地址
 $ret['images'][3];   // 第三个缩略图地址
 }
 else
 {
 $this->error = $ret['error'];
 return FALSE;
 }
 *
 */
function uploadOne($imgName, $dirName, $thumb = array())
{
    // 上传LOGO
    if(isset($_FILES[$imgName]) && $_FILES[$imgName]['error'] == 0)
    {
        $ic = C('IMAGE_CONFIG');
        $upload = new \Think\Upload(array(
            'rootPath' => $ic['rootPath'],
            'maxSize' => $ic['maxSize'],
            'exts' => $ic['exts'],
        ));// 实例化上传类
        $upload->savePath = $dirName . '/'; // 图片二级目录的名称
        // 上传文件
        // 上传时指定一个要上传的图片的名称，否则会把表单中所有的图片都处理，之后再想其他图片时就再找不到图片了
        $info   =   $upload->upload(array($imgName=>$_FILES[$imgName]));
        if(!$info)
        {
            return array(
                'ok' => 0,
                'error' => $upload->getError(),
            );
        }
        else
        {
            $ret['ok'] = 1;
            $ret['images'][0] = $logoName = $info[$imgName]['savepath'] . $info[$imgName]['savename'];
            // 判断是否生成缩略图
            if($thumb)
            {
                $image = new \Think\Image();
                // 循环生成缩略图
                foreach ($thumb as $k => $v)
                {
                    $ret['images'][$k+1] = $info[$imgName]['savepath'] . 'thumb_'.$k.'_' .$info[$imgName]['savename'];
                    // 打开要处理的图片
                    $image->open($ic['rootPath'].$logoName);
                    $image->thumb($v[0], $v[1])->save($ic['rootPath'].$ret['images'][$k+1]);
                }
            }
            return $ret;
        }
    }
}


//**********封装删除图片的函数*************
function deleteImage($image = array())
{
    $savePath = C('IMAGE_CONFIG');
    foreach ($image as $v)
    {
        unlink($savePath['rootPath'] . $v);
    }
}

//***********封装显示图片的方法****************
function showImage($url,$width='',$height=''){
       $ic = C('IMAGE_CONFIG');//获得图片的配置信息
       if($width){
           $width = "width=".$width;
       }
       if($height){
           $height = "height=".$height;
       }
       echo "<img $height $width src='{$ic['viewPath']}$url' />";//输出图片的信息
}

// 有选择性的过滤XSS --》 说明：性能非常低-》尽量少用
function removeXXS($data)
{
	require_once './HtmlPurifier/HTMLPurifier.auto.php';
	$_clean_xss_config = HTMLPurifier_Config::createDefault();
	$_clean_xss_config->set('Core.Encoding', 'UTF-8');
	// 设置保留的标签
	$_clean_xss_config->set('HTML.Allowed','div,b,strong,i,em,a[href|title],ul,ol,li,p[style],br,span[style],img[width|height|alt|src]');
	$_clean_xss_config->set('CSS.AllowedProperties', 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align');
	$_clean_xss_config->set('HTML.TargetBlank', TRUE);
	$_clean_xss_obj = new HTMLPurifier($_clean_xss_config);
	// 执行过滤
	return $_clean_xss_obj->purify($data);
}