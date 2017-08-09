<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>文件编辑</title>
<link rel="stylesheet" type="text/css" href="./Admin/Tpl/Public/Css/public.css">
<script type="text/javascript" src="./Admin/Tpl/Public/Js/file/admin.js"></script>
<script type="text/javascript" src="./Admin/Tpl/Public/Js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="./Admin/Tpl/Public/codemirror/codemirror.js"></script>
<link rel="stylesheet" type="text/css" href="./Admin/Tpl/Public/codemirror/codemirror.css">

</head>
<body>
<table class="table">
<form action="<?php echo U('FileManage/doedit');?>"   name="myform" method="post" id="myform" enctype="multipart/form-data">
<tr> 
    <td colspan="2" align="left" class="admintitle">文件编辑</td></tr>
<tr> 
<td width="20%" class="b1_1">当前文件位置</td>
<td class="b1_1"><input type='text' name='filename' value='<?php echo String::setCharset($filename);?>' size='100'/></td>
<input type='hidden' name='from' value="<?php echo ($_SERVER['HTTP_REFERER']); ?>"/>
</tr>

<tr>
  <td valign="top" class="b1_1" colspan="2"><p>快捷键:CTRL+F 查找 CTRL+G 正则替换 F11全屏 ESC取消全屏 选择编辑器风格: <select onchange="selectTheme()" id="select"><option selected>default</option><option>ambiance</option><option>blackboard</option><option>cobalt</option><option>eclipse</option><option>elegant</option><option>erlang-dark</option><option>lesser-dark</option><option>monokai</option><option>neat</option><option>night</option><option>rubyblue</option><option>solarized dark</option><option>solarized light</option><option>twilight</option><option>vibrant-ink</option><option>xq-dark</option></select></p><textarea id="Content" name="content"><?php echo ($content); ?></textarea>
</td>
</tr>
<tr>
<td class="b1_1" valign="top" style="text-align:center;" colspan="2"><input name="submit" type="submit" class="bnt" value="保 存">&nbsp;&nbsp;<input type="button" onclick="history.go(-1);" class="bnt" value="返 回"></td>
</tr>
</form>
</table>
<div style="text-align:center;margin:10px;">
<hr>
 
</div>
</body>
</html>
 <script>
      var editor = CodeMirror.fromTextArea(document.getElementById("Content"), {
        lineNumbers: true,
        matchBrackets: true,
        mode: "application/x-httpd-php",
        indentUnit: 4,
        indentWithTabs: true,
        enterMode: "keep",
        tabMode: "shift",
    styleActiveLine: false,
    lineNumbers: true,
    lineWrapping: true,
    indentWithTabs: true,
     autoCloseTags: true,
    highlightSelectionMatches: true,
    extraKeys: {
        "F11": function(cm) {
          setFullScreen(cm, !isFullScreen(cm));
        },
        "Esc": function(cm) {
          if (isFullScreen(cm)) setFullScreen(cm, false);
        }
      },
    gutters: ["CodeMirror-linenumbers", "breakpoints"]
      });
     var input = document.getElementById("select");
  function selectTheme() {
    var theme = input.options[input.selectedIndex].innerHTML;
    editor.setOption("theme", theme);
  }
  var choice = document.location.search &&
               decodeURIComponent(document.location.search.slice(1));
  if (choice) {
    input.value = choice;
    editor.setOption("theme", choice);
  }
  function isFullScreen(cm) {
      return /\bCodeMirror-fullscreen\b/.test(cm.getWrapperElement().className);
    }
    function winHeight() {
      return window.innerHeight || (document.documentElement || document.body).clientHeight;
    }
    function setFullScreen(cm, full) {
      var wrap = cm.getWrapperElement();
      if (full) {
        wrap.className += " CodeMirror-fullscreen";
        wrap.style.height = winHeight() + "px";
        document.documentElement.style.overflow = "hidden";
      } else {
        wrap.className = wrap.className.replace(" CodeMirror-fullscreen", "");
        wrap.style.height = "";
        document.documentElement.style.overflow = "";
      }
      cm.refresh();
    }
    CodeMirror.on(window, "resize", function() {
      var showing = document.body.getElementsByClassName("CodeMirror-fullscreen")[0];
      if (!showing) return;
      showing.CodeMirror.getWrapperElement().style.height = winHeight() + "px";
    });
  function makeMarker() {
  var marker = document.createElement("div");
  marker.style.color = "#822";
  marker.innerHTML = "●";
  return marker;
}
editor.on("gutterClick", function(cm, n) {
  var info = cm.lineInfo(n);
  cm.setGutterMarker(n, "breakpoints", info.gutterMarkers ? null : makeMarker());
});

 </script>