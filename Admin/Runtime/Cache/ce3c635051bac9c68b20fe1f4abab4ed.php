<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>文件浏览</title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/public.css">
<script type="text/javascript" src="__PUBLIC__/Js/file/admin.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/file/Ajax.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/file/art/jquery.artDialog.js?skin=blue"></script>
<script type="text/javascript" src="__PUBLIC__/Js/file/art/extend.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/file/art/plugins/iframeTools.js"></script>

<script>
function jconfirm(id,str,url)
{
   $.dialog.confirm(str,function (){
    art.dialog.tips('请勿关闭浏览器,系统正在执行删除操作...',60);
   $.post(url, function(data){
     art.dialog.tips('成功删除指定内容',2);
	 $('#'+id).fadeOut("slow");
 });
   });
}
function jopen(url)
{
	art.dialog.open(url,
    {title: '文件上传组件', width: 300, height: 300});
}
</script>
</head>
<body>
<table class="table">
<tr> 
  <td colspan="6" align="left" class="admintitle"><span style="float:right;"><a href="<?php echo curPageURL();?>">[刷新]</a>&nbsp;<a href="javascript:;" onclick='history.go(-1)'>[返回]</a></span>文件管理器</td>
</tr>
    <tr bgcolor="#f1f3f5" style="font-weight:bold;">
    <td width="20%" align="center" class="ButtonList">文件夹/文件名</td>
  <td width="20%" align="center" class="ButtonList">文件类型</td>
  <td width="10%" align="center" class="ButtonList">文件权限</td>
  <td width="10%" align="center" class="ButtonList">文件大小</td>
  <td width="20%" align="center" class="ButtonList">修改时间</td>
  <td width="20%" align="center" class="ButtonList">相关操作</td>
    </tr>
  <tr bgcolor="#f1f3f5" style="font-weight:bold;">
  <td colspan="5" align="left"><?php if(!empty($_GET['dir'])): ?><img src="__PUBLIC__/Images/file/last.gif"> <a href="__ROOT__/admin.php?m=FileManage&a=index&dir=<?php echo urlencode($lastdir);?>">上级目录</a><?php endif; ?> 当前目录:<?php if(!empty($_GET['dir'])): echo urldecode($_GET['dir']); else: ?>根目录<?php endif; ?>&nbsp;&nbsp;<a href="__ROOT__/admin.php?m=FileManage&a=zip&dir=<?php echo urldecode($_GET['dir']);?>">打包当前目录</a>&nbsp;&nbsp;<a href="javascript:;" onclick="jopen('__ROOT__/admin.php?m=FileManage&a=upload&dir=<?php echo urldecode($_GET['dir']);?>')">上传文件到此目录</a> </td>
  <td><a href="__ROOT__/admin.php?m=FileManage&a=add&type=file&dir=<?php echo urlencode($_GET['dir']);?>" target='_blank'>新建文档</a>|<a href="__ROOT__/admin.php?m=FileManage&a=add&type=dir&dir=<?php echo urlencode($_GET['dir']);?>" target='_blank'>新建文件夹</a></td>
  </tr>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["type"]) == "dir"): ?><tr id="file_<?php echo ($i); ?>">
    <td align='left'><img src="__PUBLIC__/Images/file/folder.gif" width="16" height="16"><a href="__ROOT__/admin.php?m=FileManage&a=index&dir=<?php echo ($vo["nowdir"]); ?>"> <?php echo ($vo["filename"]); ?></a></td>
    <td>文件夹</td>
    <td>
  <?php if($vo.is_readable==true): ?><font color='green'>可读</font><?php else: ?><font color='red'>不可读</font><?php endif; ?>
  <?php if($vo.is_writeable==true): ?><font color='green'>可写</font><?php else: ?><font color='red'>不可写</font><?php endif; ?>
  </td>
    <td><?php echo (byte_format($vo["filesize"])); ?></td>
    <td><?php echo (getcolordate('Y-m-d H:i:s',$vo["mtime"])); ?></td>
    <td><a href="__ROOT__/admin.php?m=FileManage&a=getdown&dir=<?php echo ($vo["nowdir"]); ?>" target="_blank">下载</a>&nbsp;&nbsp;<a href="__ROOT__/admin.php?m=FileManage&a=index&dir=<?php echo ($vo["nowdir"]); ?>">浏览</a>&nbsp;&nbsp;<a href="__ROOT__/admin.php?m=FileManage&a=rename&dir=<?php echo ($vo["nowdir"]); ?>">重命名</a>&nbsp;&nbsp;<a href='javascript:' onclick="jconfirm('file_<?php echo ($i); ?>','确定删除文件夹<?php echo ($vo["filename"]); ?>?','__ROOT__/admin.php?m=FileManage&a=del&dir=<?php echo ($vo["nowdir"]); ?>')" >删除</a></td>
  </tr>
  <?php else: ?>
  <tr id="file_<?php echo ($i); ?>">
    <?php if(in_array(($vo["ext"]), explode(',',"jpg,gif,js,css,html,htm,php"))): ?><td align='left'><img src="__PUBLIC__/Images/file/<?php echo ($vo["ext"]); ?>.gif" width="16" height="16"> <?php echo ($vo["filename"]); ?></td>
    <?php else: ?>
  <?php if(in_array(($vo["ext"]), explode(',',"zip,rar,doc,ppt,png,txt,xls,pdf"))): ?><td align='left'><img src="__PUBLIC__/Editor/kindeditor/mini/<?php echo ($vo["ext"]); ?>.gif" width="16" height="16"> <?php echo ($vo["filename"]); ?></td>
    <?php else: ?>
  <td align='left'><img src="__PUBLIC__/Images/file/other.gif" width="16" height="16"> <?php echo ($vo["filename"]); ?></td><?php endif; endif; ?>
    <td><?php echo (gettplname($vo["filename"])); ?></td>
  <td>
  <?php if($vo.is_readable==true): ?><font color='green'>可读</font><?php else: ?><font color='red'>不可读</font><?php endif; ?>
  <?php if($vo.is_writeable==true): ?><font color='green'>可写</font><?php else: ?><font color='red'>不可写</font><?php endif; ?>
  </td>
    <td><?php echo (byte_format($vo["filesize"])); ?></td>
    <td><?php echo (getcolordate('Y-m-d H:i:s',$vo["mtime"])); ?></td>
   <?php if(ereg(".zip",$vo['filename'])){ ?>
    <td><a href="__ROOT__/admin.php?m=FileManage&a=getdown&dir=<?php echo ($vo["nowdir"]); ?>" target="_blank">下载</a>&nbsp;&nbsp;<a href="__ROOT__/admin.php?m=FileManage&a=unzip&dir=<?php echo ($vo["nowdir"]); ?>">解压</a>&nbsp;&nbsp;<a href="__ROOT__/admin.php?m=FileManage&a=rename&dir=<?php echo ($vo["nowdir"]); ?>">重命名</a>&nbsp;&nbsp;<a href="javascript:;" onclick="jconfirm('file_<?php echo ($i); ?>','确定删除文件<?php echo ($vo["filename"]); ?>?','<?php echo U('FileManage/del?dir='); echo ($vo["nowdir"]); ?>')">删除</a></td>
    <?php }elseif(ereg(".html|.htm|.txt|.css|.php|.js|.xml",$vo['filename'])){ ?>
    <td><a href="__ROOT__/admin.php?m=FileManage&a=getdown&dir=<?php echo ($vo["nowdir"]); ?>" target="_blank">下载</a>&nbsp;&nbsp;<a href="__ROOT__/admin.php?m=FileManage&a=edit&dir=<?php echo ($vo["nowdir"]); ?>">编辑</a>&nbsp;&nbsp;<a href="__ROOT__/admin.php?m=FileManage&a=rename&dir=<?php echo ($vo["nowdir"]); ?>">重命名</a>&nbsp;&nbsp;<a href="javascript:;" onclick="jconfirm('file_<?php echo ($i); ?>','确定删除文件<?php echo ($vo["filename"]); ?>?','__ROOT__/admin.php?m=FileManage&a=del&dir=<?php echo ($vo["nowdir"]); ?>')">删除</a></td>
    <?php }else{ ?>
    <td><a href="__ROOT__/admin.php?m=FileManage&a=getdown&dir=<?php echo ($vo["nowdir"]); ?>" target="_blank">下载</a>&nbsp;&nbsp;<a href="__ROOT__<?php echo urldecode($_GET['dir']);?>/<?php echo ($vo["filename"]); ?>" target='_blank'>浏览</a>&nbsp;&nbsp;<a href="__ROOT__/admin.php?m=FileManage&a=rename&dir=<?php echo ($vo["nowdir"]); ?>">重命名</a>&nbsp;&nbsp;<a href="javascript:;" onclick="jconfirm('file_<?php echo ($i); ?>','确定文件删除<?php echo ($vo["filename"]); ?>?','__ROOT__/admin.php?m=FileManage&a=del&dir=<?php echo ($vo["nowdir"]); ?>')">删除</a></td>
    <?php } ?>
  </tr><?php endif; endforeach; endif; else: echo "" ;endif; ?>
</table>
</form>
<div style="text-align:center;margin:10px;">
<div style="float:right;margin:20px;color">感谢pengyong插件:waikucms.net</div>
</div>
</body>
</html>