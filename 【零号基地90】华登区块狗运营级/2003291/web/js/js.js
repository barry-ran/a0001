//弹出框
function dialog(id,time,url) {
	dialogClose()
	$(".mask").width($(document).outerWidth(true));
	$(".mask").height($(document).outerHeight(true) - $(".header").height() - $(".acnav").height());
	
	$(".mask").show();
	$(id).show();
	
	var dw = $(id + " .alert").outerWidth()/2;
	var dh = $(id + " .alert").outerHeight()/2;
	$(id + " .alert").css({"margin-top":-dh+"px"});
	var dw2 = $(id + " .dialog_content").outerWidth()/2;
	var dh2 = $(id + " .dialog_content").outerHeight()/2 - $(".alertbo").height()/2;
	$(id + " .dialog_content").css({"margin-left":-dw2+"px","margin-top":-dh2+"px"});


	//假如有时间参数time，会定时关闭弹出框
	if(time){
		setTimeout(dialogClose,time);
	}
	if(url){
		setTimeout(function(){dialogUrl(url);},time);
	}
}
function dialogUrl(url) {
	window.location.href = url;
}
function dialogClose() {
	$(".dialog").hide();
	$(".mask").hide();
}

function resizeRoot(){
    var deviceWidth = document.documentElement.clientWidth,
        num = 750,
        num1 = num / 100;
    if(deviceWidth > num){
        deviceWidth = num;  
    }
    document.documentElement.style.fontSize = deviceWidth / num1 + "px";
}
//根节点HTML的字体大小初始化
resizeRoot();

window.onresize = function(){
    resizeRoot();
};


