<?php
// +----------------------------------------------------------------------
// | 栏目类
// +----------------------------------------------------------------------
// | Copyright (c) 2013 IUANCMS All Rights Reserved.
// +----------------------------------------------------------------------
// | Author: IUAN 
// | Web site: http://www.w3cdream.com
// +----------------------------------------------------------------------
	Class Category{

		//组合一维数组
		Static Public function unlimit($cate , $html='  --', $fid=0, $level=0){
			$arr=array();
				$n = str_pad('',$level,$html);					//str_pad() 函数把字符串填充为指定的长度，在空格前填充s个'-‘
				$n = str_replace($html,"  ",$n);		//str_replace 函数替换函数
			foreach($cate as $v){
				if($v['fid'] == $fid){
					$v['level'] = $level+1;
					$v['html']=str_repeat($html, $level);
					$arr[]=$v;
					$arr=array_merge($arr,self::unlimit($cate,$html,$v['id'],$level+1));
				}
			}
			return $arr;
		}

		//组合多维数组
		Static Public function unlimitson($cate, $name= 'child' , $pid=0){
			 $arr= array();

			 foreach ($cate as $v) {
			 	if ($v['fid'] == $fid){
			 		$v[$name] = self::unlimitson($cate , $name , $v['id']);
			 		$arr[] = $v;
			 	}
			 }
			 return $arr;
		}

		//传递一个子分类ID返回有的父级分类（上方导航）
		Static Public function getParents($cate , $id) {
			$arr=array();

			foreach ($cate as $v) {
				if ($v[id]  == $id) {
					$arr[] = $v;
					$arr = array_merge(self::getParents($cate , $v['fid']) , $arr);
				}
			}
			return $arr;
		}

		//传递一个父级分类ID返回所有子集分类ID
		Static Public function getChildId($cate , $fid){
			$arr = array();
			foreach ($cate as $v) {
				if ($v['fid'] == $fid) {
					$arr[]= $v['id'];
					$arr=array_merge($arr,self::getChildId($cate , $v['id']));
				}
			}
			return $arr;
		}

		//传递ID返回父级数组
		Static Public function getChild($cate , $fid){
			$arr = array();
			foreach ($cate as $v){
				if($v['fid'] ==$fid){
					$arr[] = $v;
					$arr = array_merge($arr,self::getChild($cate , $v[id]));
				}
			}
			return $arr;
		}

		//传递一个父级分类ID返回所有子集分类ID	Node
		Static Public function getNodeChildId($cate , $pid){
			$arr = array();
			foreach ($cate as $v) {
				if ($v['pid'] == $pid) {
					$arr[]= $v['id'];
					$arr=array_merge($arr,self::getNodeChildId($cate , $v['id']));
				}
			}
			return $arr;
		}

	}
?>