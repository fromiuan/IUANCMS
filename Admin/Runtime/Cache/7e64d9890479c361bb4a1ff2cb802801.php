<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>分类列表</title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/public.css">
</head>

<body>
	<form action="<?php echo U(GROUP_NAME . '/Category/sortCate');?>" method="post">
		<table class="table">
			<tr>
				<th>ID</th>
				<th>名称</th>
				<th>级别</th>
				<th>排序</th>
				<th>操作</th>
			</tr>
			<?php if(is_array($cate)): foreach($cate as $key=>$v): ?><tr>
					<td><?php echo ($v["id"]); ?></td>
					<td><?php echo ($v["html"]); echo ($v["name"]); ?></td>
					<td align="center"><?php echo ($v["level"]); ?></td>
					<td>
						<input type="text" name='<?php echo ($v["id"]); ?>' value='<?php echo ($v["sort"]); ?>' />
					</td>
					<td>
						[<a href="<?php echo U(GROUP_NAME . '/Category/addCate',array('fid' => $v['id']));?>">添加子类</a>] 
						[<a href="<?php echo U(GROUP_NAME . '/Category/modifyCate',array('id' => $v['id']));?>">修改</a>]
						[<a href="javascript:if(confirm('将删除下面的分类?'))location='<?php echo U(GROUP_NAME . '/Category/delCate',array('id' => $v['id']));?>'">删除</a>]
					</td>
				</tr><?php endforeach; endif; ?>
		    <tr>
		    	<td colspan="5" align="center"><input type="submit" value="保存排序" class="submit"></td>
		    </tr>
		</table>
	</form>
</body>
</html>