<?php
	$config = require './Data/Config/config.php';
	$config_admin = array(
		 'TMPL_PARSE_STRING' => array(
				'__PUBLIC__' => __ROOT__.'/'.APP_NAME.'/Tpl/'.'/Public',
				'__IUAN__' => Admin,					//配置后台项目名称
			),
			
			//url模式
			'URL_MODEL' => '1',
		 	//加载外部配置文件
			'LOAD_EXT_CONFIG' => 'verify,water,webset',
			'ADMIN_AUTH_KEY' => 'superadmin',	//超级管理员
			'USER_AUTH_ON' => true,  			//是否开启权限认证
			'USER_AUTH_TYPE' => 1,				//验证类型 （1， 开启登录验证	2，实时验证）
			'USER_AUTH_KEY' => 'uid',			//用户认证识别号
			'NOT_AUTH_MODULE' => 'Login,Index,System',			//无需验证的控制器
			'NOT_AUTH_ACTION' => 'addUserHandle,addNodeHandle,setAccess,addUser,delUser,addRole,addRoleHandle,addNode,access,setLock',			//无需验证的方法
			'RBAC_ROLE_TABLE' => 'hd_role',		//角色表名称
			'RBAC_USER_TABLE' => 'hd_role_user', //角色与用户的中介表
			'RBAC_ACCESS_TABLE' => 'hd_access',	//权限表名称
			'RBAC_NODE_TABLE' => 'hd_node',		//节点表名称

			//数据备份管理
			'DATA_BACKUP_PATH' => './Data/Database/',	//定义备份存放位置
			'DATA_BACKUP_PART_SIZE' => 20971520,//定义备份
			'DATA_BACKUP_COMPRESS' => 1,
			'DATA_BACKUP_COMPRESS_LEVEL' => 9,
			// 'SHOW_PAGE_TRACE' =>true, // 显示页面Trace信息

			//邮件发送
			// 'SMTP_SERVER' =>'smtp.126.com',	 //邮件服务器
			// 'SMTP_PORT' =>25,	 //邮件服务器端口
			// 'SMTP_USER_EMAIL' =>'pengyong881215@126.com', //SMTP服务器的用户邮箱(一般发件人也得用这个邮箱)
			// 'SMTP_USER'=>'pengyong881215@126.com',	 //SMTP服务器账户名
			// 'SMTP_PWD'=>'您的密码',	 //SMTP服务器账户密码
			// 'SMTP_MAIL_TYPE'=>'HTML',	 //发送邮件类型:HTML,TXT(注意都是大写)
			// 'SMTP_TIME_OUT'=>30,	 //超时时间
			// 'SMTP_AUTH'=>true,	 //邮箱验证(一般都要开启)

	);

	return array_merge($config,$config_admin);
?>