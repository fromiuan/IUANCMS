<?php
// +----------------------------------------------------------------------
// | 结点模型
// +----------------------------------------------------------------------
// | Copyright (c) 2013 IUANCMS All Rights Reserved.
// +----------------------------------------------------------------------
// | Author: IUAN 
// | Web site: http://www.w3cdream.com
// +----------------------------------------------------------------------
	Class NodeModel extends RelationModel{
		protected $_link=array(
		'Node'=> array(
		      'mapping_type'=>HAS_MANY,                    
		      'parent_key'=>'pid',                   
		      'mapping_name'=>'node',                    
		      'mapping_order'=>'sort',
		      ),
		'access'=>array(
			'mapping_type' => HAS_MANY,
			'foreign_key' => 'node_id',
			)
		);
	}
?>