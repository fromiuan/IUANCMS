<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo (C("cfg_webname")); ?></title>
<meta name="Keywords" content="<?php echo (C("cfg_keyword")); ?>" />
<meta name="Description" content="<?php echo (C("cfg_description")); ?>" />
<link rel="shortcut icon" href="__TMPL__/Images/favicon.ico" type="image/x-icon" />
<link href="__TMPL__/Css/default.css" rel="stylesheet" type="text/css"/>
<script src="__TMPL__/Js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="__TMPL__/Js/jquery.KinSlideshow-1.1.js" type="text/javascript"></script>
<script src="__TMPL__/Js/common.js" type="text/javascript"></script>
<script src="__TMPL__/Js/marquee.js" type="text/javascript"></script>
</head>
<body>
<div id="minibg">
    <div id="mini">
	<div id="dlt"><a onclick="this.style.behavior='url(#default#homepage)';this.setHomePage('http://'+window.location.host+'');"><font color="black">设为首页</font></a>|<a onClick="window.external.AddFavorite(location.href,document.title)"><font color="black">加入收藏</font></a>|<a id="StranLink">繁体中文</a></div>
	
         <div id="notice">
		 <dl id="marquee">
           <?php $__LIST__ = query("( SELECT concat('/iuancms/show_',blog.id,'.html') as arcurl,concat('<a href=\"/iuancms/show_',blog.id,'.html\">',`title`,'</a>') as arclink,concat('/iuancms/list_',blog.typeid,'.html') as typeurl,concat('<a href=\"/iuancms/list_',blog.typeid,'.html\">',`name`,'</a>') as typelink,title as fulltitle,blog.id AS id,blog.createtime AS createtime,blog.litpic AS litpic,blog.title AS title,cate.name AS name FROM hd_blog blog LEFT JOIN hd_cate cate ON blog.typeid=cate.id WHERE ( `arcrank` IN ('1','2','3') ) ORDER BY pubdate desc LIMIT 0,5   )");if(is_array($__LIST__)): $i = 0;foreach($__LIST__ as $key=>$_field): $mod = ($i % 2 );++$i;?><dt><a href="<?php echo $_field['arcurl'];?>"><?php echo $_field['title'];?></a></dt><?php endforeach; endif;?>
         </dl>
		 </div>
		 <script type="text/javascript">
				<!--
				new Marquee("marquee",0,3,300,24,50,3000,3000)
				//-->
			</script>
			
    <div id="mini2"><script language="javascript" src="__TMPL__/Js/date.js"></script></div>
	</div>
</div>

	<div id="head">
		<div id="logo">
			<img src="__TMPL__/Images/logo.png"/>
		</div>
		<div id="banner">
		<img src="__TMPL__/Images/8937772.gif" border="0"/>
		</div>
	</div>
	<div id="menu_out">
		<div id="menu_in">
			<div id="menu">
				<ul id="nav">
					<LI><A class="nav_on" id="mynav0" onmouseover="javascript:qh(0);" href="./"><SPAN>首 页</SPAN></A></LI>
					<?php $__LIST__ = query("( SELECT concat('/iuancms/list_',`id`,'.html') as typeurl,concat('<a href=\"/iuancms/list_',`id`,'.html\">',`name`,'</a>') as typelink,id as typeid,`name` FROM `hd_cate` WHERE ( `fid` = 0 ) ORDER BY sort asc LIMIT 0,9   )");if(is_array($__LIST__)): $i = 0;foreach($__LIST__ as $key=>$_field): $mod = ($i % 2 );++$i;?><li class="menu_line"></li>
					<li><a href="<?php echo $_field['typeurl'];?>" onmouseover="javascript:qh(<?php echo ($i); ?>);" id="mynav<?php echo ($i); ?>" class="nav_off"><span><?php echo $_field['name'];?></span></a></li><?php endforeach; endif;?>
				</ul>
				<div id="menu_con">
					<div id="qh_con0" style="DISPLAY: block">
						<ul></ul>
					</div>
				<?php $__LIST__ = query("( SELECT concat('/iuancms/list_',`id`,'.html') as typeurl,concat('<a href=\"/iuancms/list_',`id`,'.html\">',`name`,'</a>') as typelink,id as typeid,`name` FROM `hd_cate` WHERE ( `fid` = 0 ) ORDER BY sort asc LIMIT 0,9   )");if(is_array($__LIST__)): $i = 0;foreach($__LIST__ as $key=>$_field): $mod = ($i % 2 );++$i;?><div id="qh_con<?php echo ($i); ?>" style="DISPLAY: none">
						<ul>
						<?php $__LIST__ = query("( SELECT concat('/iuancms/list_',`id`,'.html') as typeurl,concat('<a href=\"/iuancms/list_',`id`,'.html\">',`name`,'</a>') as typelink,id as typeid,`name` FROM `hd_cate` WHERE ( `id` > 0 AND `fid`='".$_field['typeid']."') ORDER BY sort asc LIMIT 0,9   )");if(is_array($__LIST__)): $j = 0;foreach($__LIST__ as $key=>$_field): $mod = ($j % 2 );++$j;?><li><a href="<?php echo $_field['typeurl'];?>"><span><?php echo $_field['name'];?></span></A></LI><LI class="menu_line<?php echo ($i); ?>"></LI><?php endforeach; endif;?>
						</ul>
					</div><?php endforeach; endif;?>
				</div>
			</div>
		</div>
	</div> 
	<div id="positionbg">
	<div id="position"><?php echo $GLOBALS['_fields']['position'];?></div>
	<div id="sousuo"></div>
</div>
<div id="wrapper" style="margin-top:-10px;">
    <div id="IndexContent">
         <div id="IndexFlash" style="visibility:hidden;">
	
		 <?php $__LIST__ = query("( SELECT concat('/iuancms/show_',blog.id,'.html') as arcurl,concat('<a href=\"/iuancms/show_',blog.id,'.html\">',`title`,'</a>') as arclink,concat('/iuancms/list_',blog.typeid,'.html') as typeurl,concat('<a href=\"/iuancms/list_',blog.typeid,'.html\">',`name`,'</a>') as typelink,title as fulltitle,blog.id AS id,blog.createtime AS createtime,blog.litpic AS litpic,blog.title AS title,cate.name AS name FROM hd_blog blog LEFT JOIN hd_cate cate ON blog.typeid=cate.id WHERE (  FIND_IN_SET('f', flag)>0  ) AND ( `arcrank` IN ('1','2','3') ) ORDER BY blog.createtime desc LIMIT 0,5   )");if(is_array($__LIST__)): $i = 0;foreach($__LIST__ as $key=>$_field): $mod = ($i % 2 );++$i;?><a href="<?php echo $_field['arcurl'];?>" target="_blank"><img src="<?php echo empty($_field['litpic'])?'__TMPL__/Images/nopic.png':$_field['litpic'];?>" alt="<?php echo $_field['title'];?>" width="300" height="280"/></a><?php endforeach; endif;?>
		
		 </div>
         <div id="IndexHot">
		 <?php $__LIST__ = query("( SELECT concat('/iuancms/show_',blog.id,'.html') as arcurl,concat('<a href=\"/iuancms/show_',blog.id,'.html\">',`title`,'</a>') as arclink,concat('/iuancms/list_',blog.typeid,'.html') as typeurl,concat('<a href=\"/iuancms/list_',blog.typeid,'.html\">',`name`,'</a>') as typelink,title as fulltitle,blog.description AS description,blog.id AS id,blog.createtime AS createtime,blog.litpic AS litpic,blog.title AS title,cate.name AS name FROM hd_blog blog LEFT JOIN hd_cate cate ON blog.typeid=cate.id WHERE (  FIND_IN_SET('h', flag)>0  ) AND ( `arcrank` IN ('1','2','3') ) ORDER BY blog.createtime desc LIMIT 0,2   )");if(is_array($__LIST__)): $i = 0;foreach($__LIST__ as $key=>$_field): $mod = ($i % 2 );++$i;?><p class="IndexHotTitle"><a href="<?php echo $_field['arcurl'];?>"><?php echo $_field['title'];?></a></p>
		 <p class="IndexHotText"><?php echo cn_substr($_field['description'],0,60);?></p><?php endforeach; endif;?>
			  <div id="IndexHotList"><ul>
				<?php $__LIST__ = query("( SELECT concat('/iuancms/show_',blog.id,'.html') as arcurl,concat('<a href=\"/iuancms/show_',blog.id,'.html\">',`title`,'</a>') as arclink,concat('/iuancms/list_',blog.typeid,'.html') as typeurl,concat('<a href=\"/iuancms/list_',blog.typeid,'.html\">',`name`,'</a>') as typelink,title as fulltitle,blog.id AS id,blog.createtime AS createtime,blog.litpic AS litpic,blog.title AS title,cate.name AS name FROM hd_blog blog LEFT JOIN hd_cate cate ON blog.typeid=cate.id WHERE (  FIND_IN_SET('h', flag)>0  ) AND ( `arcrank` IN ('1','2','3') ) ORDER BY blog.createtime desc LIMIT 2,4   )");if(is_array($__LIST__)): $i = 0;foreach($__LIST__ as $key=>$_field): $mod = ($i % 2 );++$i;?><li><a href="<?php echo $_field['arcurl'];?>"><?php echo $_field['title'];?></a></li><?php endforeach; endif;?>
			  </ul></div>
		 </div>

		 <SCRIPT src="__TMPL__/Js/ScrollPic.js" type="text/javascript"></SCRIPT>
		 <div id="IndexPhoto">
		 <div id="IndexPhotoTitle">热门图文</div>
		 <ul id="indexpic">
		 <?php $__LIST__ = query("( SELECT concat('/iuancms/show_',blog.id,'.html') as arcurl,concat('<a href=\"/iuancms/show_',blog.id,'.html\">',`title`,'</a>') as arclink,concat('/iuancms/list_',blog.typeid,'.html') as typeurl,concat('<a href=\"/iuancms/list_',blog.typeid,'.html\">',`name`,'</a>') as typelink,title as fulltitle,blog.id AS id,blog.createtime AS createtime,blog.litpic AS litpic,blog.title AS title,cate.name AS name FROM hd_blog blog LEFT JOIN hd_cate cate ON blog.typeid=cate.id WHERE (  FIND_IN_SET('h', flag)>0  ) AND ( `arcrank` IN ('1','2','3') ) ORDER BY blog.createtime desc LIMIT 0,5   )");if(is_array($__LIST__)): $i = 0;foreach($__LIST__ as $key=>$_field): $mod = ($i % 2 );++$i;?><li><a href="<?php echo $_field['arcurl'];?>"><img src="<?php echo empty($_field['litpic'])?'__TMPL__/Images/nopic.png':$_field['litpic'];?>" width="160px" height="126px"><br/><?php echo $_field['title'];?></a></li><?php endforeach; endif;?>
		 </ul>
		<SCRIPT language="javascript" type="text/javascript">
		var pic = new ScrollPic();
		pic.scrollContId   = "indexpic"; //内容容器ID
		pic.arrLeftId      = "LeftArr";//左箭头ID
		pic.arrRightId     = "RightArr"; //右箭头ID
		pic.frameWidth     = 680;//显示框宽度
		pic.pageWidth      = 172; //翻页宽度
		pic.speed          = 10; //移动速度(单位毫秒，越小越快)
		pic.space          = 10; //每次移动像素(单位px，越大越快)
		pic.autoPlay       = true; //自动播放
		pic.autoPlayTime   = 3; //自动播放间隔时间(秒)
		pic.initialize(); //初始化
		</SCRIPT>
		 </div>
	
		<?php $__LIST__ = query("( SELECT concat('/iuancms/list_',`id`,'.html') as typeurl,concat('<a href=\"/iuancms/list_',`id`,'.html\">',`name`,'</a>') as typelink,id as typeid,`name` FROM `hd_cate` WHERE ( `fid` = 0 ) ORDER BY sort asc LIMIT 0,4   )");if(is_array($__LIST__)): $k = 0;foreach($__LIST__ as $key=>$_field): $mod = ($k % 2 );++$k;?><div class="<?php if($k%2==0): ?>IndexRght<?php else: ?>IndexLeft<?php endif; ?>">
		<div class="IndexContentTitle">
		<div class="IndexContentTitleLeft"><a href='<?php echo $_field['typeurl'];?>' class="bold font14"><?php echo $_field['name'];?></a></div>
		<div class="IndexContentTitleRight"><a href='<?php echo $_field['typeurl'];?>'>更多 &raquo;</a></div>
		</div>
		<div class="IndexContentList">
		<ul>
		<?php $__LIST__ = query("( SELECT concat('/iuancms/show_',blog.id,'.html') as arcurl,concat('<a href=\"/iuancms/show_',blog.id,'.html\">',`title`,'</a>') as arclink,concat('/iuancms/list_',blog.typeid,'.html') as typeurl,concat('<a href=\"/iuancms/list_',blog.typeid,'.html\">',`name`,'</a>') as typelink,title as fulltitle,blog.id AS id,blog.createtime AS createtime,blog.litpic AS litpic,blog.title AS title,cate.name AS name FROM hd_blog blog LEFT JOIN hd_cate cate ON blog.typeid=cate.id WHERE ( `arcrank` IN ('1','2','3') ) AND ( blog.typeid > 0 AND blog.typeid IN ("._arclist_getall_sonid($_field['typeid']).") ) ORDER BY blog.createtime desc LIMIT 0,8   )");if(is_array($__LIST__)): $i = 0;foreach($__LIST__ as $key=>$_field): $mod = ($i % 2 );++$i;?><li><a href="<?php echo $_field['arcurl'];?>"><?php echo $_field['title'];?></a></li><?php endforeach; endif;?>
		</ul>
		</div>
		</div><?php endforeach; endif;?>
   </div>

	<div id="IndexSide">
		 <div class="IndexSideText">
		      <div class="RRTitle">热门文章</div>
		      <div class="IndexSideList"><ul>
			  <?php $__LIST__ = query("( SELECT concat('/iuancms/show_',blog.id,'.html') as arcurl,concat('<a href=\"/iuancms/show_',blog.id,'.html\">',`title`,'</a>') as arclink,concat('/iuancms/list_',blog.typeid,'.html') as typeurl,concat('<a href=\"/iuancms/list_',blog.typeid,'.html\">',`name`,'</a>') as typelink,title as fulltitle,blog.id AS id,blog.createtime AS createtime,blog.litpic AS litpic,blog.title AS title,cate.name AS name FROM hd_blog blog LEFT JOIN hd_cate cate ON blog.typeid=cate.id WHERE ( `arcrank` IN ('1','2','3') ) ORDER BY blog.click desc LIMIT 0,10   )");if(is_array($__LIST__)): $i = 0;foreach($__LIST__ as $key=>$_field): $mod = ($i % 2 );++$i;?><li><a href="<?php echo $_field['arcurl'];?>"><?php echo $_field['title'];?></a></li><?php endforeach; endif;?>
			  </ul></div>
         </div>
		 
		
	     <div class="IndexSideText">
		      <div class="RRTitle">推荐文章</div>
		      <div class="IndexSideList"><ul>
			  <?php $__LIST__ = query("( SELECT concat('/iuancms/show_',blog.id,'.html') as arcurl,concat('<a href=\"/iuancms/show_',blog.id,'.html\">',`title`,'</a>') as arclink,concat('/iuancms/list_',blog.typeid,'.html') as typeurl,concat('<a href=\"/iuancms/list_',blog.typeid,'.html\">',`name`,'</a>') as typelink,title as fulltitle,blog.id AS id,blog.createtime AS createtime,blog.litpic AS litpic,blog.title AS title,cate.name AS name FROM hd_blog blog LEFT JOIN hd_cate cate ON blog.typeid=cate.id WHERE (  FIND_IN_SET('c', flag)>0  ) AND ( `arcrank` IN ('1','2','3') ) ORDER BY blog.createtime desc LIMIT 0,10   )");if(is_array($__LIST__)): $i = 0;foreach($__LIST__ as $key=>$_field): $mod = ($i % 2 );++$i;?><li><a href="<?php echo $_field['arcurl'];?>"><?php echo $_field['title'];?></a></li><?php endforeach; endif;?>
			</ul></div>
         </div>
	</div>
	<div id="FriendUrl">
    <div id="FriendUrlTitle">友情链接</div>
	<ul>
	<?php $__LIST__ = query("( SELECT `title`,content as friendurl,img as friendimg,concat('<a href=\"',`content`,'\">',`title`,'</a>') as friendlink FROM `hd_friendlink` WHERE ( `status` = 1 ) ORDER BY pubdate desc LIMIT 0,10   )");if(is_array($__LIST__)): $i = 0;foreach($__LIST__ as $key=>$_field): $mod = ($i % 2 );++$i;?><li><a href="<?php echo $_field['friendurl'];?>" target="_blank"><?php echo $_field['title'];?></a></li><?php endforeach; endif;?>
	</ul>
	
	<div class="clear"></div><div class="linkimg">
	<?php $__LIST__ = query("( SELECT `title`,content as friendurl,img as friendimg,concat('<a href=\"',`content`,'\">',`title`,'</a>') as friendlink FROM `hd_friendlink` WHERE ( `img` <> '' ) AND ( `status` = 1 ) ORDER BY pubdate desc LIMIT 0,10   )");if(is_array($__LIST__)): $i = 0;foreach($__LIST__ as $key=>$_field): $mod = ($i % 2 );++$i;?><a href="<?php echo $_field['friendurl'];?>" target="_blank" style="margin-right:20px;"><img src="<?php echo $_field['friendimg'];?>" alt="<?php echo $_field['title'];?>" width="88px" height="31px"/></a><?php endforeach; endif;?>
	</div>
</div>
<div id="copyrightbg">
<div id="copyright">
<p><iaun:global name='cfg_webname'/> (<a href="<?php echo (C("cfg_index")); ?>"><?php echo (C("cfg_webname")); ?></a>) © <?php echo date("Y");;?> 版权所有 All Rights Reserved.</p>
<p><iaun:global name='cfg_powerby'/> <a href="http://www.miibeian.gov.cn" target="_blank"><iaun:global name='cfg_beian'/></a></p>
<p>Powered by <b>IUANcms <a href="http://www.waikucms.com"  target="_blank"><?php echo C('SOFT_VERSION');?></a></b> </p>
</div>
</div>
<script language="javascript" src="__TMPL__/js/language.js"></script>

</body>
</html>