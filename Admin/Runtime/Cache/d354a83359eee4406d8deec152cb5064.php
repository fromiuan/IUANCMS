<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>文章添加</title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/public.css">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/iuan.css">
<link  rel="stylesheet"  type="text/css"  href="__PUBLIC__/Css/bootstrap.css">    
<link  rel="stylesheet"  type="text/css"  href="__PUBLIC__/Css/theme.css">
<link  rel="stylesheet"  type="text/css"  href="__PUBLIC__/Css/font-awesome.css">
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/iuan.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/lhgcore.min.js"></script>
<script type="text/javascript" src="__ROOT__/Data/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="__ROOT__/Data/ueditor/ueditor.all.min.js"></script>
<SCRIPT TYPE="text/javascript">
	window.UEDITOR_HOME_URL = '__ROOT__/Data/ueditor';
	window.onload = function (){
		window.UEDITOR_CONFIG.initialFrameWidth = 900;
		window.UEDITOR_CONFIG.initialFrameHeight = 20;
		window.UEDITOR_CONFIG.imageUrl = "<?php echo U(GROUP_NAME . '/Blog/upload');?>";
      	window.UEDITOR_CONFIG.imagePath = "__ROOT__/Uploads/";
      	window.UEDITOR_CONFIG.imageManagerPath = "__ROOT__/";
      	//window.alert(window.UEDITOR_CONFIG.imageManagerPath);
		UE.getEditor('content');
	}
</SCRIPT>
</head>
<body>
	<form action="<?php echo U(GROUP_NAME . '/Blog/addBlog');?>" method="post" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<th colspan="2">博文发布</th>
			</tr>
			<tr>
				<td align="right" width="10%">所属分类</td>
				<td>
					<select name="cid">
						<option value="0">===请选择分类===</option>
						<?php if(is_array($cate)): foreach($cate as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>" ><?php echo ($v["html"]); echo ($v["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right">博文属性</td>
				<td>
					<?php if(is_array($flag)): $i = 0; $__LIST__ = $flag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><input type="checkbox" value="<?php echo ($key); ?>" name="aid[]" /> <?php echo ($v); endforeach; endif; else: echo "" ;endif; ?>
					<!-- <?php if(is_array($attr)): foreach($attr as $key=>$v): ?><input type="checkbox" value="<?php echo ($v["id"]); ?>" name="aid[]" <?php if($v['id'] == 1): ?>checked<?php endif; ?>> <?php echo ($v["name"]); ?>　<?php endforeach; endif; ?> -->
				</td>
			</tr>
			<tr>
				<td align="right">标题</td>
				<td>
					<input type="text" size="45" name="title">
				</td>
			</tr>
			<tr>
				<td align="right">缩略图</td>
				<td>
					<input type="checkbox" name="isLitpic" class="isLitpic" onclick='showLitpic()'>　<span id="isLitpic" style="display:black;">点击出现</span> 
					<input type="file" name="litpic" size="20" id="litpic" style="display:none;">
				</td>
			</tr>
			<tr>
				<td align="right">文章作者</td>
				<td>
					<input type="text" size="40" name="write">
					 文章来源
					<input type="text" size="40" name="source">
				</td>

			</tr>
			<tr>
				<td align='right'>摘要</td>
				<td>
					<textarea cols="80" rows="5" name="description" id="description"></textarea>
				</td>
			</tr>
			<tr>
				<td align="right">添加内容</td>
				<td>
					<div class="checkContent">
						<input type="checkbox" name="isFrist" />提取第一张为缩略图
						<input type="checkbox" name="isContent" checked="checked"/>提取文章摘要
						<input type="checkbox" name="isWater" id="isWater" Onclick="picWater()"/>图片水印
					</div>
					<textarea name="content" id="content"></textarea>
				</td>
			</tr>
			<tr>
				<td align="right"></td>
				<td>
					<div class="adText" id="adText" onclick='showAdSet()'>高级设置 <span>∨<span></div>
					<div class="adSet" id="adSet" style="display:none;">
						<div class="inputs">
							点击次数<input type="text" name="click" value="100" id="click"/>
							<span onclick="checkNum()">点击给力</span>
						</div>
						<div class="inputs">
							发布日期<input type="text" name="putdate" id="inp2" onclick="opcal();" value="<?php echo date('Y-m-d')?>"/>
					　　　　是否通过验证<input type="checkbox" style="" name="isPass" class="isPass"/>
						</div>
					</div>
				</td>
			</tr>
				
			<tr>
				<td align="center" colspan="2"> 
					<input type="submit" class="submit" value="添加文章">
				</td>
			</tr>
		</table>
	</form>
</div>
</body>
</html>