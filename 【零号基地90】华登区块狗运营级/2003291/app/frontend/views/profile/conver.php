<?php

use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php echo Yii::t('app', '兑换卢呗'); ?></title>
        <link rel="stylesheet" href="/css/common.css" />
        <style>
            .accordionName{
                margin-left: 15px;
            }
            .accordionInput { 
                width: calc(100% - 130px);
            }
        </style>
    </head>

    <body>
        <div class="am-container">
            <div class="am-g">
                <!--主背景块-->
                <div class="am-u-sm-12 userGo">
                    <div class="accordion">
                        <div class="accordionImg accImg1"></div>
                        <div class="accordionName"><?php echo Yii::t('app', '卢呗'); ?>:</div>
                        <div class="accordionInput"><?php echo $user_wallet->hcg_wa; ?></div>
                    </div>
                    <div class="accordion">
                        <div class="accordionImg accImg1"></div>
                        <div class="accordionName"><?php echo Yii::t('app', '卢宝'); ?>:</div>
                        <div class="accordionInput"><?php echo $user_wallet->cash_wa; ?></div>
                    </div>
                    <div class="accordion">
                        <div class="accordionImg accImg6"></div>
                        <div class="accordionName" style="width:100px;"><?php echo Yii::t('app', '兑换卢宝'); ?>:</div>
                        <div class="accordionInput">
                            <input type="text" id="del_cash" placeholder="<?php echo Yii::t('app', '请输入兑换卢宝数量'); ?>"/>
                        </div>
                    </div>
                    <div class="accordion">
                        <div class="accordionImg accImg6"></div>
                        <div class="accordionName" style="width:100px;"><?php echo Yii::t('app', '交易密码'); ?>:</div>
                        <div class="accordionInput">
                            <input type="password" id="pay_pwd" placeholder="<?php echo Yii::t('app', '请输入交易密码');?>" />
                        </div>
                    </div>
                    <p class="huan pl15" style="color:#333;"><?php echo Yii::t('app', '提示'); ?>：<?php echo Yii::t('app', '卢宝与卢呗比例为'); ?>：1：<?php echo $cash_hcg; ?>
                        <a href="/profile/converrecord.html">
                            <span class="headerName fr pr10" style="vertical-align: middle;height: 24px;color:#1e88e5;line-height: 24px;display: inline-block;margin-left: 5px;background: -webkit-gradient(linear, left center, right center, from(rgba(253, 241, 208, 1)), to(rgba(226, 204, 111, 1)));-webkit-background-clip: text;"><?php echo Yii::t('app', '记录'); ?></span>
                        </a>
                    </p>
                    <input type="hidden" id="my_cash" value="<?php echo $user_wallet->cash_wa; ?>"/>
                </div>
                <div id="tradePwd">
                    <div class="am-u-sm-12 goNext">
                        <button id="del-cash-btn" type="button"><?php echo Yii::t('app', '确认');?></button>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="/js/jquery.min.js"></script>
        <script>
            $("#showTradePwd").on("click",function(){
                    $(this).addClass("disa").attr("disabled","disabled");
                    $("#tradePwd").removeClass("ng-hide");
            });
            $(".cancle").on("click",function(){
                    $(this).parent().parent().addClass("ng-hide");
                    $("#showTradePwd").removeClass("disa").attr("disabled",false);
            });
            
            $("#del-cash-btn").on("click",function(){
                var del_cash1 = $("#del_cash").val();
                var del_cash = parseFloat(del_cash1);
                var my_cash1 = $("#my_cash").val();
                var my_cash = parseFloat(my_cash1);
                var pay_pwd = $("#pay_pwd").val();

                if(isNaN(del_cash)){
                    alert("<?php echo Yii::t('app', '请输入转换数量'); ?>");

                    return false;
                }
                if(del_cash < 100){
                    alert("<?php echo Yii::t('app', '提交金额不能低于100！'); ?>");
                    return false;
                }
                if(my_cash < del_cash){
                    alert("<?php echo Yii::t('app', '卢宝不足！'); ?>");
                    return false;
                }
                if(pay_pwd == ''){
                   alert('<?php echo Yii::t('app', '请输入交易密码'); ?>');
                    return false;
                }

                $("#del-cash-btn").prop("disabled",true);
                $.ajax({
                    type: 'post',
                    url: "/profile/doconver.html",           
                    data: {del_cash:del_cash,pay_pwd:pay_pwd},
                    dataType: "json",
                    success: function(result) {
                        if(result.status == true){
                            alert(result.message);
                            window.location.href = "/profile/converrecord.html";
                        }else{
                            alert(result.message);
                        }
                        $("#del-cash-btn").prop("disabled",false);
                    }
                });
            });
        </script>
    </body>

</html>