<?php
// +----------------------------------------------------------------------
// | RBAC控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2013 IUANCMS All Rights Reserved.
// +----------------------------------------------------------------------
// | Author: IUAN 
// | Web site: http://www.w3cdream.com
// +----------------------------------------------------------------------
	Class RbacAction extends CommonAction{

		//用户列表
		Public function index(){
			$field=array('id','username','logintime','loginip','lock');
			$data['username']=array('neq','admin');		//不查出超级管理员
			$this->user=D('UserRelation')->where($data)->field($field)->relation(true)->select();
			$this->display();
		} 

		//角色列表
		Public function role(){
			$Model=M(role);
			$this->role=$Model->select();
			$this->display();
		}

		//节点列表
		Public function node(){
			$Model=M(node);
			$field=array(id,name,title,pid);
			$node=$Model->field($field)->order('sort')->select();
			$this->node=node_marge($node);
			$this->display();
		}

		//添加用户
		Public function addUser(){
			$Model=M(role);
			$this->role=$Model->select();
			$this->display();

		}

		//删除用户
		Public function delUser(){
			$data['id']=$userid=$_GET['userid'];
			if($user=D(User)->relation(role_user)->where($data)->delete()){
				$this->success('删除成功',U(GROUP_NAME . '/Rbac/index'));
			}else{
				$this->error("删除失败");
			}
		}

		//添加用户表单处理
		Public function addUserHandle(){
			$Model=M(role_user);
			$user=array(
				'username' => I('username'),
				'password' => I('password', '' , 'md5'),
				'logintime' => time(),
				'loginip' =>get_client_ip(),
				'createtime' => date('Y-m-d H:i:s')
				);
			if($uid=M('user')->add($user)){
				foreach ($_POST['role_id'] as $v) {
					$role[] = array(
						'role_id' => $v,
						'user_id' => $uid
						);
				}
				$Model->addAll($role);
				$this->success('添加成功', U(GROUP_NAME . '/Rbac/index'));
			}else{
				$this->error('添加失败');
			}
		}

		//添加角色
		Public function addRole(){
			$this->display();
		}

		//添加角色表单处理
		Public function addRoleHandle(){
			if(M('role')->add($_POST)){
				$this->success('添加成功',U(GROUP_NAME . '/Rbac/role'));
			}else{
				$this->error('添加失败');
			}
		}

		//添加节点
		Public function addNode(){
			$this->pid=isset($_GET['pid']) ? $_GET['pid'] : 0;
			$this->level=isset($_GET['level']) ? $_GET['level'] : 1;

			$this->id=M('Node')->where(array('id' => $_GET['id']))->find();

			switch ($this->level) {
				case '1':
					$this->type = '应用';
					# code...
					break;
				case '2':
					$this->type = '控制器';
					break;
				case '3':
					$this->type = '动作方法';
					# code...
					break;
			}
			$this->display();
		}

		//添加节点表单处理
		Public function addNodeHanlde(){
			$Model=M(node);
			$id = $_POST['id'];
			$data['name'] = $_POST['name'];
			$data['title'] = $_POST['title'];
			$data['status'] = $_POST['stasus'];
			$data['sort'] = $_POST['sort'];
			$data['pid'] = $_POST['pid'];
			$data['level'] = $_POST['level'];

			if($id != ''){
				$result=$Model->where(array('id' => $id))->save($data);
				if($result){
					$this->success('更新成功', U(GROUP_NAME .'/Rbac/node'));
				}else{
					$this->error('更新失败');
				}
			}else{
				$result=$Model->add($_POST);
				if($result){
					$this->success('添加成功',U(GROUP_NAME . '/Rbac/node'));
				}else{
					$this->error("添加失败");
				}
			}

		}

		//删除节点
		Public function delNode(){
			$data['id']=$_GET['id'];
			$nodeAccess=D(Node)->relation(access)->where(array('id' => $data[id]))->delete();
			if($nodeAccess){
				$this->success('删除成功' ,U(GROUP_NAME . '/Rbac/node'));
			}else{
				$this->error('删除失败');
			}
		}

		//删除顶级结点
		Public function delTopNode(){
			$Model = M('Node');
			$id = $_GET['id'];
			import('Class.Category',APP_PATH);

			$node=$Model->select();
			$node=Category::getNodeChildId($node, $id);

			$str .=$id.',';
			foreach ($node as $key => $value) {
				$str .=$value.',';
			}
			$str = rtrim($str,',');

			$map['id']  = array('in',"$str");
			$nodeAccess=D(Node)->relation(access)->where($map)->delete();
			if($nodeAccess){
				$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}
			// echo "<pre>";
			// print_r($nodeAccess);
			// die();
		}

		//配置权限
		Public function access(){
			$rid = I('rid' ,'0','intval');

			$field=array('id','name','title','pid');
			$node = M(node)->field($field)->order('sort')->select();

			//原有权限
			$access=M('access')->where(array('role_id' => $rid))->getField('node_id',true);

			$this->node=node_marge($node,$access);
			$this->rid=$rid;
			$this->display();
		}

		//修改权限
		Public function setAccess(){
			$rid=I('rid',0,'intval');
			$Model=M(access);

			//删除以前赋予的权限
			$Model->where(array('role_id' => $rid))->delete();

			//循环插入权限
			$data = array();
			foreach ($_POST['access'] as $v) {
				$tmp=explode('_', $v);
				$data[]  = array('role_id' =>$rid , 'node_id' => $tmp[0],'level' => $tmp[1]);
			}

			if($Model->addAll($data)){
				$this->success('修改成功',U(GROUP_NAME . '/Rbac/role'));
			}else{
				$this->error('修改失败');
			}
		}

		//锁定 OR 解锁
		Public function setLock(){
			$Model=M(User);

			$lock = I('lock','','intval');
			$rid = I('rid', '' ,'intval');

			$setlock=$lock ==0 ? 1 : 0;

			$data['lock'] =$setlock;
			$result=$Model->where(array('id' => $rid))->save($data);
			if($result){
				$this->success('修改成功', U(GROUP_NAME . '/Rbac/index'));
			}else{
				$this->errot('修改失败');
			}

		}

	}
?>