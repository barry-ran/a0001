<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php echo Yii::t('app', '请核对转账信息');?></title>
        <link rel="stylesheet" href="/css/common.css" />
        <style>
            .accordionName{width: 50%}
            .accordionInput{width: 100px; float: right;}
        </style>
    </head>

    <body>
        <div class="am-container">
            <div class="am-g">
                <div class="am-u-sm-12 userGo">
                    <div class="accordion">
                        <div class="accordionImg accImg1">
                            <img src="/img/head.png" />
                        </div>
                        <div class="accordionName"><?php echo Yii::t('app', '接收者账号');?>:</div>
                        <div class="accordionInput"><?php echo $in_user_data['username']; ?></div>
                        <input type="hidden" id="in_userid" value="<?php echo $in_user_data['userid'];?>"/>
                        <input type="hidden" id="in_username" value="<?php echo $in_user_data['username'];?>"/>
                    </div>
                    <div class="accordion">
                        <div class="accordionImg accImg6">
                            <img src="/img/balance.png" />
                        </div>
                        <div class="accordionName"><?php echo Yii::t('app', '转出卢宝数量');?>:</div>
                        <div class="accordionInput"><?php echo $out_num; ?></div>
                        <input type="hidden" id="out_num" value="<?php echo $out_num; ?>"/>
                    </div>

                    <div class="accordion">
                        <div class="accordionImg accImg6">
                            <img src="/img/password2.png" />
                        </div>
                        <div class="accordionName"><?php echo Yii::t('app', '交易密码');?>:</div>
                        <div class="accordionInput">
                            <input type="password" id="pay_pwd" placeholder="<?php echo Yii::t('app', '请输入交易密码');?>" />
                        </div>
                    </div>
                    <div class="tradeTip">
                        <?php echo Yii::t('app', '请确认收款人信息，交易成功后将不能作废和退还。谨慎操作，避免损失。');?>
                    </div>
                    <div class="am-u-sm-12 goNext">
                        <button id="sendOutBtn" type="button"><?php echo Yii::t('app', '确认');?></button>
                    </div>
                </div>

            </div>
        </div>
        <!--<script charset="utf-8" src="/js/3.2.1.js"></script>-->
        <script src="/js/jquery.min.js"></script>
        <script>
            $("#showTradePwd").on("click", function () {
                $(this).addClass("disa").attr("disabled", "disabled");
                $("#tradePwd").removeClass("ng-hide");
            });
            $(".cancle").on("click", function () {
                $(this).parent().parent().addClass("ng-hide");
                $("#showTradePwd").removeClass("disa").attr("disabled", false);
            });

            $('#sendOutBtn').click(function(){
                //  校验报单卢宝
                var out_num = parseFloat($("#out_num").val());

                if(isNaN(out_num)){
                    alert('<?php echo Yii::t('app', '转出卢宝格式不正确'); ?>！');
                    return false;
                }else{
                    if(out_num < 1){
                        alert('<?php echo Yii::t('app', '转出卢宝不能小于1'); ?>！');
                        return false;
                    }
                }
                //支付密码
                var pay_pwd = $("#pay_pwd").val();
                if(pay_pwd == ""){
                    alert('<?php echo Yii::t('app', '请输入支付密码'); ?>！');
                    return false;
                }
                
                var in_userid = $("#in_userid").val();
                var in_username = $("#in_username").val();

                $('#sendOutBtn').prop("disabled", true);
                $.ajax({
                    type: "post",
                    data: {in_userid:in_userid,in_username:in_username,out_num:out_num,pay_pwd:pay_pwd},
                    dataType: "json",
                    url: "/register/sending.html",
                    success: function (data) {
                        if (data.status == '0001') {
                            alert(data.msg);
                            window.location.href = '/register/sendoutrecord.html?pay_type=2';//  刷新当前页面
                        } else {
                            alert(data.msg);
                        }
                        $('#sendOutBtn').prop("disabled", false);
                    }
                });
            });
        </script>
    </body>

</html>