<?php
// +----------------------------------------------------------------------
// | 文章控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2013 IUANCMS All Rights Reserved.
// +----------------------------------------------------------------------
// | Author: IUAN 
// | Web site: http://www.w3cdream.com
// +----------------------------------------------------------------------
	Class BlogAction extends CommonAction{
		
		//博文列表
		Public function index(){
			import('ORG.Util.Page');// 导入分页类
			$Data = M('Blog'); // 实例化Data数据对象
			$count = $Data->where('arcrank < 4')->count();// 查询满足要求的总记录数
			$Page = new Page($count,10);// 实例化分页类 传入总记录数
    		$show = $Page->show();// 分页显示输出
			//$field=array('id','title','content','createtime','click','cid','del');
			//$where="'arcrank' lt 4";
			$this->blog=D('Blog')->where('arcrank < 4')->relation(true)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
    		$this->assign('page',$show);// 赋值分页输出
    		
    		$data = explode("admin.php", $_SERVER['HTTP_REFERER']);
			$this->urlaction = $data['0'];
			$this->display();
		}

		//单条新闻提交审核
		Public function passOne(){
			$Model = M('blog');
			$gispass=(int)$_GET['ispass'];
			$gid=(int)$_GET['id'];

			if($gispass==0){
				$string='转为待审核';
				$data = array(
					'id'=> $gid,
					'ispass'=> $gispass
				);

			}
			if($gispass==1){
				$string='审核通过';
				$data = array(
					'id'=> $gid,
					'ispass'=> $gispass
				);
			}
				if($Model->save($data)){
					$this->success("$string");
				}else{
					$this->error(失败);
				}
		} 

		//回收站
		Public function trach(){
			import('ORG.Util.Page');// 导入分页类
			$Data = M('Blog'); // 实例化Data数据对象
			$count = $Data->where('arcrank = 4')->count();// 查询满足要求的总记录数
			$Page = new Page($count,10);// 实例化分页类 传入总记录数
    		$show = $Page->show();// 分页显示输出
			//$field=array('id','title','content','createtime','click','typeid','arcrank');
			$where=array('arcrank' => 4);
			$this->blog=D('Blog')->where($where)->relation(true)->limit($Page->firstRow.','.$Page->listRows)->select();

			$data = explode("admin.php", $_SERVER['HTTP_REFERER']);

			$this->urlaction = $data['0'];
			$this->assign('page',$show);// 赋值分页输出
			$this->display('index');
		}

		//删除到回收站、还原数据
		Public function toTrach(){
			$Model = M('Blog');
			$update = array(
				'id' => (int) $_GET['id'],
				'arcrank' => (int) $_GET['type']
			);
			switch ($_GET['type']) {
				case '4':
					$text='已删除到回收站';
					break;
				case '1':
					$text='已恢复数据';
					break;
			}
			if($Model->save($update)){
				$this->success($text , U(GROUP_NAME . '/Blog/index'));
			}else{
				$this->error('删除失败');
			}
		}

		//彻底回收站数据
		Public function toDel(){
			$Model = M('Blog');
			$rid = $_GET['id'];
			if($Model->where(array('id' => $rid))->delete()){
				$attr=M('blog_attr')->where(array('bid' => $rid))->select();
				//p($attr);die;
				if(is_array($attr)){
					$count = count($attr);
					for ($i=0; $i < $count; $i++) { 
						M('blog_attr')->where(array('bid' => $attr[$i][bid]))->delete();
					}
				}
				$this->success('删除成功' , U(GROUP_NAME . '/Blog/index'));
			}else{
				$this->error('删除失败');
			}
		}

		//批量删除文章
		public function All_del(){
			$all_id = $_GET['num'];
			$Model = M('Blog');
			$map['id']  = array('in',"$all_id");
			$data['arcrank'] = 4;
			if($bid = $Model->where($map)->save($data)){
				echo "删除成功";
			}else{
				echo "删除失败";
			}
		}

		//批量审核
		public function All_pass(){
			$all_id = $_GET['num'];
			$Model = M('Blog');

			$map['id'] = array('in',"$all_id");
			$data['ispass'] = 1;
			if($bid = $Model->where($map)->save($data)){
				echo('审核成功');
			}else{
				echo('审核失败');
			}
		}

		//批量彻底删除
		public function All_del_over(){
			$all_id = $_GET['num'];
			$Model = M('Blog');
			$map['id']  = array('in',"$all_id");
			if($bid = $Model->where($map)->delete()){
				echo('删除成功');
			}else{
				echo('删除失败');
			}
		}

		//批量还原数据
		public function All_restore(){
			$all_id = $_GET['num'];
			$Model = M('Blog');
			
			$map['id'] = array('in',"$all_id");
			$data['arcrank'] = 1;
			if($bid = $Model->where($map)->save($data)){
				echo('还原成功');
			}else{
				echo('还原失败');
			}
		}

		//添加博文
		Public function blog(){

			$Model = M('Cate');
			$Modelattr = M('Attr');
			$this->water();								//重置SESSION['water']
			//博文所属分类
			import('Class.Category',APP_PATH);
			$cate=$Model->order('sort')->select();

			$this->cate=Category::unlimit($cate);		//博文分类
			
			$this->flag=$this->flag();					//博文属性		

			$this->display();
		}

		//添加博文表单处理
		Public function addBlog(){
			//D(Blog);
			// p($_POST);
			// die();
			if($_POST['cid']==0){
				$this->error("请选择分类");
			}
			if(isset($_POST['isLitpic'])){
				import('ORG.Net.UploadFile');
				$upload = new UploadFile();
				$upload->maxSize            = 3292200;
				$upload->allowExts          = explode(',', 'jpg,gif,png,jpeg');
				$upload->savePath           = './Uploads/';
		        $upload->thumb              = true;
		        $upload->imageClassPath     = 'ORG.Util.Image';
		        $upload->thumbPrefix        = 'm_';
		        $upload->thumbMaxWidth      = '400,100';
		        $upload->thumbMaxHeight     = '400,100';
				$upload->autoSub = true;
				$upload->subType = 'date';
				$upload->saveRule = 'time';

				if (!$upload->upload()) {
		            //捕获上传异常
		            $this->error($upload->getErrorMsg());
		        }else{
		        	//取得成功上传的文	件信息
            		$uploadList = $upload->getUploadFileInfo();
		        	import('ORG.Util.Image');
					if (C('cfg_water') || isset($_POST['isWater'])) {
						Image::water($uploadList[0]['savepath'] . $uploadList[0]['savename'], C('cfg_waterimg'));
		        	}
		        }
				

				$pathname=$uploadList[0]['savepath'] . $uploadList[0]['savename'];
			}elseif(isset($_POST['isFrist'])){
				import('Class.Getfrist' , APP_PATH);
				$getimg = new Getimg();
				$getimg->preg="/<img([^>]*)\s*src=('|\")([^'\"]+)('|\")/";
				$getimg->content=$_POST['content'];
				$match=$getimg->getPreg();
				$pathnames=$match[3][0];
				$webPaths = C('webPath');

				$pathname=str_replace("$webPaths","./","$pathnames");	//替换输出的路径中的/blog

			}
			if(isset($_POST['isContent'])){							//
				import('Class.Getfrist' , APP_PATH);
				$cut = new Getimg();
				$description=$cut->cutChar($_POST['content']);
			}else{
				$description=$_POST['description'];
			}

			foreach ($_POST['aid'] as $key => $value) {
				$text .=','.$value; 
			}
			$flag = ltrim("$text",",");

			$source = !empty($_POST['source']) ? $_POST['source']:'网站名称';
			$write = !empty($_POST['write']) ? $_POST['write'] : $_SESSION['username'];
			$ispass= isset($_POST['isPass']) ? 1 : 0;
			$putdate= empty($_POST['putdate']) ? date('Y-m-d') : $_POST['putdate'];

			$data = array(
				'title' => I('title'),
				'content' => $_POST['content'],
				'summary' => $_POST['summary'],
				'createtime' => $putdate,
				'click' => $_POST['click'],
				'typeid' => $_POST['cid'],
				'flag' => $flag,
				'write' => $write,
				'source' => $source,
				'description' => $description,
				'litpic' => $pathname,
				'ispass' => $ispass,
				'mid' =>$_SESSION['uid']
				);
			if($bid = M('blog')->add($data)){

				if(is_array($_POST['aid'])){
					$sql='INSERT INTO '.C(DB_PREFIX).'blog_attr(bid,aid) VALUES';
					foreach ($_POST['aid'] as $v) {
						$sql .= '('.$bid.',' . $v . '),';
					}
					$sql=rtrim($sql ,',');
					M('blog_attr')->query($sql);
				}

				$this->success('插入成功',U(GROUP_NAME . '/Blog/index'));
			}else{
				$this->error('插入失败');
			}
		}

		//编辑器图片上传
		Public function upload (){
			// if (!isset($_GET['isWater'])) {
			// 	$isWaters=0;
			// }elseif($_GET['isWater']==0){
			// 	$isWaters=0;
			// }else{
			// 	$isWaters=1;
			// }

			// echo $isWaters;
			// die();
			import('ORG.Net.UploadFile');
			$upload = new UploadFile();
			$upload->maxSize            = 3292200;
        	$upload->allowExts          = explode(',', 'jpg,gif,png,jpeg');
			$upload->savePath           = './Uploads/';
		    $upload->thumb              = true;
		    $upload->imageClassPath     = 'ORG.Util.Image';
		    $upload->thumbPrefix        = 'm_';
		    $upload->thumbMaxWidth      = '400,100';
		    $upload->thumbMaxHeight     = '400,100';
			$upload->autoSub = true;
			$upload->subType = 'date';
			$upload->saveRule = 'time';
			if (!$upload->upload()) {
		            //捕获上传异常
		        // $this->error($upload->getErrorMsg());
		        echo json_encode(array(
					 'state'=> $upload->getErrorMsg()
					));
		    }else{	        
		    	//取得成功上传的文件信息
            	$uploadList = $upload->getUploadFileInfo();
            	$upsavename = $uploadList[0]['savepath'] . $uploadList[0]['savename'];
            	import('ORG.Util.Image');
		        if (C('cfg_water') || $_SESSION['water']==1) {
		        	Image::water($upsavename, C('cfg_waterimg'));
		        }
		    	echo json_encode(array(
					'url' => $uploadList[0]['savename'],
					'fileType' => $info[0][extension],
					'original' => $info[0]['name'], 
					 'state' => 'SUCCESS'
				));
		    }

		}

		//修改文章
		Public function modify(){
			$Model = M('cate');

			$id=$_GET['id'];
			$this->modify=D('Blog')->where(array('id' => $id))->relation(true)->find();
			$this->mflag=$this->flag();
			$this->water();								//重置SESSION['water']
			//博文所属分类
			import('Class.Category',APP_PATH);
			$cate=$Model->order('sort')->select();
			$this->cates=Category::unlimit($cate);
			// p($modify['flag']);
			// die();
			$this->display();
		}

		//修改文章表单处理
		Public function modifyHandle(){
			//D(Blog);
			// p($_POST);
			// die();
			if($_POST['cid']==0){								//选择分类
				$this->error("请选择分类");
			}
			if(isset($_POST['isLitpic'])){						//如果点击了上传小图
				import('ORG.Net.UploadFile');
				$upload = new UploadFile();
				$upload->maxSize            = 3292200;
        		$upload->allowExts          = explode(',', 'jpg,gif,png,jpeg');
				$upload->savePath           = './Uploads/';
		        $upload->thumb              = true;
		        $upload->imageClassPath     = 'ORG.Util.Image';
		        $upload->thumbPrefix        = 'm_';
		        $upload->thumbMaxWidth      = '400,100';
		        $upload->thumbMaxHeight     = '400,100';
				$upload->autoSub = true;
				$upload->subType = 'date';
				$upload->saveRule = 'time';

				if (!$upload->upload()) {
		            //捕获上传异常
		            $this->error($upload->getErrorMsg());
		        }else{
		        	//取得成功上传的文件信息
            		$uploadList = $upload->getUploadFileInfo();
		        	import('ORG.Util.Image');
		        	if (C('cfg_water') || isset($_POST['isWater'])) {
		        		Image::water($uploadList[0]['savepath'] . $uploadList[0]['savename'], C('cfg_waterimg'));
		        	}
		        }
		        $pathname = $uploadList[0]['savepath'] . $uploadList[0]['savename'];
			}elseif(isset($_POST['isFrist'])){					//文章第一张图片小图
				import('Class.Getfrist' , APP_PATH);
				$getimg = new Getimg();
				$getimg->preg="/<img([^>]*)\s*src=('|\")([^'\"]+)('|\")/";
				$getimg->content=$_POST['content'];
				$match=$getimg->getPreg();
				$pathnames=$match[3][0];
				$webPaths = C('webPath');
				$pathname=str_replace("$webPaths","./","$pathnames");		//替换输出的路径中的/blog
			}else{
				$pathname=$_POST['hiddenlit'];
			}
			if(isset($_POST['isContent'])){								//自动截取内容简要
				import('Class.Getfrist' , APP_PATH);
				$cut = new Getimg();
				$description=$cut->cutChar($_POST['content']);
			}else{
				$description=$_POST['description'];
			}

			$source = !empty($_POST['source']) ? $_POST['source']:'网站名称';
			$write = !empty($_POST['write']) ? $_POST['write'] : $_SESSION['username'];
			$ispass= isset($_POST['isPass']) ? 1 : 0;
			$putdate= empty($_POST['putdate']) ? date('Y-m-d') : $_POST['putdate'];
			$id = $_POST['id'];

			foreach ($_POST['aid'] as $key => $value) {
				$text .=','.$value; 
			}
			$flag = ltrim("$text",",");

			$data = array(
				'title' => I('title'),
				'content' => $_POST['content'],
				'summary' => $_POST['summary'],
				'createtime' => $putdate,
				'click' => $_POST['click'],
				'typeid' => $_POST['cid'],
				'flag' => $flag,
				'write' => $write,
				'source' => $source,
				'description' => $description,
				'litpic' => $pathname,
				'ispass' => $ispass,
				'mid' =>$_SESSION['uid']
				);
			if($bid = M('blog')->where(array('id' => $id))->save($data)){
				$this->success('修改成功',U(GROUP_NAME . '/Blog/index'));
			}
		}

		//图片上传
		public function water(){
			$isWaters = isset($_GET['isWater']) ? $_GET['isWater'] : 0;
			session('water',$isWaters);

		}

		//公共函数
		protected function flag(){
			$flag = array(f=>"幻灯",c=>"推荐",h=>"热门",b=>"加粗");
			return $flag;
		}

		public function _dir_path($path) {
    		$path = str_replace('\\', '/', $path);
    		if (substr($path, -1) != '/')
        	$path = $path . '/';
    		return $path;
		}


	}
?>