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
    <link href="/css/amazeui.min.css" rel="stylesheet">
    <link href="/css/myassets.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/common2.css" />
    <style>
        html,body{
            min-height: 0 !important;
        }
        .num_t {
            height:30px;
            color: #1e88e5;
            border: 1px solid #1e88e5;
            border-radius: 5px;
            text-align: center;
            width: 31%;
            line-height: 30px;
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

        .orderNav {
            border-bottom: 0;
        }
        .orderArticleName {
            color: #4E4E4E;
        }
        .orderArticleValue .on{
            background: #1e88e5;
            color: #FFF;
        }
        .balance{ border-right: 0;}
        .approve {
            width: 100%;
            height: 80px;
            border-radius: 10px 10px 0 0;
            border: 1px solid #1e88e5;
        }
        .approve1 {
            width: 100%;
            height: 40px;
            border-radius: 10px 10px 0 0;
            background-color: #1e88e5;
        }
        .balance{ border-right: 0;}
        body{
            overflow: visible;
            overflow-x: visible;
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
    </style>
</head>
<section style="position:absolute;top: 0;width: 100%;">

    <div class="am-container">
        <div class="am-g">

            <div class="am-u-sm-12 bgBlb tcenter balance color-white" style="background-color: #fff;height:50px;">
                <div class="am-u-sm-6" style="width:100%;">
                    <p style="color: #4E4E4E;"><?php echo Yii::t('app', '卢宝'); ?></p>
                    <p style="color: #1e88e5;"><?php echo $user_wallet['cash_wa']; ?></p>
                </div>
            </div>
            <div class="am-u-sm-12 orderPrice">
                <div class="am-u-sm-12 bg-white orderArticle">
                    <div class="am-u-sm-12 orderNav">
                        <div class="orderArticleName fl color-gray" style="border-bottom: 0;"><?php echo Yii::t('app', ''); ?><?php echo Yii::t('app', '请输入买入数额'); ?>:</div>
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
                    <div class="am-u-sm-12 orderNav">
                        <?php if($chooseBank['bank'] != '') { ?>
                            <a href="/trade/choosebank.html?order_type=1">
                                <div class="approve" style="margin-top:0;">
                                    <div class="approve1">
                                        <p id="bank"><?php echo Yii::t('app', $chooseBank['bank']); ?></p>
                                        <div class="ren"><?php echo Yii::t('app', '默认'); ?></div>
                                        <div class="ren" hidden="hidden"><?php echo Yii::t('app', '默认'); ?></div>
                                    </div>
                                    <div class="approve2">
                                        <p id="bank_num" style="color: #1e88e5;"><?php echo $chooseBank['bank_number'];?></p>
                                    </div>
                                </div>
                            </a>
                        <?php } else { ?>
                            <a href="/user/addcard.html">
                                <div class="addcard" style="text-align: center;">
                                    <span>+<?php echo Yii::t('app', '请添加银行卡'); ?>!</span>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                    <div class="am-u-sm-12 orderNav">
                        <div class="orderArticleName fl color-gray" style="border:0;margin-bottom: 0;width:30%;"><?php echo Yii::t('app', '购买总额'); ?>:</div>
                        <div class="orderArticleValue fr" style="width:69%;"><input type="text" id="amount" style="border-top: 0; color: #1e88e5; background: transparent;padding-left: 0;margin-top: -5px;" readonly="readonly"/></div>
<!--                        <input type="hidden" id="token" name="token" value="--><?php //echo $_GET['token']?$_GET['token']:''; ?><!--">-->
                    </div>
                </div>
                
                <div class="width100 tcenter">
                    <button type="button" class="bgBlb color-white width100 border0 pad5 am-btn" id="fbBtn" style="margin-top: 20px;background-color: #1e88e5; border-radius: 6px;" disabled> <?php echo Yii::t('app', '创建订单'); ?></button>
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
    <script>
        function getValue(){
            // var x = $("#priceRange").val();
            // var y = $("#currentPrice").val();
            var x = 1;
            var y = 1;
            x = Number(x);
            y = Number(y);
            y = y*(x/100 + 1);
            x = x + ".00%";
            $("#realPrice").html(x);
            $(".orderArticlePrice").val(y.toFixed(4));

            var number = $("input[name='num_t']:checked").val();
            if(typeof (number) != 'undefined' && number > 0){
                //var amount = number * y * <?php //echo $discount_ratio; ?>//;
                var amount = number * y;
                $("#amount").val(amount.toFixed(4));
            }
        }
        $(".num_t").on("click",function(){
            $(this).siblings(".num_t").removeClass("on");
            $(this).addClass("on");
            var number = $(this).next().val();
            // var price = $('#price').val();
            var price = 1;
            //var amount = number * price * <?php //echo $discount_ratio; ?>//;
            var amount = number * price;
            $("#amount").val(amount.toFixed(4));
            $("#fbBtn").removeAttr('disabled');
        });
        $("#fbBtn").click(function(){
            var unbind = <?php echo $unbind; ?>;
            if (unbind == 1) {
                alert('请先绑定银行卡!');
                window.location.href = '../user/addcard.html';
            } else {
//            if(!confirm("提示！挂单出售，扣除10%平台手续费用，10%返还报单卢宝")) return;
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
        var a = false;//开关
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
                var number = $("input[name='num_t']:checked").val();
                // var price = $("#price").val();
                var price = 1;
//                var bank_id = $('#bank_id').val();
//                var note = $('#note').val();
                var jymm = $('#jymm').val();
                // var token = $("#token").val();
                $.ajax({
                    type: "post",
                    data: {number: number, price: price, bank_id: 1, jymm: pwd},
                    dataType: "json",
                    url: "/trade/tradebuy.html",
                    success: function (data) {
                        if (data.status == '0001') {
                            alert(data.msg);
                            window.location.href = '/trade/tradeorderlist.html?status=wwc&order_type=1';
                            // window.location.reload();//  刷新当前页面
                        } else {
                            if(data.status == '0010'){
                                alert(data.msg);
                                $(".shade").hide();
                                $(".ballBox").hide();
                                a = false;
                                //  清除输入框密码
                                $('#pwd-input').val("");
                                for (var z = 0; z < $input.length; z++) {
                                    $input.eq(z).val('');
                                }
//                                window.location.href = '/trade/buying.html';
                            } else {
                                alert(data.msg);
                                a = false;
                                //  清除输入框密码
                                $('#pwd-input').val("");
                                for (var z = 0; z < $input.length; z++) {
                                    $input.eq(z).val('');
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
</section>