$(function(){
	//点击更多 显示和关闭右侧隐藏导航
	$(".right-nav").click(function(){
		if($(this).hasClass("btn-more-close")){
			$(this).removeClass("btn-more-close");
			$(".hideDiv").hide();
		}else{
			$(this).addClass("btn-more-close");
			$(".hideDiv").fadeIn(300);
		}
		
	});
	//弹幕点击
	$(".switch-btn").click(function(){
		if($(this).hasClass("switch-btn-on")){
			$(this).removeClass("switch-btn-on").addClass("switch-btn-off");
			$(".barrage").hide();
			$(".barrage").css("z-index",-1);
		}else{
			$(this).addClass("switch-btn-on").removeClass("switch-btn-off");
			$(".barrage").show();
			$(".barrage").css("z-index",9);
		}	
	});
	//头部右箭头点击
	var count = 0 ;
	$(".live-right-arrow").click(function(){
		//总长度
		var totalWidth = $(".overflow-div ul").width() ;
		//px 每次移动8个 头像（0.747+0.107）*8=6.832 --> 256.2px
		var len = 256.2 ;
		var leftLen = len*count;
		//需要移动N次 N=Math.ceil(countLen)
		var countLen = Math.ceil(totalWidth/len) ;
		$(".overflow-div ul").css({"left":-len,"transition":"left 0.5s ease 0s"});
		count ++ ;
		if(count <= countLen){
			$(".overflow-div ul").css({"left":-leftLen,"transition":"left 0.5s ease 0s"});
		}else{
			count = 0 ;
		}
	});
	
	//footer 内input获取焦点
	$("footer .middle-input input").click(function(){
        $("footer").hide();
        $(".input-box-bot").show();
		$("#barrageTxt").trigger("focus");

	});
 	$("#barrageTxt").bind('click',function(e){
        var $this = $(this);
        e.preventDefault();
        setTimeout(function(){
            $(window).scrollTop($this.offset().top - 10);
        },10)
    });

    //input-box-bot内点击关闭
	$(".input-box-bot .input-close-btn").click(function(){
		$(".input-box-bot").hide();
		$("footer").show();
	});
	//清空input输入框
	$(".clearInput").click(function(){
		$("#barrageTxt").val("");
	});
	
	//弹幕
	
	
	});

	/*判断如果红包下有p标签说明文字，设置红包信息出现函数*/
	function hongbao(){
		var $hongbao =$(".hongbao");
		if($hongbao.is(':has(p)')){
			$hongbao.css("left","0.32rem")
		} else {
			$hongbao.css('left',"-5.333rem");
		}
	}
	function peopleInWay(){
		var $peopleInWay =$(".peopleInWay");
		$peopleInWay.css('left',"-5.293rem");
		$peopleInWay.css("left","0.32rem")
		/*
		var $peopleInWay =$(".peopleInWay");
		if($peopleInWay.is(':has(span)')){
			$peopleInWay.css("left","0.32rem")
		} else {
			$peopleInWay.css('left',"-5.293rem");
		}
		*/
	}
