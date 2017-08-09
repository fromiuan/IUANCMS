<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>主题导入</title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/public.css">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/iuan.css">
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.7.2.min.js"></script>
</head>
<div class="data-table">
    <form action="<?php echo U('Tpl/importHandle');?>" method="post" enctype="multipart/form-data">
    <table class="table">
            <thead>
                <tr>
                        <td colspan="7" align="center"><strong>主题导入</strong></td>
                </tr>
                <tr>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td width="30%"></td>
                        <td>导入地址：<input type="text" name="filepath" size="30" value="./Public/templets/"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>选择文件：<input type="file" name="filename" id="filename" /> </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="立即执行"></td>
                        <td></td>
                    </tr>
            </tbody>
        </table>
    </form>  
</div>
</body>
</html>