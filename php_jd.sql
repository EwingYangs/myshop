-- phpMyAdmin SQL Dump
-- version 4.0.3
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016 �?11 �?19 �?13:37
-- 服务器版本: 10.1.9-MariaDB-log
-- PHP 版本: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;



-- --------------------------------------------------------

--
-- 表的结构 `p39_admin`
--

CREATE TABLE IF NOT EXISTS `p39_admin` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `username` varchar(30) NOT NULL COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '密码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='管理员' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `p39_admin`
--

INSERT INTO `p39_admin` (`id`, `username`, `password`) VALUES
(1, 'root', '21232f297a57a5a743894a0e4a801fc3'),
(3, 'yjy', '827ccb0eea8a706c4c34a16891f84e7b'),
(4, 'zwt', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- 表的结构 `p39_admin_role`
--

CREATE TABLE IF NOT EXISTS `p39_admin_role` (
  `admin_id` mediumint(8) unsigned NOT NULL COMMENT '管理员id',
  `role_id` mediumint(8) unsigned NOT NULL COMMENT '角色id',
  KEY `admin_id` (`admin_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员角色';

--
-- 转存表中的数据 `p39_admin_role`
--

INSERT INTO `p39_admin_role` (`admin_id`, `role_id`) VALUES
(3, 8),
(4, 6),
(4, 8);

-- --------------------------------------------------------

--
-- 表的结构 `p39_attribute`
--

CREATE TABLE IF NOT EXISTS `p39_attribute` (
  `attr_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品属性ID',
  `attr_name` varchar(50) NOT NULL DEFAULT '' COMMENT '商品属性名称',
  `type_id` smallint(6) NOT NULL DEFAULT '0' COMMENT '商品属性所属类型ID',
  `attr_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '属性是否可选 0 为唯一，1为可选',
  `attr_input_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '属性录入方式 0为手工录入，1为从列表中选择',
  `attr_value` text COMMENT '属性的值',
  PRIMARY KEY (`attr_id`),
  KEY `type_id` (`type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- 转存表中的数据 `p39_attribute`
--

INSERT INTO `p39_attribute` (`attr_id`, `attr_name`, `type_id`, `attr_type`, `attr_input_type`, `attr_value`) VALUES
(16, '内存', 1, 1, 1, '128G\r\n64G\r\n32G\r\n16G\r\n8G'),
(17, '颜色', 1, 1, 1, '黑色\r\n白色\r\n灰色\r\n紫色'),
(24, '电池容量', 1, 0, 0, NULL),
(26, '厂商', 1, 0, 1, '富水康\r\n富士康\r\n富土康'),
(23, '服务商', 1, 1, 1, '移动\r\n电信'),
(27, '屏幕尺寸', 1, 0, 0, NULL),
(28, '屏幕尺寸', 2, 0, 0, NULL),
(29, '产地', 2, 0, 0, NULL),
(30, '操作系统', 2, 1, 1, 'window\r\n安卓');

-- --------------------------------------------------------

--
-- 表的结构 `p39_brand`
--

CREATE TABLE IF NOT EXISTS `p39_brand` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `brand_name` varchar(30) NOT NULL COMMENT '品牌名称',
  `url` varchar(150) NOT NULL DEFAULT '' COMMENT '品牌官网',
  `brand_desc` varchar(255) NOT NULL DEFAULT '' COMMENT '品牌描述',
  `sort_order` tinyint(3) unsigned NOT NULL DEFAULT '50' COMMENT '排序依据',
  `logo` varchar(150) NOT NULL DEFAULT '' COMMENT '品牌logo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='品牌' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `p39_brand`
--

INSERT INTO `p39_brand` (`id`, `brand_name`, `url`, `brand_desc`, `sort_order`, `logo`) VALUES
(1, '魅族', 'www.meizu.com', '魅族科技，是智能手机厂商魅族科技有限公司的简称，成立于2003年3月，是一家国内外知名智能手机厂商，总部位于中...', 49, 'Brand/2016-10-31/581708f85408a.jpg'),
(2, '华为', 'www.huawei.com', '华为是全球领先的信息与通信解决方案供应商。我们围绕客户的需求持续创新,与合作伙伴开放合作,在电信网络、终端和云计算等领域构筑了端到端的解决方案优势。我们致力...', 50, 'Brand/2016-10-31/581759a94668a.jpg'),
(3, '优衣库', 'wwww.youyiku.com', '优衣库', 50, 'Brand/2016-11-16/582bb69f518c8.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `p39_cart`
--

CREATE TABLE IF NOT EXISTS `p39_cart` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品Id',
  `goods_attr_id` varchar(150) NOT NULL DEFAULT '' COMMENT '商品属性Id',
  `goods_number` mediumint(8) unsigned NOT NULL COMMENT '购买的数量',
  `member_id` mediumint(8) unsigned NOT NULL COMMENT '会员Id',
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='购物车' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `p39_category`
--

CREATE TABLE IF NOT EXISTS `p39_category` (
  `cat_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `cat_name` varchar(30) NOT NULL COMMENT '分类名称',
  `parent_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '父类id',
  `unit` varchar(15) NOT NULL DEFAULT '' COMMENT '数量单位',
  `is_floor` varchar(45) NOT NULL DEFAULT '否',
  PRIMARY KEY (`cat_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='分类' AUTO_INCREMENT=24 ;

--
-- 转存表中的数据 `p39_category`
--

INSERT INTO `p39_category` (`cat_id`, `cat_name`, `parent_id`, `unit`, `is_floor`) VALUES
(1, '家用电器', 0, '', '是'),
(2, '手机、数码、京东通信', 0, '', '是'),
(3, '电脑、办公', 0, '', '否'),
(4, '家居、家具、家装、厨具', 0, '', '否'),
(5, '男装、女装、内衣、珠宝', 0, '', '否'),
(6, '个护化妆', 0, '', '否'),
(8, '运动户外', 0, '', '否'),
(9, '汽车、汽车用品', 0, '', '否'),
(10, '母婴、玩具乐器', 0, '', '否'),
(11, '食品、酒类、生鲜、特产', 0, '', '否'),
(12, '营养保健', 0, '', '否'),
(13, '图书、音像、电子书', 0, '', '否'),
(14, '彩票、旅行、充值、票务', 0, '', '否'),
(15, '理财、众筹、白条、保险', 0, '', '否'),
(16, '大家电', 1, '', '否'),
(17, '生活电器', 1, '', '是'),
(18, '厨房电器', 1, '', '是'),
(19, '个护健康', 1, '', '是'),
(20, '五金家装', 1, '', '否'),
(21, 'iphone', 2, '', '是'),
(22, '冰箱', 16, '', '否'),
(23, '手机', 2, '部', '是');

-- --------------------------------------------------------

--
-- 表的结构 `p39_comment`
--

CREATE TABLE IF NOT EXISTS `p39_comment` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品Id',
  `member_id` mediumint(8) unsigned NOT NULL COMMENT '会员Id',
  `content` varchar(200) NOT NULL COMMENT '内容',
  `addtime` datetime NOT NULL COMMENT '发表时间',
  `star` tinyint(3) unsigned NOT NULL COMMENT '分值',
  `click_count` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '有用的数字',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='评论' AUTO_INCREMENT=35 ;

--
-- 转存表中的数据 `p39_comment`
--

INSERT INTO `p39_comment` (`id`, `goods_id`, `member_id`, `content`, `addtime`, `star`, `click_count`) VALUES
(1, 10, 1, '11', '2016-11-17 11:59:54', 5, 0),
(2, 10, 1, '11', '2016-11-17 12:04:50', 5, 0),
(3, 10, 1, '11', '2016-11-17 14:52:05', 5, 0),
(4, 10, 1, '22', '2016-11-17 14:52:09', 5, 0),
(5, 10, 1, '33', '2016-11-17 14:52:13', 5, 0),
(6, 10, 1, '44', '2016-11-17 14:52:18', 5, 0),
(7, 10, 1, '55', '2016-11-17 14:52:23', 5, 0),
(8, 10, 1, '66', '2016-11-17 14:52:27', 5, 0),
(9, 10, 1, '77', '2016-11-17 14:52:31', 5, 0),
(10, 10, 1, '88', '2016-11-17 14:52:35', 5, 0),
(11, 10, 1, '99', '2016-11-17 16:57:16', 5, 0),
(12, 10, 1, '110', '2016-11-17 17:02:19', 5, 0),
(13, 10, 1, '2222', '2016-11-17 17:34:19', 3, 0),
(14, 10, 1, '333', '2016-11-17 17:34:58', 1, 0),
(15, 10, 1, '测试一下！', '2016-11-17 23:06:47', 5, 0),
(16, 10, 1, '测试', '2016-11-17 23:09:39', 5, 0),
(17, 10, 1, '测试', '2016-11-17 23:10:06', 2, 0),
(18, 10, 1, '测试！', '2016-11-17 23:21:52', 5, 0),
(19, 10, 1, '测试', '2016-11-17 23:23:20', 5, 0),
(20, 10, 1, '测试', '2016-11-17 23:30:02', 5, 0),
(21, 10, 1, '测试', '2016-11-17 23:30:04', 5, 0),
(22, 10, 1, '测试', '2016-11-17 23:30:04', 5, 0),
(23, 10, 1, '测试', '2016-11-17 23:30:04', 5, 0),
(24, 10, 1, '测试', '2016-11-17 23:30:05', 5, 0),
(25, 10, 1, '测试', '2016-11-17 23:30:05', 5, 0),
(26, 10, 1, '测试', '2016-11-17 23:30:05', 5, 0),
(27, 10, 1, '测试', '2016-11-17 23:30:18', 5, 0),
(28, 10, 1, '测试', '2016-11-17 23:30:34', 5, 1),
(29, 10, 1, '测试', '2016-11-17 23:30:38', 5, 0),
(30, 10, 1, '测试', '2016-11-17 23:31:22', 5, 0),
(31, 10, 1, '测试', '2016-11-17 23:31:37', 2, 0),
(32, 10, 1, '666', '2016-11-17 23:44:22', 3, 0),
(33, 10, 1, '777', '2016-11-17 23:45:01', 4, 0),
(34, 10, 1, '6的', '2016-11-18 10:19:09', 4, 4);

-- --------------------------------------------------------

--
-- 表的结构 `p39_comment_reply`
--

CREATE TABLE IF NOT EXISTS `p39_comment_reply` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `comment_id` mediumint(8) unsigned NOT NULL COMMENT '评论Id',
  `member_id` mediumint(8) unsigned NOT NULL COMMENT '会员Id',
  `content` varchar(200) NOT NULL COMMENT '内容',
  `addtime` datetime NOT NULL COMMENT '发表时间',
  PRIMARY KEY (`id`),
  KEY `comment_id` (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='评论回复' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `p39_comment_reply`
--

INSERT INTO `p39_comment_reply` (`id`, `comment_id`, `member_id`, `content`, `addtime`) VALUES
(1, 33, 1, '你6的', '2016-11-18 09:25:44'),
(2, 33, 1, '呵呵', '2016-11-18 09:26:32'),
(3, 32, 1, '稳', '2016-11-18 09:59:26'),
(4, 33, 1, '稳如狗', '2016-11-18 10:10:18'),
(5, 33, 1, '666', '2016-11-18 10:13:08'),
(6, 34, 1, '哈哈', '2016-11-18 10:19:16');

-- --------------------------------------------------------

--
-- 表的结构 `p39_goods`
--

CREATE TABLE IF NOT EXISTS `p39_goods` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `goods_sn` varchar(18) NOT NULL COMMENT '商品货号',
  `goods_name` varchar(150) NOT NULL COMMENT '商品名称',
  `market_price` decimal(10,2) NOT NULL COMMENT '市场价格',
  `shop_price` decimal(10,2) NOT NULL COMMENT '本店价格',
  `goods_desc` longtext COMMENT '商品描述',
  `cat_id` mediumint(9) NOT NULL DEFAULT '0' COMMENT '商品分类',
  `brand_id` mediumint(9) NOT NULL DEFAULT '0' COMMENT '商品品牌',
  `type_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '类型Id',
  `is_on_sale` enum('是','否') NOT NULL DEFAULT '是' COMMENT '是否上架',
  `is_delete` enum('是','否') NOT NULL DEFAULT '否' COMMENT '是否放到回收站',
  `is_rec` enum('推荐','不推荐') NOT NULL DEFAULT '不推荐' COMMENT '推荐与否',
  `is_hot` enum('热销','不热销') NOT NULL DEFAULT '不热销' COMMENT '热销与否',
  `is_new` enum('新品','不新品') NOT NULL DEFAULT '不新品' COMMENT '新品与否',
  `addtime` datetime NOT NULL COMMENT '添加时间',
  `logo` varchar(150) NOT NULL DEFAULT '' COMMENT '原图',
  `sm_logo` varchar(150) NOT NULL DEFAULT '' COMMENT '小图',
  `mid_logo` varchar(150) NOT NULL DEFAULT '' COMMENT '中图',
  `big_logo` varchar(150) NOT NULL DEFAULT '' COMMENT '大图',
  `mbig_logo` varchar(150) NOT NULL DEFAULT '' COMMENT '更大图',
  `promote_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `promote_start_date` datetime NOT NULL,
  `promote_end_date` datetime NOT NULL,
  `sort_num` tinyint(4) NOT NULL DEFAULT '100',
  `is_updated` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `shop_price` (`shop_price`),
  KEY `addtime` (`addtime`),
  KEY `cat_id` (`cat_id`),
  KEY `brand_id` (`brand_id`),
  KEY `promote_price` (`promote_price`),
  KEY `promote_start_date` (`promote_start_date`),
  KEY `promote_end_dae` (`promote_end_date`),
  KEY `sort_num` (`sort_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商品' AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `p39_goods`
--

INSERT INTO `p39_goods` (`id`, `goods_sn`, `goods_name`, `market_price`, `shop_price`, `goods_desc`, `cat_id`, `brand_id`, `type_id`, `is_on_sale`, `is_delete`, `is_rec`, `is_hot`, `is_new`, `addtime`, `logo`, `sm_logo`, `mid_logo`, `big_logo`, `mbig_logo`, `promote_price`, `promote_start_date`, `promote_end_date`, `sort_num`, `is_updated`) VALUES
(1, '2016103126838', 'iphone6', '4999.00', '4599.00', '<p><em>iPhone 6</em>是苹果公司（Apple）在2014年9月9日推出的一款手机，已于2014年9月19日正式上市。<em>iPhone 6</em>采用4.7英寸屏幕，分辨率为1334*750像素，内置64位构架的苹果A8处理器，性能...   \r\n                </p>', 0, 0, 0, '是', '否', '不推荐', '不热销', '新品', '2016-10-30 10:07:38', 'Goods/2016-10-30/581555ea0ad46.jpg', 'Goods/2016-10-30/sm_581555ea0ad46.jpg', 'Goods/2016-10-30/mid_581555ea0ad46.jpg', 'Goods/2016-10-30/big_581555ea0ad46.jpg', 'Goods/2016-10-30/mbig_581555ea0ad46.jpg', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 100, 0),
(2, '2016103164015', '魅族MX6', '1999.00', '1499.00', '<p><img src="http://www.39.com/Public/umeditor1_2_2-utf8-php/php/upload/20161031/14778832814058.jpg" alt="14778832814058.jpg" />meizu<br /></p>', 0, 1, 0, '是', '否', '不推荐', '热销', '新品', '2016-10-30 10:10:31', 'Goods/2016-10-31/5816bc6c85b0a.jpg', 'Goods/2016-10-31/sm_5816bc6c85b0a.jpg', 'Goods/2016-10-31/mid_5816bc6c85b0a.jpg', 'Goods/2016-10-31/big_5816bc6c85b0a.jpg', 'Goods/2016-10-31/mbig_5816bc6c85b0a.jpg', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 100, 0),
(3, '2016103129786', '优衣库', '499.00', '399.00', '<p>优衣库........<br /></p>', 5, 0, 0, '是', '否', '推荐', '不热销', '不新品', '2016-10-31 11:48:25', 'Goods/2016-10-31/5816bf098e764.jpg', 'Goods/2016-10-31/sm_5816bf098e764.jpg', 'Goods/2016-10-31/mid_5816bf098e764.jpg', 'Goods/2016-10-31/big_5816bf098e764.jpg', 'Goods/2016-10-31/mbig_5816bf098e764.jpg', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 127, 0),
(4, '2016103141191', '华为MATE8', '1999.00', '1899.00', '<p><span style="color:rgb(76,76,76);font-family:arial, sans-serif;font-size:13px;font-style:normal;font-weight:normal;background-color:rgb(255,255,255);">华为目前已成长为年销售规模超3900亿人民币的世界500强公司,面向未来,华为将与众多伙伴开放合作,努力共建全联接世界</span></p>', 1, 2, 0, '是', '否', '不推荐', '热销', '新品', '2016-10-31 16:09:25', 'Goods/2016-10-31/5816fc35137cd.jpg', 'Goods/2016-10-31/thumb_3_5816fc35137cd.jpg', 'Goods/2016-10-31/thumb_2_5816fc35137cd.jpg', 'Goods/2016-10-31/thumb_1_5816fc35137cd.jpg', 'Goods/2016-10-31/thumb_0_5816fc35137cd.jpg', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 100, 0),
(5, '2016110119835', '小米5', '1999.00', '1699.00', '<p><em>小米</em>手机<em>5</em>是<em>小米</em>公司于2016年2月24日正式发布的年度旗舰手机，也是2016年<em>小米</em>最为重要的产品之一。<em>小米</em>手机5配备的是5.15英寸1080p屏幕，搭载骁龙820处理器，</p>', 19, 0, 0, '是', '否', '推荐', '热销', '新品', '2016-11-01 09:53:28', 'Goods/2016-11-01/5817f597cb056.jpg', 'Goods/2016-11-01/thumb_3_5817f597cb056.jpg', 'Goods/2016-11-01/thumb_2_5817f597cb056.jpg', 'Goods/2016-11-01/thumb_1_5817f597cb056.jpg', 'Goods/2016-11-01/thumb_0_5817f597cb056.jpg', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 100, 0),
(6, '2016110166759', '卡斯兰黛', '9999.00', '8999.00', '<p>深圳市宝安区新安<em>卡斯兰黛</em>化妆品商行 1年  深圳市  ¥60.00 成交1笔  棒女郎泡泡 女神泡泡 台湾品牌 女生泡泡 私处洗液慕斯  东莞市欧卓实业有限公司 2年 ...</p>', 0, 0, 0, '是', '否', '不推荐', '不热销', '新品', '2016-11-01 10:30:37', 'Goods/2016-11-01/5817fe4c95fbf.jpg', 'Goods/2016-11-01/thumb_3_5817fe4c95fbf.jpg', 'Goods/2016-11-01/thumb_2_5817fe4c95fbf.jpg', 'Goods/2016-11-01/thumb_1_5817fe4c95fbf.jpg', 'Goods/2016-11-01/thumb_0_5817fe4c95fbf.jpg', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 100, 0),
(7, '2016110151752', '诺基亚N86一代神机', '899.00', '899.00', '<p><span>We can distinguish one kind of substance from another by its <em><em>properties</em>.</em></span>\r\n        </p><div>我们可以根据物质的<em>特性</em>把一种物质与另一种物质辨别开来。</div><p><br /></p>', 0, 0, 0, '是', '否', '不推荐', '热销', '不新品', '2016-11-01 15:36:59', 'Goods/2016-11-01/5818461b214d1.jpg', 'Goods/2016-11-01/thumb_3_5818461b214d1.jpg', 'Goods/2016-11-01/thumb_2_5818461b214d1.jpg', 'Goods/2016-11-01/thumb_1_5818461b214d1.jpg', 'Goods/2016-11-01/thumb_0_5818461b214d1.jpg', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 100, 0),
(9, '2016110132684', '亚瑟士1代u', '899.00', '199.00', '<ul><li><span>We <strong>can disting</strong>uish one kind of substance from another by its <em><em>properties</em>.</em></span>\r\n        </li><li>我们可以根据物质的<em>特性</em>把一种物质与另一种物质辨别开来。</li><li>如果可以的话<br /></li></ul><div><p><br /></p></div><p><br /></p>', 19, 0, 0, '是', '否', '推荐', '不热销', '新品', '2016-11-01 17:39:17', 'Goods/2016-11-01/581862c5646eb.jpg', 'Goods/2016-11-01/thumb_3_581862c5646eb.jpg', 'Goods/2016-11-01/thumb_2_581862c5646eb.jpg', 'Goods/2016-11-01/thumb_1_581862c5646eb.jpg', 'Goods/2016-11-01/thumb_0_581862c5646eb.jpg', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 100, 0),
(10, '2016110234687', '蓝月亮手洗', '69.00', '59.00', '<p><em>蓝月亮</em>官方网站。<em>蓝月亮</em>秉承一心一意做洗涤的理念,坚持以自动清洁、解放劳力为宗旨,将国际尖端技术融入中国人的生活,研制开发出高效、轻松、保护的洗衣产品。</p>', 9, 0, 0, '是', '否', '推荐', '不热销', '不新品', '2016-11-02 13:41:23', 'Goods/2016-11-02/58197c81dc39d.jpg', 'Goods/2016-11-02/thumb_3_58197c81dc39d.jpg', 'Goods/2016-11-02/thumb_2_58197c81dc39d.jpg', 'Goods/2016-11-02/thumb_1_58197c81dc39d.jpg', 'Goods/2016-11-02/thumb_0_58197c81dc39d.jpg', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 100, 0),
(12, '2016110246994', '佐丹奴休闲男装', '999.00', '99.00', '', 13, 3, 1, '是', '否', '推荐', '热销', '新品', '2016-11-02 23:49:08', 'Goods/2016-11-02/581a0af39bf2e.jpg', 'Goods/2016-11-02/thumb_3_581a0af39bf2e.jpg', 'Goods/2016-11-02/thumb_2_581a0af39bf2e.jpg', 'Goods/2016-11-02/thumb_1_581a0af39bf2e.jpg', 'Goods/2016-11-02/thumb_0_581a0af39bf2e.jpg', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 100, 0),
(18, '2016110380773', '魅族MX7', '2999.00', '2899.00', '', 17, 1, 1, '是', '否', '推荐', '不热销', '新品', '2016-11-03 23:48:11', 'Goods/2016-11-03/581b5c3b45551.jpg', 'Goods/2016-11-03/thumb_3_581b5c3b45551.jpg', 'Goods/2016-11-03/thumb_2_581b5c3b45551.jpg', 'Goods/2016-11-03/thumb_1_581b5c3b45551.jpg', 'Goods/2016-11-03/thumb_0_581b5c3b45551.jpg', '19.00', '2016-11-11 22:36:00', '2016-11-12 00:00:00', 100, 0),
(19, '2016110491780', '魅族MX8', '599.00', '499.00', '', 17, 1, 1, '是', '否', '推荐', '不热销', '新品', '2016-11-04 16:06:02', 'Goods/2016-11-04/581c4169b7432.png', 'Goods/2016-11-04/thumb_3_581c4169b7432.png', 'Goods/2016-11-04/thumb_2_581c4169b7432.png', 'Goods/2016-11-04/thumb_1_581c4169b7432.png', 'Goods/2016-11-04/thumb_0_581c4169b7432.png', '100.00', '2016-11-08 17:25:00', '2016-11-11 00:00:00', 110, 0);

-- --------------------------------------------------------

--
-- 表的结构 `p39_goods_attr`
--

CREATE TABLE IF NOT EXISTS `p39_goods_attr` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `attr_value` varchar(150) NOT NULL DEFAULT '' COMMENT '属性值',
  `attr_id` mediumint(8) unsigned NOT NULL COMMENT '属性Id',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品Id',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`),
  KEY `attr_id` (`attr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商品属性' AUTO_INCREMENT=40 ;

--
-- 转存表中的数据 `p39_goods_attr`
--

INSERT INTO `p39_goods_attr` (`id`, `attr_value`, `attr_id`, `goods_id`) VALUES
(1, '128G', 16, 18),
(2, '64G', 16, 18),
(3, '32G', 16, 18),
(4, '黑色', 17, 18),
(5, '白色', 17, 18),
(6, '灰色', 17, 18),
(8, '富士康', 26, 18),
(9, '移动', 23, 18),
(10, '电信', 23, 18),
(11, '128G', 16, 19),
(12, '黑色', 17, 19),
(13, '白色', 17, 19),
(19, '富土康', 26, 19),
(21, '13寸', 27, 19),
(22, '3500', 24, 19),
(23, '电信', 23, 19),
(29, '128G', 16, 12),
(30, '32G', 16, 12),
(31, '8G', 16, 12),
(32, '紫色', 17, 12),
(34, '富士康', 26, 12),
(35, '移动', 23, 12),
(36, '18寸', 27, 12),
(37, '4100ml', 24, 18),
(38, '黑色', 17, 12),
(39, '6200ml', 24, 12);

-- --------------------------------------------------------

--
-- 表的结构 `p39_goods_cat`
--

CREATE TABLE IF NOT EXISTS `p39_goods_cat` (
  `cat_id` mediumint(8) unsigned NOT NULL COMMENT '分类id',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品Id',
  KEY `goods_id` (`goods_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品扩展分类';

--
-- 转存表中的数据 `p39_goods_cat`
--

INSERT INTO `p39_goods_cat` (`cat_id`, `goods_id`) VALUES
(18, 12),
(9, 12);

-- --------------------------------------------------------

--
-- 表的结构 `p39_goods_number`
--

CREATE TABLE IF NOT EXISTS `p39_goods_number` (
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品Id',
  `goods_number` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '库存量',
  `goods_attr_id` varchar(150) NOT NULL COMMENT '商品属性表的ID,如果有多个，就用程序拼成字符串存到这个字段中',
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='库存量';

--
-- 转存表中的数据 `p39_goods_number`
--

INSERT INTO `p39_goods_number` (`goods_id`, `goods_number`, `goods_attr_id`) VALUES
(19, 1000, '11,12,23'),
(19, 230, '11,13,23'),
(18, 10, '3,6,10'),
(18, 20, '2,5,10'),
(18, 1993, '3,6,9'),
(18, 2000, '1,4,9'),
(18, 2000, '1,5,9'),
(18, 210, '2,5,9'),
(18, 220, '3,5,10'),
(10, 77, ''),
(6, 11, ''),
(9, 85, '');

-- --------------------------------------------------------

--
-- 表的结构 `p39_goods_pic`
--

CREATE TABLE IF NOT EXISTS `p39_goods_pic` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `pic` varchar(150) NOT NULL COMMENT '原图',
  `sm_pic` varchar(150) NOT NULL COMMENT '小图',
  `mid_pic` varchar(150) NOT NULL COMMENT '中图',
  `big_pic` varchar(150) NOT NULL COMMENT '大图',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品Id',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商品相册' AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `p39_goods_pic`
--

INSERT INTO `p39_goods_pic` (`id`, `pic`, `sm_pic`, `mid_pic`, `big_pic`, `goods_id`) VALUES
(5, 'Goods/2016-11-01/581862c67715d.jpg', 'Goods/2016-11-01/thumb_2_581862c67715d.jpg', 'Goods/2016-11-01/thumb_1_581862c67715d.jpg', 'Goods/2016-11-01/thumb_0_581862c67715d.jpg', 9),
(6, 'Goods/2016-11-01/581862c6cadfd.jpg', 'Goods/2016-11-01/thumb_2_581862c6cadfd.jpg', 'Goods/2016-11-01/thumb_1_581862c6cadfd.jpg', 'Goods/2016-11-01/thumb_0_581862c6cadfd.jpg', 9),
(7, 'Goods/2016-11-01/5818a1d6c3838.jpeg', 'Goods/2016-11-01/thumb_2_5818a1d6c3838.jpeg', 'Goods/2016-11-01/thumb_1_5818a1d6c3838.jpeg', 'Goods/2016-11-01/thumb_0_5818a1d6c3838.jpeg', 9);

-- --------------------------------------------------------

--
-- 表的结构 `p39_member`
--

CREATE TABLE IF NOT EXISTS `p39_member` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `username` varchar(30) NOT NULL COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '密码',
  `face` varchar(150) NOT NULL DEFAULT '' COMMENT '头像',
  `jifen` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '积分',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='会员' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `p39_member`
--

INSERT INTO `p39_member` (`id`, `username`, `password`, `face`, `jifen`) VALUES
(1, 'kingandwede136', 'cbd9a90a9406a07ee9d8e971cce6e401', '', 30000);

-- --------------------------------------------------------

--
-- 表的结构 `p39_member_level`
--

CREATE TABLE IF NOT EXISTS `p39_member_level` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `level_name` varchar(30) NOT NULL COMMENT '级别名称',
  `credit_up` mediumint(8) unsigned NOT NULL COMMENT '积分上限',
  `credit_down` mediumint(8) unsigned NOT NULL COMMENT '积分下限',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='会员级别' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `p39_member_level`
--

INSERT INTO `p39_member_level` (`id`, `level_name`, `credit_up`, `credit_down`) VALUES
(1, '黄铜会员', 5000, 0),
(2, '白银会员', 10000, 5001),
(3, '黄金会员', 30000, 10001),
(4, '白金会员', 100000, 30001);

-- --------------------------------------------------------

--
-- 表的结构 `p39_member_price`
--

CREATE TABLE IF NOT EXISTS `p39_member_price` (
  `price` decimal(10,2) NOT NULL COMMENT '会员价格',
  `level_id` mediumint(8) unsigned NOT NULL COMMENT '会员级别id',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品id',
  KEY `level_id` (`level_id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员价格';

--
-- 转存表中的数据 `p39_member_price`
--

INSERT INTO `p39_member_price` (`price`, `level_id`, `goods_id`) VALUES
('544.00', 2, 7),
('566.00', 3, 7),
('899.00', 1, 6),
('655.00', 1, 9),
('2799.00', 1, 18),
('2499.00', 2, 18),
('2399.00', 3, 18),
('2100.00', 4, 18),
('99.00', 1, 12),
('89.00', 2, 12),
('89.00', 3, 12),
('79.00', 4, 12);

-- --------------------------------------------------------

--
-- 表的结构 `p39_order`
--

CREATE TABLE IF NOT EXISTS `p39_order` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `order_sn` varchar(45) NOT NULL DEFAULT '',
  `member_id` mediumint(8) unsigned NOT NULL COMMENT '会员Id',
  `addtime` int(10) unsigned NOT NULL COMMENT '下单时间',
  `pay_status` enum('是','否') NOT NULL DEFAULT '否' COMMENT '支付状态',
  `pay_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '支付时间',
  `total_price` decimal(10,2) NOT NULL COMMENT '定单总价',
  `shr_name` varchar(30) NOT NULL COMMENT '收货人姓名',
  `shr_tel` varchar(30) NOT NULL COMMENT '收货人电话',
  `shr_province` varchar(30) NOT NULL COMMENT '收货人省',
  `shr_city` varchar(30) NOT NULL COMMENT '收货人城市',
  `shr_area` varchar(30) NOT NULL COMMENT '收货人地区',
  `shr_address` varchar(30) NOT NULL COMMENT '收货人详细地址',
  `post_status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '发货状态,0:未发货,1:已发货2:已收到货',
  `post_number` varchar(30) NOT NULL DEFAULT '' COMMENT '快递号',
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_sn_UNIQUE` (`order_sn`),
  KEY `member_id` (`member_id`),
  KEY `addtime` (`addtime`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='定单基本信息' AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `p39_order`
--

INSERT INTO `p39_order` (`id`, `order_sn`, `member_id`, `addtime`, `pay_status`, `pay_time`, `total_price`, `shr_name`, `shr_tel`, `shr_province`, `shr_city`, `shr_area`, `shr_address`, `post_status`, `post_number`) VALUES
(3, '8372420161113', 1, 1479008214, '是', 0, '354.00', '杨嘉颖', '13250150526', '上海', '朝阳区', '西三旗', '里望去201号', 0, ''),
(6, '7386320161113', 1, 1479008592, '是', 0, '59.00', '杨嘉颖', '13250150526', '北京', '东城区', '西二旗', '里望去201号', 0, ''),
(7, '9652120161113', 1, 1479009313, '是', 0, '118.00', '杨嘉颖', '13250150526', '北京', '朝阳区', '西二旗', '里望去201号', 0, ''),
(10, '2676220161113', 1, 1479029508, '是', 0, '9714.00', '杨嘉颖', '13250150526', '广东省', '广州市', '荔湾区', '里望去201号', 0, ''),
(11, '7906820161116', 1, 1479259559, '是', 0, '597.00', '杨嘉颖', '13250150526', '北京市', '市辖区', '西城区', '里望去201号', 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `p39_order_goods`
--

CREATE TABLE IF NOT EXISTS `p39_order_goods` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `order_id` mediumint(8) unsigned NOT NULL COMMENT '定单Id',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品Id',
  `goods_attr_id` varchar(150) NOT NULL DEFAULT '' COMMENT '商品属性id',
  `goods_number` mediumint(8) unsigned NOT NULL COMMENT '购买的数量',
  `price` decimal(10,2) NOT NULL COMMENT '购买的价格',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='定单商品表' AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `p39_order_goods`
--

INSERT INTO `p39_order_goods` (`id`, `order_id`, `goods_id`, `goods_attr_id`, `goods_number`, `price`) VALUES
(3, 3, 10, '', 6, '59.00'),
(6, 6, 10, '', 1, '59.00'),
(7, 7, 10, '', 2, '59.00'),
(14, 10, 10, '', 2, '59.00'),
(15, 10, 18, '3,6,10', 2, '2399.00'),
(16, 10, 18, '3,6,9', 2, '2399.00'),
(17, 11, 9, '', 3, '199.00');

-- --------------------------------------------------------

--
-- 表的结构 `p39_privilege`
--

CREATE TABLE IF NOT EXISTS `p39_privilege` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `pri_name` varchar(30) NOT NULL COMMENT '权限名称',
  `module_name` varchar(30) NOT NULL DEFAULT '' COMMENT '模块名称',
  `controller_name` varchar(30) NOT NULL DEFAULT '' COMMENT '控制器名称',
  `action_name` varchar(30) NOT NULL DEFAULT '' COMMENT '方法名称',
  `parent_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '上级权限Id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='权限' AUTO_INCREMENT=46 ;

--
-- 转存表中的数据 `p39_privilege`
--

INSERT INTO `p39_privilege` (`id`, `pri_name`, `module_name`, `controller_name`, `action_name`, `parent_id`) VALUES
(1, '商品模块', '', '', '', 0),
(2, '商品列表', 'Admin', 'Goods', 'lst', 1),
(4, '修改商品', 'Admin', 'Goods', 'edit', 2),
(5, '删除商品', 'Admin', 'Goods', 'delete', 2),
(6, '分类列表', 'Admin', 'Category', 'lst', 1),
(7, '添加分类', 'Admin', 'Category', 'add', 6),
(8, '修改分类', 'Admin', 'Category', 'edit', 6),
(9, '删除分类', 'Admin', 'Category', 'delete', 6),
(10, '权限管理', '', '', '', 0),
(11, '权限列表', 'Admin', 'Privilege', 'lst', 10),
(12, '添加权限', 'Privilege', 'Admin', 'add', 11),
(13, '修改权限', 'Admin', 'Privilege', 'edit', 11),
(14, '删除权限', 'Admin', 'Privilege', 'delete', 11),
(15, '角色列表', 'Admin', 'Role', 'lst', 10),
(16, '添加角色', 'Admin', 'Role', 'add', 15),
(17, '修改角色', 'Admin', 'Role', 'edit', 15),
(18, '删除角色', 'Admin', 'Role', 'delete', 15),
(19, '管理员列表', 'Admin', 'Admin', 'lst', 10),
(20, '添加管理员', 'Admin', 'Admin', 'add', 19),
(21, '修改管理员', 'Admin', 'Admin', 'edit', 19),
(22, '删除管理员', 'Admin', 'Admin', 'delete', 19),
(23, '类型列表', 'Admin', 'Type', 'lst', 1),
(24, '添加类型', 'Admin', 'Type', 'add', 23),
(25, '修改类型', 'Admin', 'Type', 'edit', 23),
(26, '删除类型', 'Admin', 'Type', 'delete', 23),
(27, '属性列表', 'Admin', 'Attribute', 'lst', 23),
(28, '添加属性', 'Admin', 'Attribute', 'add', 27),
(29, '修改属性', 'Admin', 'Attribute', 'edit', 27),
(30, '删除属性', 'Admin', 'Attribute', 'delete', 27),
(32, 'ajax删除商品相册图片', 'Admin', 'Goods', 'ajaxDelPic', 4),
(33, '会员管理', '', '', '', 0),
(34, '会员级别列表', 'Admin', 'MemberLevel', 'lst', 33),
(35, '添加会员级别', 'Admin', 'MemberLevel', 'add', 34),
(36, '修改会员级别', 'Admin', 'MemberLevel', 'edit', 34),
(37, '删除会员级别', 'Admin', 'MemberLevel', 'delete', 34),
(38, '品牌列表', 'Admin', 'Brand', 'lst', 1),
(39, '添加新商品', 'Admin', 'Goods', 'add', 2),
(40, '添加品牌', 'Admin', 'Brand', 'add', 38),
(41, '修改品牌', 'Admin', 'Brand', 'edit', 38),
(42, '删除品牌', 'Admin', 'Brand', 'delete', 38),
(43, 'ajax获取商品属性', 'Admin', 'Goods', 'ajaxGetAttr', 4),
(44, 'ajax获取商品属性', 'Admin', 'Goods', 'ajaxGetAttr', 39),
(45, '商品库存量', 'Admin', 'Brand', 'goods_number', 2);

-- --------------------------------------------------------

--
-- 表的结构 `p39_role`
--

CREATE TABLE IF NOT EXISTS `p39_role` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `role_name` varchar(30) NOT NULL COMMENT '角色名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='角色' AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `p39_role`
--

INSERT INTO `p39_role` (`id`, `role_name`) VALUES
(6, '技术总监'),
(8, '财务主管'),
(9, '总经理');

-- --------------------------------------------------------

--
-- 表的结构 `p39_role_pri`
--

CREATE TABLE IF NOT EXISTS `p39_role_pri` (
  `pri_id` mediumint(8) unsigned NOT NULL COMMENT '权限id',
  `role_id` mediumint(8) unsigned NOT NULL COMMENT '角色id',
  KEY `pri_id` (`pri_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色权限';

--
-- 转存表中的数据 `p39_role_pri`
--

INSERT INTO `p39_role_pri` (`pri_id`, `role_id`) VALUES
(1, 9),
(2, 9),
(4, 9),
(32, 9),
(5, 9),
(6, 9),
(7, 9),
(8, 9),
(9, 9),
(23, 9),
(24, 9),
(25, 9),
(26, 9),
(27, 9),
(28, 9),
(29, 9),
(30, 9),
(38, 9),
(10, 9),
(11, 9),
(12, 9),
(13, 9),
(14, 9),
(15, 9),
(16, 9),
(17, 9),
(18, 9),
(19, 9),
(20, 9),
(21, 9),
(22, 9),
(33, 9),
(34, 9),
(35, 9),
(36, 9),
(37, 9),
(1, 6),
(2, 6),
(4, 6),
(32, 6),
(5, 6),
(39, 6),
(38, 6),
(10, 6),
(11, 6),
(12, 6),
(13, 6),
(14, 6),
(15, 6),
(16, 6),
(17, 6),
(18, 6),
(19, 6),
(20, 6),
(21, 6),
(22, 6),
(1, 8),
(2, 8),
(4, 8),
(32, 8),
(5, 8),
(39, 8),
(44, 8),
(6, 8),
(7, 8),
(8, 8),
(9, 8),
(23, 8),
(24, 8),
(25, 8),
(26, 8),
(27, 8),
(28, 8),
(29, 8),
(30, 8),
(38, 8);

-- --------------------------------------------------------

--
-- 表的结构 `p39_sphinx_id`
--

CREATE TABLE IF NOT EXISTS `p39_sphinx_id` (
  `id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '已经索引好索引的最后一件商品的ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='sphinx';

--
-- 转存表中的数据 `p39_sphinx_id`
--

INSERT INTO `p39_sphinx_id` (`id`) VALUES
(19);

-- --------------------------------------------------------

--
-- 表的结构 `p39_type`
--

CREATE TABLE IF NOT EXISTS `p39_type` (
  `type_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `type_name` varchar(30) NOT NULL COMMENT '类型名称',
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='类型' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `p39_type`
--

INSERT INTO `p39_type` (`type_id`, `type_name`) VALUES
(1, '手机'),
(2, '电脑'),
(3, '衣服');

-- --------------------------------------------------------

--
-- 表的结构 `p39_yinxiang`
--

CREATE TABLE IF NOT EXISTS `p39_yinxiang` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品Id',
  `yx_name` varchar(30) NOT NULL COMMENT '印象名称',
  `yx_count` smallint(5) unsigned NOT NULL DEFAULT '1' COMMENT '印象的次数',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='印象' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `p39_yinxiang`
--

INSERT INTO `p39_yinxiang` (`id`, `goods_id`, `yx_name`, `yx_count`) VALUES
(1, 10, '质量好', 6),
(2, 10, '有型', 5),
(3, 10, '真好', 1),
(4, 10, '还行', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
