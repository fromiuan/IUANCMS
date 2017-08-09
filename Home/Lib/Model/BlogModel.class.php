<?php
	Class BlogModel extends RelationModel{

		Protected $_link = array(
			'cate' => array(
				'mapping_type' => BELONGS_TO,
				'foreign_key' => 'typeid',
				'mapping_field' => 'name,tyllist,tplshow',
				'as_fields' => 'name:cate,tyllist:tyllist,tplshow:tplshow',
				)
			);

	}
?>