<?php
// +----------------------------------------------------------------------
// | 用户模型
// +----------------------------------------------------------------------
// | Copyright (c) 2013 IUANCMS All Rights Reserved.
// +----------------------------------------------------------------------
// | Author: IUAN 
// | Web site: http://www.w3cdream.com
// +----------------------------------------------------------------------
	Class UserRelationModel extends RelationModel{
		//定义数据表名称
		Protected $tableName = 'user';
		Protected $_link = array(
			'role' => array(
				'mapping_type' => MANY_TO_MANY,
				'foreign_key' => 'user_id',
				'relation_key' => 'role_id',
				'relation_table' =>'hd_role_user',
				'mapping_fields' => 'id,name,remark'
				)
			);
	}
?>