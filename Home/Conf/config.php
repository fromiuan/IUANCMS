<?php
	
	$config = require './Data/Config/config.php';
	
	$config_web = array(
	
	'LOAD_EXT_CONFIG' => 'webset',		//加载外部配置文件
	
	//点语法
	'TMPL_VAR_IDENTIFY' =>'array',

	'TAGLIB_LOAD' => true, 								//可加载自定义标签

	'TAGLIB_PRE_LOAD' => 'Iuan',						//载入的自定义标签

	'URL_MODEL' => '1',									//URL模式

	'URL_HTML_SUFFIX' => 'html',						//伪静态后缀

	'URL_ROUTER_ON' => true, 							//开启路由

	// 'TMPL_PARSE_STRING' => array(
	// 		'__PUBLIC__' => TMPL_PATH.$them,
	// ),
														
	'URL_ROUTE_RULES' => array(							//配置路由
		'/^list_(\d+)$/' => 'List/index?id=:1',
		'/^show_(\d+)$/' => 'Show/index?id=:1',

	),

 	);

 	return array_merge($config,$config_web);
?>