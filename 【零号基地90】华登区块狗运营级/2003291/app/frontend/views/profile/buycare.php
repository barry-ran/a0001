<?php

use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php echo Yii::t('app', '购买通链'); ?></title>
        <link rel="stylesheet" href="/css/common.css" />
    </head>
    <style>
        .accordion{
            background: white;
        }
    </style>
    <body>
        <div class="am-container">
            <div class="am-g">
                <!--主背景块-->

                <div class="am-u-sm-12 userGo">
                    <div class="accordion">
                        <div class="accordionImg accImg1">
                            <img src="/img/currency.png" />
                        </div>
                        <div class="accordionName"><?php echo Yii::t('app', '通链'); ?>:</div>
                        <div class="accordionInput"><?php echo $user_wallet->care_wa; ?></div>
                    </div>
                    <div class="accordion">
                        <div class="accordionImg accImg1">
                            <img src="/img/balance_1.png" />
                        </div>
                        <div class="accordionName"><?php echo Yii::t('app', '卢宝'); ?>:</div>
                        <div class="accordionInput"><?php echo $user_wallet->cash_wa; ?></div>
                    </div>
                    <div class="accordion">
                        <div class="accordionImg accImg1">
                            <img src="/img/price.png" />
                        </div>
                        <div class="accordionName"><?php echo Yii::t('app', '价格'); ?>:</div>
                        <div class="accordionInput"><?php echo $price; ?></div>
                    </div>
                    <div class="accordion">
                        <div class="accordionImg accImg6">
                            <img src="/img/buy_num.png" />
                        </div>
                        <div class="accordionName"><?php echo Yii::t('app', '购买数量'); ?>:</div>
                        <div class="accordionInput">
                            <input type="number" name="out_num" class="tright"  id="out_num" value="1" placeholder="<?php echo Yii::t('app', '请输入购买数量'); ?>"/>
                        </div>
                    </div>
                    <div class="accordion">
                        <div class="accordionImg accImg1">
                            <img src="/img/total_price.png" />
                        </div>
                        <div class="accordionName"><?php echo Yii::t('app', '总价格'); ?>:</div>
                        <div class="accordionInput" id="total_price"><?php echo $price; ?></div>
                    </div>
                    <p class="huan pl15" style="color: #333;"><?php echo Yii::t('app', '提示'); ?>：<?php echo Yii::t('app', '剩余数量'); ?>：<?php echo $sell_care->remain_num; ?>
                        <a href="<?php echo Url::toRoute(["profile/mycareorder"]); ?>">
                            <span class="headerName fr pr10" style="vertical-align: middle;height: 24px;line-height: 24px;display: inline-block;margin-left: 5px;background:#1AB1FF;-webkit-background-clip: text;-webkit-text-fill-color: transparent;"><?php echo Yii::t('app', '记录'); ?></span>
                        </a>
                    </p>
                    
                    <input type="hidden" name="price" id="price" value="<?php echo $price; ?>">
                    <input type="hidden" name="total_num" id="total_num" value="<?php echo $sell_care->remain_num; ?>">
                    <input type="hidden" name="my_cash" id="my_cash" value="<?php echo $user_wallet->cash_wa; ?>">
                    <input type="hidden" name="sell_id" id="sell_id" value="<?php echo $sell_care->id; ?>">
                    <input type="hidden" name="allow_num" id="allow_num" value="<?php echo $allow_num; ?>"/>
                </div>
                
                <div id="tradePwd">
                        <div class="accordion">
                                <div class="accordionImg accImg1">
                                        <img src="/img/password2.png" />
                                </div>
                                <div class="accordionName"><?php echo Yii::t('app', '交易密码'); ?>:</div>
                                <div class="accordionInput">
                                    <input name="pay_pwd" id="pay_pwd" type="password" placeholder="<?php echo Yii::t('app', '请输入交易密码'); ?>" />
                                </div>
                        </div>
                        <div class="am-u-sm-12 goNext">
                                <button id="buycareBtn" type="button"><?php echo Yii::t('app', '确认'); ?></button>
                        </div>
                </div>
            </div>
        </div>
        <script src="/js/jquery.min.js"></script>
        <script src="/js/interactive.js"></script>
        <script>
            $("#showTradePwd").on("click",function(){
                    $(this).addClass("disa").attr("disabled","disabled");
                    $("#tradePwd").removeClass("ng-hide");
            });
            $(".cancle").on("click",function(){
                    $(this).parent().parent().addClass("ng-hide");
                    $("#showTradePwd").removeClass("disa").attr("disabled",false);
            });
            
            $("#out_num").on("blur",function(){
                var price = $("#price").val();
                var out_num = parseFloat($("#out_num").val());
                var total = price * out_num;
                var total_num = parseFloat($("#total_num").val());

                if(total_num < out_num){
                    alert('<?php echo Yii::t('app', 'LKC数量不足！'); ?>');
                    $("#total_price").html(price);
                    $("#out_num").val(1);
                }else{
                    $("#total_price").html(total);
                }
            });

            $('#buycareBtn').click(function(){
                $('#buycareBtn').attr("disabled",true);
                //  校验报单卢宝
                var out_num = parseFloat($("#out_num").val());

                if(isNaN(out_num)){
                    alert('<?php echo Yii::t('app', '购买数量格式不正确！'); ?>');
                    $('#buycareBtn').attr("disabled",false);
                    return false;
                }else{
                    if(out_num < 1){
                        alert('<?php echo Yii::t('app', '购买数量不能小于1！'); ?>');
                        $('#buycareBtn').attr("disabled",false);
                        return false;
                    }

                    if(out_num % 100 != 0){
                        alert('<?php echo Yii::t('app', '购买数量必须整百！'); ?>');
                        $('#buycareBtn').attr("disabled",false);
                        return false;
                    }
                }

                var my_cash = $("#my_cash").val();
                var price = $("#price").val();
                var total_price = out_num * price;
                if(my_cash < total_price){
                    alert('<?php echo Yii::t('app', '卢宝不足！'); ?>');
                    $('#buycareBtn').attr("disabled",false);
                    return false;
                }
                //支付密码
                var pay_pwd = $("#pay_pwd").val();
                if(pay_pwd == ""){
                    alert('<?php echo Yii::t('app', '请输入支付密码'); ?>');
                    $('#buycareBtn').attr("disabled",false);
                    return false;
                }
                var allow_num = $("#allow_num").val();
                if(allow_num < out_num){
                    alert('<?php echo Yii::t('app', '总购买数量不能超过限购数量！'); ?>');
                    $('#buycareBtn').attr("disabled",false);
                    return false;
                }
                var sell_id = $("#sell_id").val();

                $.ajax({
                    type: "post",
                    data: {out_num:out_num,sell_id:sell_id,pay_pwd:pay_pwd},
                    dataType: "json",
                    url: "/profile/dobuycare.html",
                    success: function (data) {
                        if (data.status == '0001') {
                            alert(data.message);
                            window.location.href = '/profile/mycareorder.html';
                        } else {
                            alert(data.message);
                        }
                        $('#buycareBtn').attr("disabled",false);
                    }
                });
            });
        </script>
    </body>

</html>