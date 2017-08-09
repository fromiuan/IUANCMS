<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- saved from url=(0055)index.html -->
<html  lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta  charset="utf-8">
<title>IUANCMS</title>
<meta  content="IE=edge,chrome=1"  http-equiv="X-UA-Compatible">
<base target="iframe"/>
<link  rel="stylesheet"  type="text/css"  href="__PUBLIC__/Css/bootstrap.css">    
<link  rel="stylesheet"  type="text/css"  href="__PUBLIC__/Css/theme.css">
<link  rel="stylesheet"  type="text/css"  href="__PUBLIC__/Css/index.css">
<link  rel="stylesheet"  type="text/css"  href="__PUBLIC__/Css/public.css">
<script  src="__PUBLIC__/Js/jquery-1.7.2.min.js" type="text/javascript"></script>
<script  src="__PUBLIC__/Js/bootstrap.js" type="text/javascript"></script>
<script  src="__PUBLIC__/Js/iuan.js"  type="text/javascript"></script>
<script type="text/javascript" src="__PUBLIC__/Js/file/art/jquery.artDialog.js?skin=blue"></script>
<script type="text/javascript" src="__PUBLIC__/Js/file/art/extend.js"></script>
  </head>
<script type="text/javascript">
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

    function jprompt(urls){
      var dialog = art.dialog({
    content: '<p>原始密码：<input id="old_password" style="width:15em; padding:4px" /></p>'
      + '<p>设置密码：<input id="new_password" style="width:15em; padding:4px" /></p>'+'<p>设置密码：<input id="sure_password" style="width:15em; padding:4px" /></p>',
    fixed: true,
    id: 'Fm7',
    icon: 'question',
    okVal: '确认修改',
    ok: function () {
      var old_password = document.getElementById('old_password');
      var new_password = document.getElementById('new_password');
      var sure_password = document.getElementById('sure_password');
      $.ajax({
        type:"GET",
        url: "url",
        data: "isWater="+isWater+"",
        success: function(msg){
          if (input.value !== '\u52ff\u65bd\u4e8e\u4eba') {
              this.shake && this.shake();// 调用抖动接口
              input.select();
              input.focus();
              return false;
          } else {
              art.dialog({
                content: '恭喜你，修改成功！',
                  icon: 'succeed',
                  fixed: true,
                  lock: true,
                  time: 1.5
              });
          };
        }
      });
      // $.post(url, function(data){
      //     art.dialog.tips('成功删除指定内容',2);
      //     $('#'+id).fadeOut("slow");
      // });
    },
    cancel: true
});
    }
</script>
  <body  class=""> 
  <div id="top">
		<div  class="navbar">
			<div  class="navbar-inner">
				<ul  class="nav pull-right">
					<li><a  href="<?php echo U(GROUP_NAME .'/Index/logout');?>"  target="_self">退出</a></li>
					<li><a  href="__ROOT__"  target="_blank">网站主页</a></li>
                    <li><a  href="javascript:;"  target="_blank" onclick="jprompt('<?php echo U(GROUP_NAME .'/Index/clearallcache');?>')">修改密码</a></li>
                    <li><a href="javascript:;" onclick="jconfirm('','确定清除默认所有的缓冲吗?','<?php echo U(GROUP_NAME .'/Index/clearallcache');?>')">清除缓存</a></li>
				</ul>
					<div class="brand"><span class="first"></span> <span  class="second">IUANCMS</span></div>
			</div>
		</div>
  </div>

  <div id="left">	
		<div  class="sidebar-nav">
        	<form  class="search form-inline">
            	<input  type="text"  placeholder="Search...">
        	</form>
    		<?php if(is_array($node)): $i = 0; $__LIST__ = $node;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a  href="index.html#<?php echo ($v["name"]); ?>"  class="nav-header collapsed"  data-toggle="collapse"><i  class="icon-dashboard"></i><?php echo ($v["title"]); ?></a>
        			<ul  id="<?php echo ($v["name"]); ?>"  class="nav nav-list collapse"  style="height: 0px;">
            			<?php if(is_array($v[node])): $i = 0; $__LIST__ = $v[node];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><li><a  href="<?php echo U(GROUP_NAME .'/'.$v[name].'/'.$value[name]);?>"><?php echo ($value["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        			</ul><?php endforeach; endif; else: echo "" ;endif; ?>
        	<!-- <a href="<?php echo U(GROUP_NAME .'/Index/logout');?>" class="nav-header"><i class="icon-question-sign"></i>退出</a>
        	<a  href="http://www.w3cdream.com" target="_black" class="nav-header"><i  class="icon-comment"></i>答疑</a> -->
    	</div>
	</div>
  <div id="right">
		<iframe name="iframe" src="<?php echo U(GROUP_NAME .'/Index/main');?>"></iframe>
  </div>
</body>
</html>