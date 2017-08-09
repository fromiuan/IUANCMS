<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>文件重命名</title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/public.css">
<script type="text/javascript" src="/iuancms/Public/Admin/js/admin.js"></script><script type="text/javascript" src="/iuancms/Public/Admin/js/Jquery.js"></script>
</head>
<body>
<table class="table">
<form action="<?php echo U('FileManage/dorename');?>"   name="myform" method="post" id="myform" enctype="multipart/form-data">
<tr> 
    <td colspan="2" align="left" class="admintitle">重命名操作</td></tr>
<tr> 
<td width="20%" class="b1_1">当前文件路径</td>
<td class="b1_1"><?php echo String::setCharset($filename);?></td>
<input type='hidden' name='prefilename' value='<?php echo String::setCharset($filename);?>'/>
<input type='hidden' name='from' value="<?php echo ($_SERVER['HTTP_REFERER']); ?>"/>
</tr>
<tr> 
<td width="20%" class="b1_1"><?php if(($isdir) == "1"): ?>当前文件名称<?php else: ?>当前文件夹名称<?php endif; ?></td>
<td class="b1_1"><input type='text' name='newfilename' value='<?php echo String::setCharset($filename);?>' size='100'/></td>
</tr>
<td width="20%" class="b1_1"></td>
<td class="b1_1"><input name="submit" type="submit" class="bnt" value="编 辑">&nbsp;&nbsp;<input type="button" onclick="history.go(-1);" class="bnt" value="返 回"></td>
</tr>
<input type='hidden' name='isdir' value='<?php echo ($isdir); ?>'/>
</form>
</table>
<div style="text-align:center;margin:10px;">
<hr>
 
</div>
</body>
</html>