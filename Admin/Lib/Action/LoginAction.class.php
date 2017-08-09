<?php
// +----------------------------------------------------------------------
// | 登陆控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2013 IUANCMS All Rights Reserved.
// +----------------------------------------------------------------------
// | Author: IUAN 
// | Web site: http://www.w3cdream.com
// +----------------------------------------------------------------------
	Class LoginAction extends Action{

		//登录页面视图
		Public function index(){

			$this->display();
		}

		//登录表单处理
		Public function login(){
			$Model = M('user');

			if(!IS_POST) _404('页面不存在');

			if(I('code','','strtolower') != session('verify')){
				$this->error('验证码出错');
			}

			$data =array( 
				'username' => I('username'),
				'password' => I('password','','md5')
			);

			$user = $Model->where($data)->find();

			if( $user == ''){
				$this->error(帐号密码错误);
			}

			if( $user['lock'] ){
				$this->error('该用户被锁定');
			}

			$data = array(
				'id' => $user['id'],
				'logintime' => time(),
				'loginip' => get_client_ip(),
				'loginnum' => $user['loginnum']+1
			);

			$Model -> save($data);

			session(C('USER_AUTH_KEY'),$user['id']);
			session('username',$user['username']);
			session('logintime',date('Y-m-d H:i:s',$user[logintime]));
			session('loginip',$user['loginip']);

			//超级管理员识别
			if($user['username'] == C('RBAC_SUPERADMIN')){
				session(C('ADMIN_AUTH_KEY'),true);
			}
			//读取用户权限
			import('ORG.Util.RBAC');
			RBAC::saveAccessList();

			//echo __GROUP__;
			$this->redirect(GROUP_NAME.'/Index/index');

		}

		//引入外部样式验证码
		Public function verify(){
			import('Class.Image' , APP_PATH);
			Image::verify();
		}
	}
?>