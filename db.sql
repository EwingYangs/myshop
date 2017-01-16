create database php_jd;
use php_jd;
drop table if exists p39_goods;
create table p39_goods
(
	id mediumint unsigned not null auto_increment comment 'Id',
	goods_name varchar(150) not null comment '商品名称',
	market_price decimal(10,2) not null comment '市场价格',
	shop_price decimal(10,2) not null comment '本店价格',
	goods_number smallint not null default 1 comment '商品数量',
	goods_desc longtext comment '商品描述',
	cat_id mediumint not null default 0 comment '商品分类',
	brand_id mediumint not null default 0 comment '商品品牌',
	is_on_sale enum('是','否') not null default '是' comment '是否上架',
	is_delete enum('是','否') not null default '否' comment '是否放到回收站',
	is_rec enum('推荐','不推荐') not null default '不推荐' comment '推荐与否',
	is_hot enum('热销','不热销') not null default '不热销' comment '热销与否',
	is_new enum('新品','不新品') not null default '不新品' comment '新品与否',
	addtime datetime not null comment '添加时间',
	logo varchar(150) not null default '' comment '原图',
	sm_logo varchar(150) not null default '' comment '小图',
	mid_logo varchar(150) not null default '' comment '中图',
	big_logo varchar(150) not null default '' comment '大图',
	mbig_logo varchar(150) not null default '' comment '更大图',
	primary key (id),
	key shop_price(shop_price),
	key addtime(addtime),
	key (cat_id),
	key (brand_id)
)engine=InnoDB default charset=utf8 comment '商品';


create table p39_brand
(
	id mediumint unsigned not null auto_increment comment 'Id',
	brand_name varchar(30) not null comment '品牌名称',
	url varchar(150) not null default '' comment '品牌官网',
	brand_desc varchar(255) not null default '' comment '品牌描述',
	sort_order tinyint unsigned not null default 50 comment '排序依据',
	logo varchar(150) not null default '' comment '品牌logo',
	primary key(id)
)engine=InnoDB default charset=utf8 comment '品牌';

create table p39_member_level
(
	id mediumint unsigned not null auto_increment comment 'Id',
	level_name varchar(30) not null comment '级别名称',
	credit_up mediumint unsigned not null comment '积分上限',
	credit_down mediumint unsigned not null comment '积分下限',
	primary key(id)
)engine=InnoDB default charset=utf8 comment '会员级别';


create table p39_member_price
(
	price decimal(10,2) not null comment '会员价格',
	level_id mediumint unsigned not null  comment '会员级别id',
	goods_id mediumint unsigned not null  comment '商品id',
	key level_id(level_id),
	key goods_id(goods_id)
)engine=InnoDB default charset=utf8 comment '会员价格';


create table p39_category
(
	cat_id midiumint unsigned not null auto_increment comment 'Id',
	cat_name varchar(30) not null comment '分类名称',
	parent_id midiumint unsigned not null default 0 comment '父类id',
	unit varchar(15) not null default '' comment '数量单位',
	primary key(cat_id),
	key parent_id(parent_id)
)engine=InnoDB default charset=utf8 comment '分类';

















