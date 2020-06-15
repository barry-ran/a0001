<!DOCTYPE html>
<html lang="zh-CN" class="ACCOUNT">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php  echo $title2; ?></title>
<!--    <link href="/css/admin.css" rel="stylesheet">-->
    <link href="/css/amazeui.min.css" rel="stylesheet">
    <link href="/css/myassets.css" rel="stylesheet">
    <!--    <link href="/css/app.css" rel="stylesheet">-->
<!--    <link href="/css/base.css" rel="stylesheet">-->
<!--    <link href="/css/home.css" rel="stylesheet">-->
<!--    <link href="/css/login.css" rel="stylesheet">-->
<!--    <link href="/css/swiper-3.3.1.min.css" rel="stylesheet">-->
<!--    <link rel="stylesheet" href="/css/amazeui.min.css" />-->
    <link rel="stylesheet" href="/css/common2.css" />
<!--    <link rel="stylesheet" href="/css/resetTable2.css" />-->
<!--    <link rel="stylesheet" href="/css/page2.css?version=1" />-->
    <style>
     
        .num_t {
            color: #1E88E5;
            border: 1px solid #1E88E5;
            text-align: center;
            width: 31%;
        }
        .orderNav {
            border-bottom: 0;
        }
        .orderArticleName {
            color: #333;
        }
        .orderArticleValue .on{
            background: #1E88E5;
            color: #FFF;
        }
        .balance{ border-right: 0;}
        .approve {
            width: 100%;
            height: 80px;
            border-radius: 10px 10px 0 0;
            border: 1px solid #1E88E5;
        }
        .approve1 {
            width: 100%;
            height: 40px;
            border-radius: 10px 10px 0 0;
            background-color: #1E88E5;
        }
        .ren {
            width: 50px;
            height: 25px;
            border: 1px solid white;
            border-radius: 5px;
            float: right;
            margin-top: -53px;
            line-height: 25px;
            font-size: 13px;
            text-align: center;
            color: white;
            margin-right: 10px;
        }
        .ren1 {
            width: 50px;
            height: 25px;
            background-color: gainsboro;
            border-radius: 5px;
            float: right;
            margin-top: -53px;
            line-height: 25px;
            font-size: 13px;
            text-align: center;
            color: red;
            margin-right: 10px;
        }

        .addcard{
            width:100%;
            height:40px;
            text-align: center;
            margin-top: 20px;
            line-height: 40px;
            border: 2px solid #e8e7e7;
            border-radius: 10px;
            font-size: 15px;
            color: #000;
        }
        
        body{background:url(/img/bg2.png) no-repeat top left;background-size:100% 100%;}
        .orderPrice{padding:12px 0;}
        .orderPrice{padding:0px;}
        .orderArticle{padding:0;border-radius: 0;background:none;}
        .orderNav{background:url(/img/baor_top.png) no-repeat top left;background-size:100% 100%;padding:5px 10px;margin-bottom:5px;-moz-box-shadow: 3px 3px 4px rgba(0,0,0,.8);-webkit-box-shadow: 3px 3px 4px rgba(0,0,0,.8);box-shadow: 3px 3px 4px rgba(0,0,0,.8);}
        .orderArticleName{color:#fff;}
        #deletePrice{color:#fff;}
        
        #addPrice{color:#fff;}
        .num_t{color:#01d3dd;border-color:#01d3dd;border-radius: 3px;}
        .addcard{border-color:#01d3dd;display: flex;align-items: center;justify-content: center;}
        .addcard span{color:#fff;}
        .approve1{border-radius: 0px;background:url(/img/baor_top.png) no-repeat top left;background-size:100% 100%;margin-bottom:5px;-moz-box-shadow: 3px 3px 4px rgba(0,0,0,.8);-webkit-box-shadow: 3px 3px 4px rgba(0,0,0,.8);box-shadow: 3px 3px 4px rgba(0,0,0,.8);}
        
        /*弹窗*/
        .ball2{background:#005a7f;height:140px;}
        .client{margin-top:20px;color:#fff;}
        .client-1{height:20px;}
        .client-1 img{display: block;margin-top:10px;}
        .password-a{height:50px;}
        .pwd-box{border:none;}
        .fake-box input{background:#17b8e2;height:35px;width:35px;margin-right:10px;border:none;}
        .fake-box input:last-child{margin-right:0px;}
        .pwd-box input[type="tel"]{height:35px;}
    </style>
</head>
<!-- 背景div -->
<!--<div id="mydiv"></div>
<div id="mydivIMG">
    <img src="/img/mosha_001.png"/>
</div>-->
<section style="position:absolute;top: 0;width: 100%;">
    <div class="am-container">
        <div class="am-g">
<!--            <div class="am-u-sm-12 bgBlb header" style="background-color: #3b3b3a;">-->
<!--                <a href="javascript:history.go(-1);">-->
<!--                    <img class="goBack" src="/img/goLeft.png" style="margin: 0; width: auto;height: auto;"/>-->
<!--                </a>-->
<!--                <span style="color: #1E88E5">--><?php //echo $title; ?><!--</span>-->
<!--            </div>-->
            <div class="am-u-sm-12 bgBlb tcenter balance color-white" style="background:url(/img/baor_top.png) no-repeat top left;margin-bottom:5px; background-size:100% 100%;-moz-box-shadow: 3px 3px 4px rgba(0,0,0,.8);-webkit-box-shadow: 3px 3px 4px rgba(0,0,0,.8);box-shadow: 3px 3px 4px rgba(0,0,0,.8);">
                <div class="am-u-sm-6 border-R-1">
                    <p style="color: #fff;"><?php echo Yii::t('app', '卢宝'); ?></p>
                    <p style="color: #fff;"><?php echo $user_wallet['cash_wa']; ?></p>
                </div>
                <div class="am-u-sm-6">
                    <p style="color: #fff;"><?php echo Yii::t('app', 'LKC'); ?></p>
                    <p style="color: #fff;"><?php echo $user_wallet['care_wa']; ?></p>
                </div>
            </div>
            <div class="am-u-sm-12 orderPrice">
                <div class="am-u-sm-12 bg-white orderArticle">
                    <div class="am-u-sm-12 orderNav">
                        <div class="orderArticleName fl color-gray" style="color:#fff;border:none;">
                            <?php echo Yii::t('app', '当前价格'); ?>:
                            <span class="orderArticleValue fr" style="flex:1;width:initial;display: initial;"><input type="text" id="currentPrice" style="border-top: 0; color: #fff;background:none;text-align: right;" readonly="readonly" value="<?php echo $sysPrice ?>"/></span>
                        </div>
                        
                    </div>
                    <div class="am-u-sm-12 orderNav">
                        <div class="orderArticleName fl color-gray" style="border:none;"><?php echo Yii::t('app', '出售价格'); ?>:</div>
                        <div class="orderArticleValue fr">
                            <input type="text" class="orderArticlePrice" id="price" style="border-top: 0; color: #fff;background:none;" readonly="readonly" value="<?php echo $sysPrice ?>"/>
                            <div id="realPrice" style="color: #fff;">0.00%</div>
                            <span class="fr" id="addPrice" onclick="addPrice()">+</span>
                            <input type="range" class="fr" id="priceRange" min="-99" max="100" value="0" step="1" onchange="getValue()" style="width: 60%;"/>
                            <span class="fr" id="deletePrice" onclick="deletePrice()">-</span>

                        </div>
                    </div>
                    <div class="am-u-sm-12 orderNav">
                        <div class="orderArticleName fl color-gray" style="border-bottom: 0;"><?php echo Yii::t('app', '出售数量'); ?>:</div>
                        <div class="orderArticleValue fr">

                            <label for="num_t1" class="num_t"><?php echo $trade_num[0]['num']; ?></label>
                            <input type="radio" id="num_t1" class="ng-hide" name="num_t" value="<?php echo $trade_num[0]['num']; ?>"/>

                            <label for="num_t2" class="num_t"><?php echo $trade_num[1]['num']; ?></label>
                            <input type="radio" id="num_t2" class="ng-hide" name="num_t" value="<?php echo $trade_num[1]['num']; ?>"/>

                            <label for="num_t3" class="num_t"><?php echo $trade_num[2]['num']; ?></label>
                            <input type="radio" id="num_t3" class="ng-hide" name="num_t" value="<?php echo $trade_num[2]['num']; ?>"/>
                            <br />
                            <label for="num_t4" class="num_t"><?php echo $trade_num[3]['num']; ?></label>
                            <input type="radio" id="num_t4" class="ng-hide" name="num_t" value="<?php echo $trade_num[3]['num']; ?>"/>

                            <label for="num_t5" class="num_t"><?php echo $trade_num[4]['num']; ?></label>
                            <input type="radio" id="num_t5" class="ng-hide" name="num_t" value="<?php echo $trade_num[4]['num']; ?>"/>

                            <label for="num_t6" class="num_t"><?php echo $trade_num[5]['num']; ?></label>
                            <input type="radio" id="num_t6" class="ng-hide" name="num_t" value="<?php echo $trade_num[5]['num']; ?>"/>

                        </div>
                    </div>
                    <div class="am-u-sm-12 orderNav" style="padding:0px;background:none;">
                        <?php if($chooseBank['bank'] != '') { ?>
                            <a href="/trade/choosebank.html?order_type=2">
                                <div class="approve" style="margin-top:0;border:none;">
                                    <div class="approve1" style="overflow:hidden;">
                                        <p id="bank" style="float:left;margin-bottom:0px;"><?php echo Yii::t('app', $chooseBank['bank']); ?></p>
                                        <div class="ren" style="margin-top:10px;"><?php echo Yii::t('app', '默认'); ?></div>
                                        <div class="ren" hidden="hidden"><?php echo Yii::t('app', '默认'); ?></div>
                                    </div>
                                    <div class="approve2">
                                        <p id="bank_num" style="color: #fff;"><?php echo $chooseBank['bank_number'];?></p>
                                    </div>
                                </div>
                            </a>
                        <?php } else { ?>
                        <a href="javascript:shareClick();" style="margin:0 13px;">
                                <div class="addcard">
                                    <span>+<?php echo Yii::t('app', '请添加银行卡'); ?>!</span>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                    <div class="am-u-sm-12 orderNav">
                        <div class="orderArticleName fl color-gray" style="border:none;"><?php echo Yii::t('app', '出售总额'); ?>:</div>
                        <div class="orderArticleValue fr"><input type="text" id="amount" style="border-top: 0; color: #fff;background:none;" readonly="readonly"/></div>
                    </div>
                </div>
<!--                <div class="width100 tcenter mt50">-->
                <div class="width100 tcenter">
                    <button type="button" class="bgBlb color-white width100 border0 pad5 am-btn" id="fbBtn" style="margin-top: 20px;background:url(/img/baor_top.png) no-repeat top left;background-size:100% 100%;border-radius: 6px;" disabled> <?php echo Yii::t('app', '发布'); ?></button>
                </div>
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
    <script src="/js/3.2.1.js"></script>
<!--    <script type="text/javascript" src="/js/canvas-particle.js"></script>-->
    <script>
        // 跳转到原生投诉建议页面
        function shareClick() {
            var u = navigator.userAgent;
            var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
            var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
            if(isiOS) {
                try {
                    window.webkit.messageHandlers.openAddBankPage.postMessage(null);
                }
                catch(err) {
                    // //err.message;
                }
            } else {
                try {
                    android.openAddBankCard();
                }
                catch(err) {
                    // //err.message;
                }
            }
            // try {
            //     window.webkit.messageHandlers.openAddBankPage.postMessage(null);
            // }
            // catch(err) {
            //     // //err.message;
            // }
        }

        function getValue(){
            var x = $("#priceRange").val();
            var y = $("#currentPrice").val();
            x = Number(x);
            y = Number(y);
            y = y*(x/100 + 1);
            x = x + ".00%";
            $("#realPrice").html(x);
            $(".orderArticlePrice").val(y.toFixed(4));

            var number = $("input[name='num_t']:checked").val();
            if(typeof (number) != 'undefined' && number > 0){
                var amount = number * y;
                $("#amount").val(amount.toFixed(4));
            }
        }
        function addPrice(){
            var priceRange = Number($("#priceRange").val());
            if(priceRange < 101){
                priceRange += 1;
                $("#priceRange").val(priceRange);
                getValue();
            }
        }
        function deletePrice(){
            var priceRange = Number($("#priceRange").val());
            if(priceRange > -101){
                priceRange -= 1;
                $("#priceRange").val(priceRange);
                getValue();
            }
        }

        $(".num_t").on("click",function(){
            $(this).siblings(".num_t").removeClass("on");
            $(this).addClass("on");
            var number = $(this).next().val();
            var price = $('#price').val();
            var amount = number * price;
            $("#amount").val(amount.toFixed(4));
            $("#fbBtn").removeAttr('disabled');
        });

        $("#fbBtn").click(function(){
            var unbind = <?php echo $unbind; ?>;
            if (unbind == 1) {
                alert("<?php echo Yii::t('app', '请先绑定银行卡!');?>");
                shareClick();
            } else {
//            if(!confirm("提示！挂单出售，扣除10%平台手续费用，10%返还报单余额")) return;
                $(".shade").fadeIn();
                $(".ballBox").fadeIn();
                $("#pwd-input").focus();
            }
        });

        $(".client-1").click(function(){
            $(".shade").hide();
            $(".ballBox").hide();
            $("#pwd-input").val('');
        });
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
                var sys_price = $('#currentPrice').val();
                var number = $("input[name='num_t']:checked").val();
                var price = $("#price").val();
                var bank = $("#bank").text();
                var bank_num = $("#bank_num").text();
                var method = <?php echo $method; ?>;
                // var token = $("#token").val();
//                var bank_id = $('#bank_id').val();
//                var note = $('#note').val();
                var jymm = $('#jymm').val();
                $.ajax({
                    type: "post",
                    data: {number: number,sys_price: sys_price, price: price, bank: bank, bank_num: bank_num, jymm: pwd, method: method, order_type: 2},
                    dataType: "json",
                    url: "/trade/tbtradesell.html",
                    success: function (data) {
                        if (data.status == '0001') {
                            alert(data.message);
                            window.location.href = '/trade/tradeorderlist.html?status=wwc&order_type=2';
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
</section>