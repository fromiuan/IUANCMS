<?php
// +----------------------------------------------------------------------
// | 系统设置控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2013 IUANCMS All Rights Reserved.
// +----------------------------------------------------------------------
// | Author: IUAN 
// | Web site: http://www.w3cdream.com
// +----------------------------------------------------------------------
	Class SystemAction extends CommonAction{

		//显示验证码
		Public function verify(){
			$this->display();
		}

		//F函数配置验证码
		Public function updateVerify(){

			if(F('verify' , $_POST ,CONF_PATH)){
				$this->success('修改成功',U(GROUP_NAME . '/System/verify'));
			}else{
				$this->error('修改失败'. CONF_PATH .'没有权限');
			}
		}

		//修改密码
		Public function modifyPass(){
			$this->display();
		}

		//修改密码表单处理
		public function modifyHandle(){
			$Model=M('User');

			if(!IS_POST) _404('页面不存在');

			$oldpassword=trim($_POST['oldpassword']);
			$newpassword=trim($_POST['newpassword']);
			$surepassword=trim($_POST['surepassword']);

			$data = array(
				'id'=> $_SESSION['uid'],
				'password' => md5($oldpassword)				
				);
			$password=$Model->where($data)->find();

			if($password==''){
				$this->error('原始密码错误');
			}
			if($newpassword!=$surepassword){
				$this->error('两次输入密码不一样');
			}

			$where = array(
				'id' => $_SESSION['uid'],
				'modifytime' => date('Y-m-d H:i:s'),
				'password' => md5($newpassword)
				);

			$user = $Model->save($where);
			echo $user;
			if($user){
				$this->success('修改成功');
			}else{
				$this->error('异常错误');
			}

		}

		//站点配置
		public function webset(){
			$this->display();
		}

		//F函数配置站点
		public function setwebset(){
			if(F('webset' , $_POST ,CONF_PATH)){
				$this->success('修改成功',U(GROUP_NAME . '/System/webset'));
			}else{
				$this->error('修改失败'. CONF_PATH .'没有权限');
			}
		}

	}
?>