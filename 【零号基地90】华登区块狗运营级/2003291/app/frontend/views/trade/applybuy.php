<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php echo Yii::t('app', '创建申购订单');?></title>
        <link rel="stylesheet" href="/css/common2.css" />
        <link rel="stylesheet" href="/css/common.css" />
        <link rel="stylesheet" href="/css/send.css" />
    </head>
    <style>
        body{background:url(/img/bg2.png) no-repeat top left;background-size:100% 100%;}
        /*弹窗样式*/
        .diaitem {color: #fff;}
        .mask { display:none; width:100%; height:100%; position:absolute; left:0; top:0; z-index:1000; background:rgba(0,0,0,.3);}
        .dialog { display:none; width:100%; height:100%; position:absolute; left:0; z-index:1001;top:0px;}
        .dialog .alert { position:fixed; left:50%; top:50%; display:inline-block;width:80%; padding:10px 20px; background:#fff; color:#000; border-radius:8px; text-align:center;z-index:1002; height:50%; }
        .dialog .dialog_content { position:fixed; left:50%; top:50%; z-index:1003; border-radius:4px; width:60%;background:#005a7f;}
        .diatop{text-align: center;font-size:20px;font-weight:bold;line-height: 30px;margin:10px 0;color:#fff;}
        .dialist{max-height:210px;overflow: auto;padding:0px 10px;margin:0px;margin-bottom: 10px;}
        .dialist .diaitem{line-height:30px;font-size:14px;padding:0 10px;}
        .dialist .diaitem.on{background:#00b7ee;color:#fff;}
        .diabottom{border-top:1px solid #ccc;display: flex;justify-content: center;align-items: center;}
        .diabottom .diablink{text-align: center;font-size:18px;color:#fff;width:calc(50% - 1px);border-right:1px solid #ccc;line-height: 50px;}
        .diabottom .diablink:last-child{border:none;}
        
        /*支付密码弹窗*/
        .ball2{background:#005a7f;height:140px;}
        .client{margin-top:20px;color:#fff;}
        .client-1{height:20px;}
        .client-1 img{display: block;margin-top:10px;}
        .password-a{height:50px;}
        .pwd-box{border:none;}
        .fake-box input{background:#17b8e2;height:35px;width:35px;margin-right:10px;border:none;}
        .fake-box input:last-child{margin-right:0px;}
        .pwd-box input[type="tel"]{height:35px;}

        .accordion {box-shadow: 3px 3px 4px rgba(0,0,0,.8);}
        .accordionName{width:60px;}
        .accordionInput{width:calc(100% - 120px)}
        .accordionName{color:#fff;}
        .accordionInput{color:#fff;}
    </style>
    <body>
        <div class="am-container">
            <div class="am-g">
                <!--主背景块-->

                <div class="am-u-sm-12 userGo">
                    <div class="accordion" style="background:url(/img/baor_top.png) no-repeat top left;background-size:100% 100%;">
                        <div class="accordionImg accImg1">
                            <img src="/img/wallet_1.png" />
                        </div>
                        <div class="accordionName"><?php echo Yii::t('app', '卢宝');?>:</div>
                        <div class="accordionInput">
                            <?php echo $cash_wa; ?>
                        </div>
                    </div>

                    <div class="accordion" style="background:url(/img/baor_top.png) no-repeat top left;background-size:100% 100%;">
                        <div class="accordionImg accImg6">
                            <img src="/img/coins_1.png" />
                        </div>
                        <div class="accordionName">:</div>
                        <div class="accordionInput" style="width: calc(100% - 120px);">
                            <div style="width:100%;display: inline-block;text-align: right;" onclick="dialog('#d1')">
                                <span style="text-align:left;height:24px;width:calc(100% - 14px);overflow: hidden;float:left;" id="type" data="1" ><?php echo Yii::t('app', '请选择数字货币');?></span>
                                <img src="/img/goDown.png" style="width:14px;" />
                            </div>
                        </div>
                    </div>

                    <div class="accordion" style="background:url(/img/baor_top.png) no-repeat top left;background-size:100% 100%;">
                        <div class="accordionImg accImg1">
                            <img src="/img/head.png" />
                        </div>
                        <div class="accordionName"><?php echo Yii::t('app', '钱包地址');?>:</div>
                        <div class="accordionInput">
                            <input id="wallet_token" class="placeholder_ys" style="color:white;" type="text" value="" placeholder="<?php echo Yii::t('app', '请输入钱包地址');?>"/>
                        </div>
                    </div>
                    <div class="accordion" style="background:url(/img/baor_top.png) no-repeat top left;background-size:100% 100%;">
                        <div class="accordionImg accImg6">
                            <img src="/img/coins_1.png" />
                        </div>
                        <div class="accordionName"><?php echo Yii::t('app', '申购数量');?>:</div>
                        <div class="accordionInput" style="">
                            <input type="text" id="num" class="placeholder_ys" style="color:white;" name="price_min" placeholder="<?php echo Yii::t('app', '输入申购数量');?>"/>
                        </div>
                    </div>
                    <p style="font-size:12px;color:#fff;padding-left:10px;">20%</p>
                    <a style="float: right; color: rgb(21,179,213);" href="/trade/myapplylist.html"><?php echo Yii::t('app', '申购记录');?></a>
                </div>
                <div class="am-u-sm-12 safeLogout">
                    <button id="send-btn" type="button" onclick="" style="background:url(/img/baor_top.png) no-repeat top left;background-size:100% 100%;padding:10px 0;margin-top:50px;"><?php echo Yii::t('app', '确认');?></button>
                </div>
            </div>
        </div>
        <!--遮罩-->
        <div class="mask"></div>
        <!--弹窗-->
        <div class="dialog" id="d1">
            <div class="dialog_content">
                <p class="diatop"><?php echo Yii::t('app', '数字货币');?></p>
                <ul class="dialist">
                    <?php foreach ($coins as $coin): ?>
                    <li class="diaitem" value="<?php echo $coin['name']; ?>">
                        <span style="margin-left: 35px;"><?php echo $coin['en_name'].' -- '.$coin['name']; ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <div class="diabottom">
                    <a class="diablink" href="javascript:dialogClose();"><?php echo Yii::t('app', '取消');?></a>
                    <a class="diablink" href="javascript:dialogClose();"><?php echo Yii::t('app', '确定');?></a>
                </div>
            </div>
        </div>
        
        
        <!--交易密码弹窗-->
        <div class="shade" style="z-index: 9;"></div>
        <div class="ballBox">
            <div class="ball2">
                <div class="client-1"><img src="/img/guanbi.png"></div>
                <div class="client"><?php echo Yii::t('app', '交易密码'); ?></div>
                <div class="password-a">
                    <div class="pwd-box">
                        <input type="tel" maxlength="6" class="pwd-input" id="pwd-input">
                        <div class="fake-box" id="pwd-clear">
                            <input type="password" readonly="">
                            <input type="password" readonly="">
                            <input type="password" readonly="">
                            <input type="password" readonly="">
                            <input type="password" readonly="">
                            <input type="password" readonly="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script charset="utf-8" src="/js/3.2.1.js"></script>
        <script src="/js/jquery.min.js"></script>
        <script src="/js/interactive.js"></script>

        <script>
            $(function(){
                // 数字货币选择
                $(".dialist .diaitem").click(function(){
                    $(this).addClass("on").siblings(".diaitem").removeClass("on");
                });
//                $('input[name="price_min"]').change(function() {
//                    alert(1)
//                })
//                 $('input[name="price_min"]').on('input propertychange', function() {
//                     var type = $("#type").attr('data');
//                     var num = $("#num").val();
//                     // var mun2 = rate * num;
//                     // $(".accspan").html(mun2.toFixed(4));
//                      console.log(type);
//                 })


                //汇率变化
                $(".dialist li").click(function () {
                    var html = $(this).html();
                    var rate = $(this).attr('value');
                    $("#type").html(html);
                    $("#type").attr('data',rate);

                    var num = $("#num").val();
                    var mun2 = num * rate;
                    $(".accspan").html(mun2.toFixed(4));
                });
                
                //背景
                $("body").width($(document).outerWidth(true));
                $("body").height($(document).outerHeight(true));
                
                //支付密码
                $(".shade").hide();
                $(".ballBox").hide();
                $("#send-btn").click(function(){
                    $(".shade").fadeIn();
                    $(".ballBox").fadeIn();
                    $("#pwd-input").focus();
                });

                $(".client-1").click(function(){
                    $(".shade").hide();
                    $(".ballBox").hide();
                    $("#pwd-input").val('');
                });
            });

            function munber() {
                var mun = $(this).val();
                console.log(mun);
                var out_num = $("#out_num").val();
                var mun2 = mun * out_num;
                $(".accspan").html(mun2);
                $('#type').html($("this").html());
            }
            //弹窗js
            function dialog(id) {
                dialogClose()
                $(".mask").width($(document).outerWidth(true));
                $(".mask").height($(document).outerHeight(true));
                $(".mask").show();
                $(id).show();
                
                var dw = $(id + " .alert").outerWidth()/2;
                var dh = $(id + " .alert").outerHeight()/2;
                $(id + " .alert").css({"margin-top":-dh+"px"});
                var dw2 = $(id + " .dialog_content").outerWidth()/2;
                var dh2 = $(id + " .dialog_content").outerHeight()/2 - $(".alertbo").height()/2;
                $(id + " .dialog_content").css({"margin-left":-dw2+"px","margin-top":-dh2+"px"});
            }
            
            //弹窗取消
            function dialogClose() {
                $(".dialog").hide();
                $(".mask").hide();
            }
            
            //  密码框
            var a = false;
            var $input = $(".fake-box input");
            $("#pwd-input").on("input", function() {
                var pwd = $(this).val().trim();
                for (var i = 0, len = pwd.length; i < len; i++) {
                    $input.eq(i).val(pwd[i]);
                }
                $input.each(function() {
                    var index = $(this).index();
                    if (index >= len) {
                        $(this).val("");
                    }
                });
                if (len == 6 && a == false) {
                    a = true;
                    var type = $("#type").attr('data');
                    var num = $("#num").val();
                    var wallet_token = $("#wallet_token").val();

                    $.ajax({
                        type: "post",
                        data: {coin_type: type, num: num, wallet_token: wallet_token, jymm: pwd},
                        dataType: "json",
                        url: "/trade/applypurch.html",
                        success: function (data) {
                            if (data.status == '0001') {
                                alert(data.message);
                                window.location.href = '/trade/myapplylist.html';
                                // window.location.reload();//  刷新当前页面
                            } else {
                                alert(data.message);
                                $(".shade").hide();
                                $(".ballBox").hide();
                                a = false;
                                //  清除输入框密码
                                $('#pwd-input').val("");
                                for (var z = 0; z < $input.length; z++) {
                                    $input.eq(z).val('');
                                }
                            }
                        }
                    });
                }
            });
        </script>
    </body>

</html>