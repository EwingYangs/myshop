<?php
return array(
	'tableName' => 'p39_attribute',    // 表名
	'tableCnName' => '属性表',  // 表的中文名
	'moduleName' => 'Admin',  // 代码生成到的模块
	'withPrivilege' => FALSE,  // 是否生成相应权限的数据
	'topPriName' => '',        // 顶级权限的名称
	'digui' => 0,             // 是否无限级（递归）
	'diguiName' => '',        // 递归时用来显示的字段的名字，如cat_name（分类名称）
	'pk' => 'attr_id',    // 表中主键字段名称
	/********************* 要生成的模型文件中的代码 ******************************/
	// 添加时允许接收的表单中的字段
	'insertFields' => "array('attr_name','type_id','attr_type','attr_input_type','attr_value')",
	// 修改时允许接收的表单中的字段
	'updateFields' => "array('attr_id','attr_name','type_id','attr_type','attr_input_type','attr_value')",
	'validate' => "
		array('attr_name', '1,50', '商品属性名称的值最长不能超过 50 个字符！', 2, 'length', 3),
		array('type_id', 'number', '商品属性所属类型ID必须是一个整数！', 2, 'regex', 3),
		array('attr_type', 'number', '属性是否可选 0 为唯一，1为可选必须是一个整数！', 2, 'regex', 3),
		array('attr_input_type', 'number', '属性录入方式 0为手工录入，1为从列表中选择必须是一个整数！', 2, 'regex', 3),
	",
	/********************** 表中每个字段信息的配置 ****************************/
	'fields' => array(
		'attr_name' => array(
			'text' => '商品属性名称',
			'type' => 'text',
			'default' => '',
		),
		'type_id' => array(
			'text' => '商品属性所属类型ID',
			'type' => 'text',
			'default' => '0',
		),
		'attr_type' => array(
			'text' => '属性是否可选 0 为唯一，1为可选',
			'type' => 'text',
			'default' => '1',
		),
		'attr_input_type' => array(
			'text' => '属性录入方式 0为手工录入，1为从列表中选择',
			'type' => 'text',
			'default' => '1',
		),
		'attr_value' => array(
			'text' => '属性的值',
			'type' => 'html',
			'default' => '',
		),
	),
	/**************** 搜索字段的配置 **********************/
	'search' => array(
		
	),
);