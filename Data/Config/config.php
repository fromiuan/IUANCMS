<?php
	$config_webset = require'./Admin/Conf/webset.php';
	$config_theme = require'./Admin/Conf/theme.php';
	$config = require'config.ini.php';

	return array_merge($config_webset,$config_theme,$config)
?>