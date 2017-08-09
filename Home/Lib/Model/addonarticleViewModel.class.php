		<?php
			class addonarticleViewModel extends ViewModel 
			{
				public $viewFields = array
				(
					'archive'=>array('id','typeid','flag','modelid','senddate',
					'pubdate','click','keywords','description','money','arcrank',
					'writer','title','shorttitle','color','source',
					'litpic','voteid','mid','_type'=>'LEFT'), 
					'arctype'=>array('typename','temparticle','waptemparticle','_on'=>'archive.typeid=arctype.id','_type'=>'LEFT'),
					'member'=>array('username','_on'=>'archive.mid=member.id'),
					'addonarticle'=>array('body','redirecturl','_on'=>'archive.id=addonarticle.id'), 
				);
			}