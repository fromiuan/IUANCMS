<?php
// +----------------------------------------------------------------------
// | 内容页面
// +----------------------------------------------------------------------
// | Copyright (c) 2013 IUANCMS All Rights Reserved.
// +----------------------------------------------------------------------
// | Author: IUAN 
// | Web site: http://www.w3cdream.com
// +----------------------------------------------------------------------
	Class ShowAction extends CommonAction{
		Public function index(){
			
		$map['id'] = $_GET['id'];

		$model  = D('Blog');
		$list = $model->where($map)->relation(true)->find();
		//栏目链接 typelink
		$list['typeurl'] = url('list',$list['typeid']);
		$list['typelink'] = '<a href='.$list['typeurl'].'>'.$list['typename'].'</a>';
		//文章链接 arclink
		$list['arcurl'] = url('show',$list['id']);
		$list['arclink'] =  '<a href='.$list['arcurl'].'>'.$list['title'].'</a>';

		//上一页,下一页
		$list['prearticle'] = $this->updownarticle($list['createtime'],$list['typeid'],'up');
		$list['nextarticle'] = $this->updownarticle($list['createtime'],$list['typeid'],'down');
		//内链替换
		$list['body'] = $this->articlelink($list['body']);
		
		$GLOBALS['_fields'] = $list;
		$GLOBALS['_fields']['position'] = $this->position();

		//全文阅读判断
		$tpl = $GLOBALS['_fields']['tplshow'];
		$tplfile = empty($tpl) ? index : $tpl;
		$this->display($tplfile);
		}

   //上下篇
   private function updownarticle($pubdate,$typeid,$name='up')
   {
		$map['typeid'] = $typeid; 
		if($name=='up') 
		{
			$map['createtime'] = array('lt',$pubdate);
			$order = 'createtime desc';
		}
		if($name=='down')
		{
			$map['createtime'] = array('gt',$pubdate);
			$order = 'createtime asc';
		}		
		$map['arcrank']  = array('in','1,2,3');
		$model = M('blog');
		$list = $model->field('title,id')->where($map)->order($order)->find();
		if(!$list) return;
		//wap支持
		global $_parameter;
		$list['arcurl'] = url('show',$list['id'],$_parameter);
		return "<a href='{$list['arcurl']}'>{$list['title']}</a>";
   }
   
   //内链替换
   private function articlelink($data)
   {
		$model = M('articlelink');
		$list = $model->order('rank desc')->select();
		if(!$list) return $data;
		foreach($list as $v)
		{
			$link = '<a href=\''.$v['url'].'\'>'.$v['title'].'</a>';
			$data =  $v['num']==0 ? strtr($data,array($v['title']=>$link)) : preg_replace('#'.$v['title'].'#',$link,$data,$v['num']);
		}
		return $data;
   }

		Public function clickNum(){
			$id=(int) $_GET['id'];
			$where = array('id' => $id);
			$click = M('blog')->where($where)->getField('click');
			M('blog')->where($where)->setInc('click');
			echo 'document.write('.$click.')';
		}
	}
?>