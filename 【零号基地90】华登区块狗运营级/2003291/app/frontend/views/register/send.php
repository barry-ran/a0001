<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php echo Yii::t('app', '转出');?></title>
        <link rel="stylesheet" href="/css/common.css" />
    </head>

    <body>
        <div class="am-container">
            <div class="am-g">
                <div class="am-u-sm-12 userGo">
                    <div class="accordion">
                        <div class="accordionImg accImg1">
                            <img src="/img/wallet_1.png" />
                        </div>
                        <div class="accordionName"><?php echo Yii::t('app', '卢宝');?>:</div>
                        <div class="accordionInput"><?php echo $user->wallet->cash_wa; ?></div>
                    </div>
                    <div class="accordion">
                        <div class="accordionImg accImg1">
                            <img src="/img/head.png" />
                        </div>
                        <div class="accordionName"><?php echo Yii::t('app', '对方账号');?>:</div>
                        <div class="accordionInput">
                            <input id="inAccount" class="placeholder_ys" style="color:black;" type="text" value="<?php echo $in_username; ?>" placeholder="<?php echo Yii::t('app', '请输入用户名');?>/UID/<?php echo Yii::t('app', '钱包地址');?>"/>
                        </div>
                    </div>
                    <div class="accordion">
                        <div class="accordionImg accImg1">
                            <img src="/img/head.png" />
                        </div>
                        <div class="accordionName"><?php echo Yii::t('app', '手机末4位');?>:</div>
                        <div class="accordionInput">
                            <input id="last_phone" class="placeholder_ys" style="color:black;" type="text" value="<?php echo $last_phone; ?>" placeholder="<?php echo Yii::t('app', '请输入对方手机号后四位');?>"/>
                        </div>
                    </div>
                    <div class="accordion">
                        <div class="accordionImg accImg6">
                            <img src="/img/coins_1.png" />
                        </div>
                        <div class="accordionName"><?php echo Yii::t('app', '卢宝个数');?>:</div>
                        <div class="accordionInput">
                            <input type="text" id="out_num" class="placeholder_ys" placeholder="<?php echo Yii::t('app', '要转出的卢宝个数');?>"/>
                        </div>
                    </div>
                    <div class="accordion" style="background: none">
                          <a href="/register/sendoutrecord.html?pay_type=2">
                                <div class="headerUser">
                                    <span class="headerName fr" style="vertical-align: middle;height: 24px;line-height: 24px;display: inline-block;margin-left: 5px;background: -webkit-gradient(linear, left center, right center, from(rgb(139, 163, 237)), to(rgb(37, 77, 203)));-webkit-background-clip: text;-webkit-text-fill-color: transparent;"><?php echo Yii::t('app', '转出记录'); ?></span>
                                </div>
                            </a>
                    </div>

                </div>
                <div class="am-u-sm-12 safeLogout">
                    <button id="send-btn" type="button" onclick="checkAccount()"><?php echo Yii::t('app', '下一步');?></button>
                </div>
            </div>
        </div>
        <script src="/js/jquery.min.js"></script>
        <script>
            //  校验账户内容
            function checkAccount(){
                var my_cash = $('.accordionInput').text();
                var inAccount = $('#inAccount').val();
                var myUsername = '<?php echo $user->username; ?>';
                var myId = '<?php echo $user->id; ?>';
                var myWallettoken = '<?php echo $user->userprofile->wallet_token; ?>';
                var out_num = $("#out_num").val();
                var last_phone = $("#last_phone").val();
                if(inAccount != ''){
                    if(inAccount == myUsername || inAccount == myId || inAccount == myWallettoken){
                        alert('<?php echo Yii::t('app', '收款人不能是自己'); ?>！');
                        return;
                    }
                    if(last_phone == ''){
                        alert('<?php echo Yii::t('app', '请输入对方手机号后四位'); ?>！');
                        return;
                    }
                    if(isNaN(out_num)){
                        alert('<?php echo Yii::t('app', '转出卢宝格式不正确'); ?>！');
                        return false;
                    }else{
                        if(out_num <= 0){
                            alert('<?php echo Yii::t('app', '转出卢宝必须高于0'); ?>');
                            return false;
                        }
                    }
                    if(my_cash < out_num){
                        alert('<?php echo Yii::t('app', '卢宝不足！'); ?>');
                        return false;
                    }
                    $("#send-btn").prop("disabled", true);
                    $.ajax({
                        type: "post",
                        data: {inAccount: inAccount,last_phone:last_phone},
                        dataType: "json",
                        url: "/register/checkaccount.html",
                        success: function (data) {
                            if (data.status == '0001') {
                                location.href = "/register/sendout.html?inAccount=" + inAccount+"&& last_phone="+last_phone+"&& out_num="+out_num;
                            } else {
                                alert(data.msg);
                            }
                            $("#send-btn").prop("disabled",false);
                        }
                    });
                }else{
                    alert('<?php echo Yii::t('app', '账户不能为空'); ?>！');
                    $("#send-btn").attr("disabled",false);
                }
            }
        </script>
    </body>

</html>