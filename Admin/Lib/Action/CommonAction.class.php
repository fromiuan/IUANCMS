<?php
// +----------------------------------------------------------------------
// | 公共控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2013 IUANCMS All Rights Reserved.
// +----------------------------------------------------------------------
// | Author: IUAN 
// | Web site: http://www.w3cdream.com
// +----------------------------------------------------------------------
	Class CommonAction extends Action{

		Public function _initialize(){

			if(!isset($_SESSION[C('USER_AUTH_KEY')])){
				$this->redirect('Admin/Login/index');
			}

			$nothAuth = in_array(MODULE_NAME,explode(',', C('NOT_AUTH_MODULE'))) || in_array(ACTION_NAME, explode(',', C('NOT_AUTH_ACTION')));

			if(C('USER_AUTH_ON') && !$nothAuth){  
				import('ORG.Util.RBAC');
				RBAC::AccessDecision(GROUP_NAME) || $this->error('没有权限');
			}
			
		}	

		//退出
		Public function logout(){
			session_unset();
			session_destroy();
			$this->redirect(GROUP_NAME.'/Login/index');
		}
	}
?>

