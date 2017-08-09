<?php
// +----------------------------------------------------------------------
// | 用户模型
// +----------------------------------------------------------------------
// | Copyright (c) 2013 IUANCMS All Rights Reserved.
// +----------------------------------------------------------------------
// | Author: IUAN 
// | Web site: http://www.w3cdream.com
// +----------------------------------------------------------------------
	Class UserModel extends RelationModel{
		Protected $_link = array(
			'role_user' => array(
				'mapping_type' => HAS_MANY,
				'foreign_key' => 'user_id',
				),
			'role' => array(
				'mapping_type' => MANY_TO_MANY,
				'foreign_key' => 'user_id',
				'relation_key' => 'role_id',
				'relation_table' =>'hd_user_role',
				'mapping_fields' => 'id,name,remark',
				)
		);
	}
?>