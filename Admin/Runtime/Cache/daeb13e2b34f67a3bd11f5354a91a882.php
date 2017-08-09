<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>文件上传助手</title>
<link type="text/css" rel="stylesheet" href="__PUBLIC__/css/iuan.css" />
<script type="text/javascript" src="__PUBLIC__/Js/file/admin.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/file/Ajax.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/file/art/jquery.artDialog.js?skin=blue"></script>
<script type="text/javascript" src="__PUBLIC__/Js/file/art/extend.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/file/art/plugins/iframeTools.js"></script>
<script type="text/javascript" src="__PUBLIC__/Common/uploadify/jquery.uploadify.min.js"></script>

<script type="text/javascript">
	$(function(){
	$('#file_upload').uploadify({
		'swf'      : '__PUBLIC__/Common/uploadify/uploadify.swf',
		'uploader' : '__ROOT__/admin.php?m=FileManage&a=doupload&dirname=<?php echo ($dirname); ?>',
		'buttonText' : '<div class="iuan_file_chosefile">选择文件</div>',
		'method'   : 'post',
		'multi'    : true,
		'onUploadSuccess' : function(file, data, response) {
			if(data==0)	art.dialog.tips('上传文件失败!');
        },
		'formData'  : {'uploadify':'<?php echo xmd5(C('COOKIE_PREFIX'));?>'},
		'onQueueComplete' : function(queueData) { art.dialog.open.origin.location.reload(); },
	});

});
</script>
</head>
<body>
<h4>上传文件至目录: <?php if(!empty($dirname)): echo ($dirname); else: ?>根目录<?php endif; ?> </h4>
<input id="file_upload" name="file_upload" type="file" style="display:none;"/>
</body>
</html>