<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
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
<script type="text/javascript" src="__ROOT__/Data/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="__ROOT__/Data/ueditor/ueditor.all.min.js"></script>
<SCRIPT TYPE="text/javascript">
  window.UEDITOR_HOME_URL = '__ROOT__/Data/ueditor';
  window.onload = function (){
    window.UEDITOR_CONFIG.initialFrameWidth = 660;
    window.UEDITOR_CONFIG.initialFrameHeight = 200;
    window.UEDITOR_CONFIG.imageUrl = "<?php echo U(GROUP_NAME . '/Blog/upload');?>";
    window.UEDITOR_CONFIG.imagePath = "__ROOT__/Uploads/";
    window.UEDITOR_CONFIG.imageManagerPath = "__ROOT__/";
    window.UEDITOR_CONFIG.maximumWords = 200;
    window.UEDITOR_CONFIG.toolbars = [
          ['fullscreen', 'source', '|', 'undo', 'redo', '|',
                'bold', 'italic', 'underline', 'removeformat','|', 'forecolor', 'backcolor', '|',
                 'fontfamily', 'fontsize', '|','justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|',
                'link', 'unlink',  '|',
          ]
    ]
    UE.getEditor('content');
  }

</SCRIPT>
</head>

<body class=""> 
<div class="content">  
  <div  class="header">
      <div  class="stats">
        <p class="stat"><span  class="number">53</span>张票</p>
        <p class="stat"><span  class="number">27</span>个任务</p>
        <p class="stat"><span  class="number">15</span>排队中</p>
      </div>
        <h1  class="page-title">控制台</h1>
  </div>
        <ul  class="breadcrumb">
            <li><a  href="">首页</a> <span  class="divider">/</span></li>
            <li  class="active">控制台</li>
        </ul>

        <div  class="container-fluid">
            <div  class="row-fluid">
                    

<div  class="row-fluid">

    <div  class="alert alert-info">
        <button  type="button"  class="close"  data-dismiss="alert">×</button>
        <strong>IUANCMS:</strong> 欢迎使用本系统!
    </div>

    <div  class="block">
        <a  href="index.html#page-stats"  class="block-heading"  data-toggle="collapse">最新统计</a>
        <div  id="page-stats"  class="block-body collapse in">

            <div  class="stat-widget-container">
                <div  class="stat-widget">
                    <div  class="stat-button">
                        <p  class="title"><?php echo ($Blog); ?></p>
                        <p  class="detail">文章</p>
                    </div>
                </div>

                <div  class="stat-widget">
                    <div  class="stat-button">
                        <p  class="title"><?php echo ($User); ?></p>
                        <p  class="detail">用户</p>
                    </div>
                </div>

                <div  class="stat-widget">
                    <div  class="stat-button">
                        <p  class="title"><?php echo ($Theme); ?></p>
                        <p  class="detail">主题</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div  class="row-fluid">

    <div  class="block span6">
        <a  href="index.html#widget1container"  class="block-heading"  data-toggle="collapse">用户反馈 </a>
        <div  id="widget1container"  class="block-body in collapse"  style="height: auto;">
            <p></p>
            <p>您的姓名：<input type="text" name="yourname" id="yourname" size="20"> </p>
            <p>您的邮箱：<input type="text" name="youremail" id="youremail" size="40"></p>
            <p>反馈内容：<textarea style="padding-left:80px;" name="content" id="content"></textarea></p>
            <p><input type="submit" name="tujiao" value="提交建议" Onclick="feedBack()"></p>
        </div>
    </div>

    <div  class="block span6">
        <a  href="index.html#tablewidget"  class="block-heading"  data-toggle="collapse">系统更新<span  class="label label-warning">+10</span></a>
        <div  id="tablewidget"  class="block-body in collapse"  style="height: auto;">
             <div  id="widget1container"  class="block-body in collapse"  style="height: auto;">
              <h2>更新日志</h2>
            <p>2014-03-13  增加栏目模板自定义和文章模板自定义</p>  
            <p>2014-03-11  修复position定位功能、文章上下篇功能、全站global标签作用</p>
            <p>2014-03-06  更新后台反馈</p>
            <p>2014-03-05  更新后台模板</p>
            <p>2014-02-19  更新后台处理的图片水印问题，增加全站水印与自主水印，更新水印图片位置</p>
            <p>2014-02-13  恢复后台中文章的添加中的类型问题，修复文章无法添加，将全站的模板进行整理</p>
            <p>2014-01-26  增加网站主题自定义设计功能，将框架核心代码进行整顿。模板自主切换</p>
            <p>2014-01-20  布局后台主题，将主题设计完成</p>
            <p>2014-01-03  进行自定义变得的书写，融合其他CMS</p>
            <p>2013-12-25  进行插件的部署，将文件编辑插件融入系统</p>
        </div>
            <p><a  href="">More...</a></p>
        </div>
    </div>

</div>
                    <footer>
                        <hr>                      
                        <p>© 2012 <a  href="index.html#"  target="_blank">IUANCMS</a></p>
                    </footer>
                    
            </div>
        </div>