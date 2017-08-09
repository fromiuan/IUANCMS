<?php	
	if (!file_exists('install/install.lock')) {
    	header("Location: install/");
    exit;
	}
	//定义项目名称
	define('APP_NAME', 'Home');
	//定义项目路劲
	define('APP_PATH', './Home/');
	//开启调试模式
	define('APP_DEBUG', 1);
	//定义模板主题目录
	define('TMPL_PATH', './Public/templets/');
	//引入核心文件
	require './Code/ThinkPHP.php';

?>