<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/public.css"/>
<style type="text/css">
	textarea{
		border: solid 1px #dcdcdc;
		padding: 3px 6px;
		color: #999;
		background: #fff;
		vertical-align: middle;
	}
</style>
</head>

<body>
	<form action="<?php echo U('/System/setwebset');?>" method="post">
	<table class="table">
		<tr>
			<th colspan='3' align="center">站点设置</th>
		</tr>

		<tr>
			<td align="right">网站站点根网址</td>
			<td>
				<input type="text" name="cfg_basehost" size="30" value='<?php echo (C("cfg_basehost")); ?>'>
			</td>
			<td>cfg_basehost</td>
			
		</tr>

		<tr>
			<td align="right">网站主页链接</td>
			<td>
				<input type="text" name="cfg_index" value='<?php echo (C("cfg_index")); ?>'>
			</td>
			<td>cfg_index</td>
		</tr>

		<tr>
			<td align="right">网站主页名称</td>
			<td>
				<input type="text" name="cfg_indexname" value='<?php echo (C("cfg_indexname")); ?>'>
			</td>
			<td>cfg_indexname</td>
		</tr>

		<tr>
			<td align="right">网站名称</td>
			<td>
				<input type="text" name="cfg_webname" size="40" value='<?php echo (C("cfg_webname")); ?>'>
			</td>
			<td>cfg_webname</td>
		</tr>

		<tr>
				<td align="right">模版风格</td>
				<td>
					<input type="text" name="cfg_type" value="<?php echo (C("cfg_type")); ?>">
				</td>
				<td>cfg_type</td>
		</tr>

		<tr>
				<td align="right">全站水印</td>
				<td>
					<input type="radio" name="cfg_water" value="1" <?php if((C("cfg_water")) == "1"): ?>checked<?php endif; ?> >开启
					<input type="radio" name="cfg_water" value="0" <?php if((C("cfg_water")) == "0"): ?>checked<?php endif; ?> >关闭
				</td>
				<td>cfg_water</td>
		</tr>

		<tr>
			<td align="right">水印图片位置名称</td>
			<td>
				<input type="text" name="cfg_waterimg" size="50" value="<?php echo (C("cfg_waterimg")); ?>">
			</td>
			<td>cfg_waterimg</td>
		</tr>

		<tr>
			<td align="right">网站版权信息</td>
			<td>
				<textarea type="text" name="cfg_powerby" cols="60" rows="5"> <?php echo (C("cfg_powerby")); ?></textarea>
			</td>
			<td>cfg_powerby</td>
		</tr>

		<tr>
			<td align="right">站点默认的关键字</td>
			<td>
				<input type="text" name="cfg_keyword" size="60" value='<?php echo (C("cfg_keyword")); ?>'>
			</td>
			<td>cfg_keyword</td>
		</tr>

		<tr>
			<td align="right">网站描述</td>
			<td>
				<textarea name="cfg_description" rows="5" cols="60"><?php echo (C("cfg_description")); ?></textarea>
			</td>
			<td>cfg_description</td>
		</tr>

		<tr>
			<td align="right">网站备案号</td>
			<td>
				<input type="text" name="cfg_beian" size="40" value='<?php echo (C("cfg_beian")); ?>'>
			</td>
			<td>cfg_beian</td>
		</tr>

		<tr colspan="3">
			<td colspan='3' align="center">
				<input type="submit" value="保存修改">
			</td>
		</tr>
	</table>
	</form>
</body>
</html>