<?php
// +----------------------------------------------------------------------
// | 分类控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2013 IUANCMS All Rights Reserved.
// +----------------------------------------------------------------------
// | Author: IUAN 
// | Web site: http://www.w3cdream.com
// +----------------------------------------------------------------------
	Class CategoryAction extends CommonAction{

		//分类列表视图
		Public function index(){
			$Model = M('Cate');
			import('Class.Category',APP_PATH);

			$cate=$Model->order('sort ASC')->select();
			$cate=Category::unlimit($cate );
			//p($cate);
			$this->cate=Category::unlimit($cate);
			$this->display();
		}

		//添加分类视图
		Public function addCate(){
			$this->fid=isset($_GET['fid']) ? $_GET['fid'] : 0;
			$this->display();
		}

		//添加分类表单处理
		Public function runAddCate(){
			$Model = M('Cate');

			$listarr = $this->CutModel($_POST['tpllist']);
			$showarr = $this->CutModel($_POST['tplshow']);
			$linkurl = $this->LinkUrl($_POST['modeltype'],$_POST['linkurl']);

			$data['name'] = $_POST['name'];
			$data['sort'] = $_POST['sort'];
			$data['tpllist'] = $listarr[1];
			$data['tplshow'] = $showarr[1];
			$data['modeltype'] = $_POST['modeltype'];
			$data['linkurl'] = $linkurl;
			$data['content'] = $_POST['content'];
			$data['fid'] = $_POST['fid'];

			if($Model->add($data)){
				$this->success('添加成功' , U(GROUP_NAME . '/Category/index'));
			}else{
				$this->error('添加失败');
			}
		}

		//修复表单处理
		Public function modifyCate(){
			$Model = M('cate');
			$data['id'] = $_GET['id'];

			$this->list=$Model->where($data)->find();
			$this->display();
		}

		//修改分类处理表单处理
		Public function modifyCateHandle(){
			$Model = M('cate');

			$listarr = $this->CutModel($_POST['tpllist']);
			$showarr = $this->CutModel($_POST['tplshow']);
			$linkurl = $this->LinkUrl($_POST['modeltype'],$_POST['linkurl']);

			$data['name'] = $_POST['name'];
			$data['sort'] = $_POST['sort'];
			$data['tpllist'] = $listarr[1];
			$data['tplshow'] = $showarr[1];
			$data['modeltype'] = $_POST['modeltype'];
			$data['linkurl'] = $linkurl;
			$data['content'] = $_POST['content'];
			$data['id'] = $_POST['id'];

			if($bid = $Model->save($data)){
				$this->success("修改成功",U(GROUP_NAME . '/Category/index'));
			}else{
				$this->error("修改失败");
			}
		}

		//删除分类
		Public function delCate(){
			$Model = M('cate');
			import('Class.Category',APP_PATH);

			$id = $_GET['id'];
			$cateArr = $Model->order('sort ASC')->select();
			$cate=Category::getChildId($cateArr,$id);

			$str .=$id.',';
			foreach ($cate as $key => $value) {
				$str .=$value.',';
			}
			$str = rtrim($str,',');

			$map['id']  = array('in',"$str");
			if ($bid =$Model->where($map)->delete()) {
				$this->success('删除成功',U(GROUP_NAME . '/Category/index'));
			}else{
				$this->error('删除失败');
			}

		}

		//排序设置
		Public function sortCate(){
			$Model = M('Cate');

			foreach ($_POST as $id => $sort) {
				$Model->where(array('id' => $id))->setField('sort',$sort);
			}
			$this->redirect(GROUP_NAME . '/Category/index');
		}

		//切割分组
		private function CutModel($arr){
			$arr = explode('_', $arr);
			return $arr;
		}

		//链接选择
		private function LinkUrl($modeltype,$url){
			switch ($modeltype) {
				case '1':
					return '';
					break;
				case '2':
					return 'javascript:;';
					break;
				case '3':
					return $url;
					break;
				default:
					return '';
					break;
			}
		}
	}
?>