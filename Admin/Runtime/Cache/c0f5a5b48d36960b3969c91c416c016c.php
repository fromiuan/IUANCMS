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
			<th align="center">ID</th>
			<th>用户名称</th>
			<th>上一次登录时间</th>
			<th>上一次登录IP</th>
			<th>锁定状态</th>
			<th>用户所属别组</th>
			<th>操作</th>
		</tr>
		<?php if(is_array($user)): foreach($user as $key=>$v): ?><tr>
				<td align="center"><?php echo ($v["id"]); ?></td>
				<td align="center"><?php echo ($v["username"]); ?></td>
				<td><?php echo (date('y-m-d H:i',$v["logintime"])); ?></td>
				<td><?php echo ($v["loginip"]); ?></td>
				<td align="center">
					<?php if($v[lock] == 0): ?>没锁定<?php else: ?>锁定<?php endif; ?>
				</td>
				<td>
					<?php if($v["username"] == C("RBAC_SUPERADMIN")): ?>超级管理员<?php endif; ?>
					<ul>
						<?php if(is_array($v["role"])): foreach($v["role"] as $key=>$value): ?><li><?php echo ($value["name"]); ?>(<?php echo ($value["remark"]); ?>)</li><?php endforeach; endif; ?> 
					</ul>
				</td>
				<td>
					<a href="<?php echo U(GROUP_NAME .'/Rbac/setLock',array('lock' => $v['lock'],'rid' => $v['id']));?>">	<?php if($v[lock] == 1): ?>解锁<?php else: ?>锁定<?php endif; ?>
					</a>
					<a href="<?php echo U(GROUP_NAME .'/Rbac/delUser',array('userid' => $v['id']));?>">
						删除用户
					</a>
				</td>
			</tr><?php endforeach; endif; ?>
	</table>
</body>
</html>