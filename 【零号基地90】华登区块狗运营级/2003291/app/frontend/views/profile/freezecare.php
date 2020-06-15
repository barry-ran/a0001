<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php echo Yii::t('app', '定存通链'); ?></title>
        <link rel="stylesheet" href="/css/common.css" />
    </head>
    <style>
        .accordion {
            background: white;
        }
        #buycareBtn{
            background-color: #1e88e5;
        }
    </style>
    <body>
        <div class="am-container">
            <div class="am-g">
                <!--主背景块-->

                <div class="am-u-sm-12 userGo">
                    <div class="accordion">
                        <div class="accordionImg accImg1">
                            <img src="/img/yu__e.png" />
                        </div>
                        <div class="accordionName"><?php echo Yii::t('app', '可用通链'); ?>:</div>
                        <div class="accordionInput"><?php echo $user->wallet->care_wa; ?></div>
                    </div>
                    <div class="accordion">
                        <div class="accordionImg accImg1">
                            <img src="/img/huan_yue.png" />
                        </div>
                        <div class="accordionName" style="width:88px;"><?php echo Yii::t('app', '已定存通链'); ?>:</div>
                        <div class="accordionInput"><?php echo $user->wallet->get_release; ?></div>
                    </div>
                    <div class="accordion">
                        <div class="accordionImg accImg6">
                            <img src="/img/ding-shu.png" />
                        </div>
                        <div class="accordionName"><?php echo Yii::t('app', '定存数量'); ?>：</div>
                        <div class="accordionInput">
                            <input type="text" name="out_num"  id="out_num" value="1" placeholder="<?php echo Yii::t('app', '请输入定存数量'); ?>" style="text-align: right;"/>
                        </div>
                    </div>
                    <p class="huan pl15" style="color:#333;"><?php echo Yii::t('app', '通链等级'); ?>：<?php echo $level; ?></p>
                </div>
                <div id="tradePwd">
                    <div class="accordion">
                        <div class="accordionImg accImg1">
                            <img src="/img/password2.png" />
                        </div>
                        <div class="accordionName"><?php echo Yii::t('app', '交易密码'); ?>:</div>
                        <div class="accordionInput">
                            <input type="password" id="pay_pwd" placeholder="<?php echo Yii::t('app', '请输入交易密码'); ?>" />
                        </div>
                    </div>
                    <div class="am-u-sm-12 goNext">
                        <button id="buycareBtn" type="button"><?php echo Yii::t('app', '确认'); ?></button>
<!--                        <button type="button" class="cancle">--><?php //echo Yii::t('app', '取消'); ?><!--</button>-->
                    </div>
                </div>
            </div>
        </div>
        <script src="/js/jquery.min.js"></script>
<!--        <script type="text/javascript" src="/js/canvas-particle.js"></script>-->
        <script charset="utf-8" src="/js/3.2.1.js"></script>
        <script src="/js/interactive.js"></script>
        <script>
            $("#showTradePwd").on("click", function () {
                $(this).addClass("disa").attr("disabled", "disabled");
                $("#tradePwd").removeClass("ng-hide");
            });
            $(".cancle").on("click", function () {
                $(this).parent().parent().addClass("ng-hide");
                $("#showTradePwd").removeClass("disa").attr("disabled", false);
            });

            $("#out_num").on("blur", function () {
                var price = $("#price").val();
                var out_num = parseFloat($("#out_num").val());
                var total = price * out_num;
                var total_num = parseFloat($("#total_num").val());

                if (total_num < out_num) {
                    alert('<?php echo Yii::t('app', 'LKC数量不足！'); ?>');
                    $("#total_price").html(price);
                    $("#out_num").val(1);
                } else {
                    $("#total_price").html(total);
                }
            });

            $('#buycareBtn').click(function () {
                //  校验报单卢宝
                var out_num = parseFloat($("#out_num").val());

                if (isNaN(out_num)) {
                    alert('<?php echo Yii::t('app', '定存数量格式不正确！'); ?>');
                    return false;
                } else {
                    if (out_num < 1) {
                        alert('<?php echo Yii::t('app', '定存数量不能低于1！'); ?>');
                        return false;
                    }
                }
                
                if (out_num % 100 != 0) {
                    alert('<?php echo Yii::t('app', '定存数量必须整百！'); ?>');
                    return false;
                } 

                //支付密码
                var pay_pwd = $("#pay_pwd").val();
                if (pay_pwd == "") {
                    alert('<?php echo Yii::t('app', '请输入支付密码'); ?>');
                    return false;
                }
                $('#buycareBtn').prop("disabled", true);
                $.ajax({
                    type: "post",
                    data: {out_num: out_num, pay_pwd: pay_pwd},
                    dataType: "json",
                    url: "/profile/dofreezecare.html",
                    success: function (data) {
                        if (data.status == '0001') {
                            alert(data.message);
                            window.location.href = '/profile/walletrecord.html';//freezerecord
                        } else {
                            alert(data.message);
                        }
                        $('#buycareBtn').prop("disabled",false);
                    }
                });
            });
        </script>
    </body>

</html>