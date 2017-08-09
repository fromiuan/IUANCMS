$(function(){
	$("#IndexFlash").KinSlideshow({
			moveStyle:"right",
			titleBar:{titleBar_height:50,titleBar_bgColor:"#08355c",titleBar_alpha:0.5},
			titleFont:{TitleFont_size:12,TitleFont_color:"#FFFFFF",TitleFont_weight:"normal"},
			btn:{btn_bgColor:"#FFFFFF",btn_bgHoverColor:"#6FB33F",btn_fontColor:"#000000",btn_fontHoverColor:"#FFFFFF",btn_borderColor:"#cccccc",btn_borderHoverColor:"#6FB33F",btn_borderWidth:1}
	});
})
//导航切换*********
function qh(num){
	for(var id = 0;id<=9;id++)
	{
		if(id==num)
		{
			document.getElementById("qh_con"+id).style.display="block";
			document.getElementById("mynav"+id).className="nav_on";
		}
		else
		{
			document.getElementById("qh_con"+id).style.display="none";
			document.getElementById("mynav"+id).className="";
		}
	}
}
//屏蔽可忽略的js脚本错误
function killErr(){
	return true;
}
window.onerror=killErr;