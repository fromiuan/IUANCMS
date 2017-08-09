<?php
// +----------------------------------------------------------------------
// | 文章模型
// +----------------------------------------------------------------------
// | Copyright (c) 2013 IUANCMS All Rights Reserved.
// +----------------------------------------------------------------------
// | Author: IUAN 
// | Web site: http://www.w3cdream.com
// +----------------------------------------------------------------------
	Class BlogModel extends RelationModel{
		Protected $_link = array(
			'cate' => array(
				'mapping_type' => BELONGS_TO,
				'foreign_key' => 'typeid',
				'mapping_fields' => 'name',
				'as_fields' => 'name:cate',
				),
			'user' => array(
				'mapping_type' => BELONGS_TO,
				'foreign_key' => 'mid',
				'mapping_fields' => 'username',
				'as_fields' => 'username:name'
				)
			);
	}
?>