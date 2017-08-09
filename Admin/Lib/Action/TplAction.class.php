<?php
// +----------------------------------------------------------------------
// | 模板控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2013 IUANCMS All Rights Reserved.
// +----------------------------------------------------------------------
// | Author: IUAN 
// | Web site: http://www.w3cdream.com
// +----------------------------------------------------------------------

class TplAction extends CommonAction{

	//前台显示
	function index(){
		import('ORG.File');
		$filedir = File::list_dir_info('./Public/templets',true);
		// p($filedir);
		$this->THEME=C('DEFAULT_THEME');					//默认模板
		$this->assign('filedir' , $filedir);				//
		$this->display();
	}

	//清理缓冲
	function clearcache(){
		import('ORG.File');
		$path = './Home/Runtime';
		File::del_dir($path);
		$this->success('操作成功',U('Tpl/index'));
	}


	//设置主题
	function settheme(){
		$data['DEFAULT_THEME'] = $_GET['theme'];

		if(F('theme' , $data ,CONF_PATH)){
				$this->success('修改成功',U(GROUP_NAME . '/Tpl/settheme'));
		}else{
				$this->error('修改失败'. CONF_PATH .'没有权限');
		}
	}

	//导出主题
	function outtheme(){
		$dir = $_GET['dir'];
		$dirname = $_GET['dirname'];

		if(empty($dir) || empty($dirname)){
			$this->error("目录或者文件不存在");
		}
		if(is_dir($dir)){
			$zipname = $dirname.'.zip';
			import('ORG.PclZip');
			$pclzip = new PclZip($zipname);
			$pclzip->create($dir,PCLZIP_OPT_REMOVE_PATH,$dir);
			if(file_exists($zipname)){
				$filename = $filename ? $filename : basename($zipname);
				$filetype = trim(substr(strrchr($filename, '.'), 1));
				$filesize = filesize($zipname);
				ob_end_clean();
				header('Cache-control: max-age=31536000');
				header('Expires: '.gmdate('D, d M Y H:i:s', time() + 31536000).' GMT');
				header('Content-Encoding: none');
				header('Content-Length: '.$filesize);
				header('Content-Disposition: attachment; filename='.$filename);
				header('Content-Type: '.$filetype);
				readfile($zipname);
				unlink($zipname);
				exit;
			}else{
				$this->error("文件不存在！");
			}
		}else{
			$this->error("请检查您传递的路径");
		}
	}

	//导入主题
	function import(){
		$this->display();
	}

	//主题导入出来
	function importHandle(){
		$filepath = I('filepath');

		import('ORG.Net.UploadFile');
	    $upload = new UploadFile();// 实例化上传类
	    $upload->allowExts  = array('zip');// 设置附件上传类型
	    $upload->savePath =  "$filepath";// 设置附件上传目录
	    if(!$upload->upload()) {// 上传错误提示错误信息
	        $this->error($upload->getErrorMsg());
	    }else{// 上传成功
	       	$info = $upload->getUploadFileInfo();
	       	$infopath = $info['0']['savepath'].$info['0']['savename'];

	        import('ORG.PclZip');
	        $pclzip =  new PclZip($infopath);
			if($pclzip->extract(PCLZIP_OPT_PATH,$filepath)){
				unlink($infopath);
				$this->success('操作成功!');
			}else{
				$this->error('操作失败@！！');
			}
	    }
				
	}
}
?>