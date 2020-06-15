$(document).ready(function () {
    /*左侧菜单效果---start*/
    $("#left_nav ul li").click(function () {
        $("#left_nav ul li.active").removeClass("active");
        $(this).addClass("active");
    });
    $('#left_nav .title').click(function () {
        var $ul = $(this).next('ul');
        //$('#left_nav').find('ul').slideUp();
        if ($ul.is(':visible')) {
            $(this).next('ul').slideUp();
        } else {
            $(this).next('ul').slideDown();
        }
    });
    /*左侧菜单效果---end*/
    // 获取窗口宽度
    if (window.innerWidth) {
        winWidth = window.innerWidth;
    } else if ((document.body) && (document.body.clientWidth)) {
        winWidth = document.body.clientWidth;
    }
    // 获取窗口高度
    if (window.innerHeight) {
        winHeight = window.innerHeight;
    } else if ((document.body) && (document.body.clientHeight)) {
        winHeight = document.body.clientHeight;
    }
    // 通过深入 Document 内部对 body 进行检测，获取窗口大小
    if (document.documentElement && document.documentElement.clientHeight && document.documentElement.clientWidth) {
        winHeight = document.documentElement.clientHeight;
        winWidth = document.documentElement.clientWidth;
    }
    $(window.document).scroll(function () {
        h = $(this).height();
        $("#leftmenu").css({"min-height": (h - 88) + "px"});
        $("#left_nav ol").css({"min-height": (h - 88 - 40) + "px"});
    });
    /*设置左侧菜单高度-----start*/
    $("#leftmenu").css({"min-height": (winHeight - 88) + "px"});
    $("#left_nav ol").css({"min-height": (winHeight - 88 - 40) + "px"});
    /*设置左侧菜单高度-----end*/
});