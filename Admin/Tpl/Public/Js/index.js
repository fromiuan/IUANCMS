
$(function(){
	resize_window();
	$(window).resize(function(){
		resize_window();
	});
	$('.demo-cancel-click').click(function(){return false;});
})

function resize_window(){
	$("#left").height($(window).height()-42);
	$("#right").height($(window).height()-42).width($(window).width()-211);
}


//提交反馈mian
function feedBack(){
	var yourname = $("#yourname").val();
	var youremail = $("#youremail").val();
	var content = getContentTxt();
	if (yourname=='') {
		alert('请填写姓名');
	}else if(youremail==''){
		alert("请填写邮箱");
	}else if(content ==''){
		alert("请填写内容")
	}else{
		$.ajax({
			type: "POST",
			url: "./send_mail",
			data: "content="+content+"",
			success: function(msg){
				alert(msg);
			}
		});
	}
}

//Ueditor获取函数内容
function getContentTxt() {
    var arr = [];
    arr.push(UE.getEditor('content').getContentTxt());
    return arr;
  }