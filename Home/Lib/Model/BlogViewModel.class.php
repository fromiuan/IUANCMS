<?php
	Class BlogViewModel extends ViewModel{

		public $viewFields = array(
		   'blog'=>array(
		   		'id','typeid','flag','title','content','createtime','click',
		   		'write','source','litpic','description','ispass',
		   		'del','voteid','mid',
		   		'_type'=>'LEFT'
		   	), 
		   	'cate'=>array(
		   		'name','_on'=>'blog.typeid=cate.id'
		   	), 
		);

	}
?>