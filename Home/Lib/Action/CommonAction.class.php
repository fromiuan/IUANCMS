<?php
// +----------------------------------------------------------------------
// | 公共类
// +----------------------------------------------------------------------
// | Copyright (c) 2013 IUANCMS All Rights Reserved.
// +----------------------------------------------------------------------
// | Author: IUAN 
// | Web site: http://www.w3cdream.com
// +----------------------------------------------------------------------
class CommonAction extends Action
{

	//位置导航
	protected function position()
	{
		global $_fields,$cfg_indexname,$cfg_list_symbol,$_parameter;
		$cfg_list_symbol='>';
		
		$ref = "<a href='".C('cfg_index')."'>".C('cfg_indexname')."</a>";
		if(empty($_fields['typeid'])) return $ref;
		$model = M('cate');
		$cate=$model->order('sort ASC')->select();
		$list=$this->getParents($cate,$_fields['typeid']);
		if(!$list) return $ref;
		foreach($list as $k=>$v)
		{
			$typelink = url('list',$v['id'],$_parameter);
			$ref.= $cfg_list_symbol."<a href='{$typelink}'>{$v['name']}</a>";
		}
		if(!empty($_fields['id']))
		{
			$arcurl = url('show',$_fields['id'],$_parameter);
			$ref.= $cfg_list_symbol."<a href='{$arcurl}'>{$_fields['title']}</a>";
		}
		return $ref;
	}
	
	//传递一个子分类ID返回有的父级分类（上方导航）
	protected function getParents($cate , $id) {
			$arr=array();
			foreach ($cate as $v) {
				if ($v[id]  == $id) {
					$arr[] = $v;
					$arr = array_merge(self::getParents($cate , $v['fid']) , $arr);
				}
			}
			return $arr;
		}

}