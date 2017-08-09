<?php
// +----------------------------------------------------------------------
// | 列表类
// +----------------------------------------------------------------------
// | Copyright (c) 2013 IUANCMS All Rights Reserved.
// +----------------------------------------------------------------------
// | Author: IUAN 
// | Web site: http://www.w3cdream.com
// +----------------------------------------------------------------------
class ListAction extends CommonAction
{
	public function index(){
		$map['id'] = (int)$this->_get('id');

		$model  = M('cate');
		$list = $model->field('id as typeid,fid,name as title,modeltype,linkurl,name,content,tpllist,tplshow')->where($map)->find();
		$GLOBALS['_fields'] = $list;
		$GLOBALS['_fields']['position'] = $this->position();
		// 		print_r($list);
		// die();
		if($list['modeltype']==3)
		{
				header('Location:'.$list['linkurl']);
		}
		if($list['modeltype']==2)
		{
				header('Location:'.$list['linkurl']);
		}
		//全文阅读判断
		$tpl = $GLOBALS['_fields']['tpllist'];
		$tplfile = empty($tpl) ? index : $tpl;
		if(empty($list)) $this->error('栏目ID不存在!');
		
		// //项目重置 
		// $this->list=$this->project();

		$this->display($tplfile);
	}

}