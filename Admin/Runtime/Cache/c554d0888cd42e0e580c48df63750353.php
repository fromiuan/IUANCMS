<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/public.css">
</head>

<body>
	<table class="table">
		<tr>
			<th>ID</th>
			<th>角色名称</th>
			<th>角色描述</th>
			<th>开启状态</th>
			<th>操作</th>

			<?php if(is_array($role)): foreach($role as $key=>$v): ?><tr>
					<td><?php echo ($v["id"]); ?></td>
					<td><?php echo ($v["name"]); ?></td>
					<td><?php echo ($v["remark"]); ?></td>
					<td>
						<?php if($v["status"]): ?>开启
							<?php else: ?>
							关闭<?php endif; ?>
					</td>
					<td><a href="<?php echo U(GROUP_NAME .'/Rbac/access',array('rid' => $v['id']));?>">配置权限</td>
				</tr><?php endforeach; endif; ?>
	</table>
</body>
</html>