<?php
// +----------------------------------------------------------------------
// | 入口控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2013 IUANCMS All Rights Reserved.
// +----------------------------------------------------------------------
// | Author: IUAN 
// | Web site: http://www.w3cdream.com
// +----------------------------------------------------------------------
	Class IndexAction extends CommonAction{

		// 主控制页面
		Public function index(){
			if(session(C(ADMIN_AUTH_KEY))){
				$node=D('Node')->where(array('level' => 2))->order(sort)->relation(true)->select();
				//p($_SESSION);
				//die();
			}else{
				//取出所以的节点
				$node=D('Node')->where(array('level' => 2))->order(sort)->relation(true)->select();
				//取出当前登录用户的所以模块（英文名称）和操作方法(ID)
				$accessList=$_SESSION['_ACCESS_LIST'];
				//p($_SESSION);
				//p($accessList);
				//die();
				foreach ($accessList as $key => $value) {
					foreach ($value as $key1 => $value1) {
						$module=$module.','.$key1;
						foreach ($value1 as $key2 => $value2) {
							$node_id=$node_id.','.$value2;
						}
					}
				}
				foreach ($node as $key => $value) {
					if(!in_array(strtoupper($value['name']), explode(',',$module))){
						unset($node[$key]);

					}else{
						//模块操作方法
						foreach ($value['node'] as $key1 => $value1) {

							if(!in_array($value1[id],explode(',', $node_id))){
								unset($node[$key]['node'][$key1]);
							}
						}
					}
				}
			}
			$this->assign('node',$node);
			$this->display();
		}

		// 右边显示区域
		Public function main(){
			$BlogModel = M('Blog');
			$UserModel = M('User');
			import('ORG.File');
			$filedir = File::list_dir_info('./Public/templets',true);
			$this->Theme =count($filedir);
			$this->Blog = $BlogModel->count('id');
			$this->User = $UserModel->count('id');
			$this->display();
		}

		//反馈邮件发送
		Public function send_mail() {
			$content = $_POST['content'];
			$title = "IUANCMS建议";
			$from = '';
			$to = '';
			$charset='utf8';
			$attachment ='';

			if ($content=='') {
				echo "请填写内容";
			}
			import('ORG.Mail.PHPMailer');// 导入分页类
			header('Content-Type: text/html; charset='.$charset); 
			$mail = new PHPMailer(); 
			$mail->CharSet = $charset; //设置采用gb2312中文编码 
			$mail->IsSMTP(); //设置采用SMTP方式发送邮件 
			$mail->Host = "smtp.qq.com"; //设置邮件服务器的地址 
			$mail->Port = 25; //设置邮件服务器的端口，默认为25 
			$mail->From = $from; //设置发件人的邮箱地址 
			$mail->FromName = ""; //设置发件人的姓名 
			$mail->SMTPAuth = true; //设置SMTP是否需要密码验证，true表示需要 
			$mail->Username = $from; //设置发送邮件的邮箱 
			$mail->Password = ""; //设置邮箱的密码 
			$mail->Subject = $title; //设置邮件的标题 
			$mail->AltBody = "text/html"; // optional, comment out and test 
			$mail->Body = $content; //设置邮件内容 
			$mail->IsHTML(true); //设置内容是否为html类型 
			$mail->WordWrap = 50; //设置每行的字符数 
			$mail->AddReplyTo($to,"名字"); //设置回复的收件人的地址 
			$mail->AddAddress($to,"收件人地址"); //设置收件的地址 
			if ($attachment != '') //设置附件 
			{ 
				$mail->AddAttachment($attachment, $attachment); 
			} 
			if(!$mail->Send()) 
			{ 
				echo "邮件发送失败"; 
			} else { 
				echo "反馈邮件发送成功\n谢谢您的宝贵建议"; 
			} 
		}

	function clearallcache(){
		import('ORG.File');
		$path = './Home/Runtime';
		File::del_dir($path);
		$paths = './Admin/Runtime';
		File::del_dir($paths);
		$this->success('操作成功');
	}

		//退出命令
		Public function logout(){
			session_unset();
			session_destroy();
			$this->redirect('Admin/Login/index');
		}
	}
?>