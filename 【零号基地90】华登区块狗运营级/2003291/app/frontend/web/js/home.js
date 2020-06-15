var mySwiper = new Swiper('.swiper-container', {
    autoplay: 3000, //自动轮播参数
    pagination: '.swiper-pagination', //分页器class
    loop: true, //无限循环
    grabCursor: true, //鼠标放上时变成手的形状
    paginationClickable: true, //点击分页切换图像
    autoplayDisableOnInteraction: false, //点击屏幕后仍然可以自动播放
    // 如果需要前进后退按钮
    nextButton: '.swiper-button-next',
    prevButton: '.swiper-button-prev'

})
//首页点击图片切换
//$("#wei").click(function() {
//    $("#wei").css("display", "none");
//    $("#dian").css("display", "block");
//})
//
//$("#dian").click(function() {
//    $("#wei").css("display", "block");
//    $("#dian").css("display", "none");
//})
//
//$("#chan").click(function() {
//    $("#chan").css("display", "none");
//    $("#zi").css("display", "block");
//})
//
//$("#zi").click(function() {
//    $("#zi").css("display", "none");
//    $("#chan").css("display", "block");
//})
//
//$("#my").click(function() {
//    $("#my").css("display", "none");
//    $("#self").css("display", "block");
//})
//
//$("#self").click(function() {
//    $("#my").css("display", "block");
//    $("#self").css("display", "none");
//})

//登录页点击事件
$("#open").on("click", function() {
    $("#open").css("display", "none");
    $("#close").css("display", "block");
})

$("#close").on("click", function() {
    $("#open").css("display", "block");
    $("#close").css("display", "none");
})

//交易记录选项卡切换
$("#outA").click(function(){
    $("#outA").css("color","red");
    $("#outA").css("border-bottom","1px solid red");
    $("#comeA").css("border-bottom","1px solid #D8D8D8");
    $("#comeA").css("color","black");
    $("#out").css("display","block");
    $("#come").css("display","none");
})

$("#comeA").click(function(){
    $("#comeA").css("color","red");
    $("#comeA").css("border-bottom","1px solid red");
    $("#outA").css("border-bottom","1px solid #D8D8D8");
    $("#outA").css("color","black");
    $("#out").css("display","none");
    $("#come").css("display","block");
})

//交易记录中遮罩层的关闭
$("#more").click(function(){
    $(".all").show();
    $(".hint").show();
})
$(".all").click(function(){
    $(".all").hide();
    $(".hint").hide();
})

$("li").click(function(){
    $(".all").hide();
    $(".hint").hide();
})

//设置页面中遮罩层的关闭
var status=1;
$("#lang").click(function(){
    $(".all").show();
    $(".language").show();
})
$(".all").click(function(){
    $(".all").hide();
    $(".language").hide();
})

$(".language4").click(function(){
    $(".all").hide();
    $(".language").hide();
})

$(".language5").click(function(){
    $(".all").hide();
    $(".language").hide();
    if(status==1){
        var Op=$("#p2").html();
        $("#moreL").html(Op);
    }else{
        var Op1=$("#p1").html();
        $("#moreL").html(Op1);
    }

})

$("#p1").click(function(){
    $("#p1").css("color","blue");
    $("#p2").css("color","black");
    status=2;
})

$("#p2").click(function(){
    $("#p2").css("color","blue");
    $("#p1").css("color","black");
    status=1;
})
//卖出页弹窗
$("#order").click(function(){
    $(".all").show();
    $(".hint").show();
})
