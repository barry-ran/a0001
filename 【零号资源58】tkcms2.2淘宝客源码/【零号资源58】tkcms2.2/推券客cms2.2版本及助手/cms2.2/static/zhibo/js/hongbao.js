$(document).ready(function() {
	var win = (parseInt($(".couten").css("width"))) - 60;
	$(".mo,.mo2").css("height", $(document).height());
	$(".couten").css("height", $(document).height());
	$(".couten li").css({});
	// 点击确认的时候关闭模态层
	$(".sen a").click(function(){
	  $(".mo,.mo2").css("display", "none")
	});
	var cou=function(){
		$(".couten").hide();
	}
	var del = function(){
		nums++;
		$(".couten .li" + nums).remove();
		setTimeout(del,200);
	}
	
	var add = function() {
		for(var i=$(".couten li").length;i<15;i++){
			num++;
			var hb = parseInt(Math.random() * (3 - 1) + 1);
			$(".couten").append("<li class='li" + num + "' ><a href='javascript:;'><img src='img/hb_" + hb + ".png'></a></li>");
			var Left = parseInt(Math.random() * (win - 0) + 0);
			var Bottom = parseInt(Math.random() * ($(window).height() - 0)-0);
			$(".couten .li" + num).css({
				"left": Left,
				"bottom":Bottom,
			});
			var Wh = parseInt(Math.random() * (70 - 30) + 20);
			var rot = (parseInt(Math.random() * (45 - (-45)) - 45)) + "deg";
			$(".couten .li" + num + " a img").css({
				"width": Wh,
				"transform": "rotate(" + rot + ")",
				"-webkit-transform": "rotate(" + rot + ")",
				"-ms-transform": "rotate(" + rot + ")", /* Internet Explorer */
				"-moz-transform": "rotate(" + rot + ")", /* Firefox */
				"-webkit-transform": "rotate(" + rot + ")",/* Safari 和 Chrome */
				"-o-transform": "rotate(" + rot + ")", /* Opera */
			});	
			$(".couten .li" + num).animate({'top':$(window).height()+20},5000,function(){
				//删掉已经显示的红包
				this.remove();
				setTimeout(cou(),50000);//红包持续时间
			});
			//点击红包的时候弹出模态层
			$(".couten .li" + num).click(function(){
				$(".mo").css("display", "block");
				if($(".mo").show()){
					$(".couten").css("display","none");
				}
				$(".mo2").css("display", "block");
				if($(".mo2").show()){
					$(".couten").css("display","none");
				}
			});
			setTimeout(add,1000);
		}
	}
	
	
	//增加红包
	var num = 0;
	setTimeout(add,0);//红包出现时间
})



$(document).ready(function() {
    // 点击redbutton按钮时执行以下全部
    $('.redbutton').click(function(){
        // 在带有red样式的div中添加shake-chunk样式
        $('.red').addClass('shake-chunk');
        // 点击按钮2000毫秒后执行以下操作
        setTimeout(function(){
            // 在带有red样式的div中删除shake-chunk样式
            $('.red').removeClass('shake-chunk');
            // 将redbutton按钮隐藏
            $('.redbutton').css("display" , "none");
            // 修改red 下 span   背景图
            $('.red > span').css("background-image" , "url(img/red-y.png)");
            // 修改red-jg的css显示方式为块
            $('.red-jg').css("display" , "block");
        },0);
    });
});
