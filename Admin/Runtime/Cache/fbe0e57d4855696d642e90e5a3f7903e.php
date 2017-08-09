<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>数据库管理</title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/public.css">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/iuan.css">
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.7.2.min.js"></script>
</head>
    <div class="data-table">
        <div class="cf">
            <a id="export" class="btn" href="javascript:;" autocomplete="off">立即备份</a>
            <a id="optimize" class="btn" href="<?php echo U('optimize');?>">优化表</a>
            <a id="repair" class="btn" href="<?php echo U('repair');?>">修复表</a>
        </div>
        <form id="export-form" method="post" action="<?php echo U('export');?>">
            <table class="table">
                <thead>
                    <tr>
                        <td colspan="7" align="center"><strong>数据备份</strong></td>
                    </tr>
                    <tr align="center">
                        <th align="center">
                            <input type="checkbox" id="CheckedAll" />全选/全不选
                       	</th>
                        <th align="center">表名</th>
                        <th align="center">数据量</th>
                        <th align="center">数据大小</th>
                        <th align="center">创建时间</th>
                        <th align="center">备份状态</th>
                        <th align="center">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$table): $mod = ($i % 2 );++$i;?><tr>
                            <td class="num" align="center" width="2%">
                                <input class="ids" type="checkbox" name="tables[]" value="<?php echo ($table["name"]); ?>">
                            </td>
                            <td align="center" width="2%"><?php echo ($table["name"]); ?></td>
                            <td align="center" width="1%"><?php echo ($table["rows"]); ?></td>
                            <td align="center" width="1%"><?php echo (byte_format($table["data_length"])); ?></td>
                            <td align="center" width="3%"><?php echo ($table["create_time"]); ?></td>
                            <td align="center" width="2%" class="info">未备份</td>
                            <td align="center" width="3%" class="action">
                                <a href="<?php echo U('optimize?tables='.$table['name']);?>">优化表</a>&nbsp;
                                <a href="<?php echo U('repair?tables='.$table['name']);?>">修复表</a>
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </form>
    </div>
</body>
</html>
<script type="text/javascript">
    (function($){
        var $form = $("#export-form"), $export = $("#export"), tables
            $optimize = $("#optimize"), $repair = $("#repair");

        $optimize.add($repair).click(function(){
            $.post(this.href, $form.serialize(), function(data){
                if(data.status){
                    alert(data.info);
                } else {
                    alert(data.info,'alert-error');
                }
            }, "json");
            return false;
        });

        $export.click(function(){
            $export.parent().children().addClass("disabled");
            $export.html("正在发送备份请求...");
            $.post(
                $form.attr("action"),
                $form.serialize(),
                function(data){
                    if(data.status){
                        tables = data.tables;
                        $export.html(data.info + "开始备份，请不要关闭本页面！");
                        backup(data.tab);
                        window.onbeforeunload = function(){ return "正在备份数据库，请不要关闭！" }
                    } else {
                        alert(data.info);
                        $export.parent().children().removeClass("disabled");
                        $export.html("立即备份");
                    }
                },
                "json"
            );
            return false;
        });

        function backup(tab, status){
            status && showmsg(tab.id, "开始备份...(0%)");
            $.get($form.attr("action"), tab, function(data){
                if(data.status){
                    showmsg(tab.id, data.info);

                    if(!$.isPlainObject(data.tab)){
                        $export.parent().children().removeClass("disabled");
                        $export.html("备份完成，点击重新备份");
                        window.onbeforeunload = function(){ return null }
                        return;
                    }
                    backup(data.tab, tab.id != data.tab.id);
                } else {
                    alert(data.info);
                    $export.parent().children().removeClass("disabled");
                    $export.html("立即备份");
                }
            }, "json");

        }

        function showmsg(id, msg){
            $form.find("input[value=" + tables[id] + "]").closest("tr").find(".info").html(msg);
        }
		
        $("#CheckedAll").click(function(){
            $('.ids').attr("checked", this.checked );
        });
        $('.ids').click(function(){
            //定义一个临时变量，避免重复使用同一个选择器选择页面中的元素，提升程序效率。
            var $tmp=$('.ids');
            //用filter方法筛选出选中的复选框。并直接给CheckedAll赋值。
            $('#CheckedAll').attr('checked', $tmp.length==$tmp.filter(':checked').length);
        });


    })(jQuery);
    </script>