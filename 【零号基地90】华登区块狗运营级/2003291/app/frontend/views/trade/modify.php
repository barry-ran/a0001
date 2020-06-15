<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="../css/amazeui.min.css" />
<!--    <link rel="stylesheet" href="../css/base.css" />-->
    <link rel="stylesheet" href="../css/login.css" />
<!--    <link rel="stylesheet" href="../css/myassets.css" />-->
    <style>
        body {background:url(/img/bg2.png);}
        .login1 {
            border-bottom: none;
            width: 100%;
            margin-left: 0;
            background: url(/img/baor_top.png) no-repeat top left;
            background-size: 100% 100%;
            padding: 5px 10px;
            margin-bottom: 5px;
            -moz-box-shadow: 3px 3px 4px rgba(0,0,0,.8);
            -webkit-box-shadow: 3px 3px 4px rgba(0,0,0,.8);
            box-shadow: 3px 3px 4px rgba(0,0,0,.8);
        }
        .nub-2 {color: #fff; width:40%;}
        .login1 input {width: calc(80% - 140px);}
    </style>
</head>

<body>
<div class="am-g" style="background:url(/img/bg2.png);">
    <input id="bankid" value="<?php echo $res["id"]; ?>" type="hidden">
    <div class="am-u-sm-12">
        <div class="login1">
            <label style="color: red;width: 3px;">*</label><label class="nub-2"><?php echo Yii::t('app', '持卡人姓名'); ?></label>
            <input type="text" id="username" value="<?php echo $res["username"]; ?>" placeholder="<?php echo Yii::t('app', '请输入持卡人姓名'); ?>" readonly style="color:#fff;">
        </div>
    </div>

    <div class="am-u-sm-12">
        <div class="login1">
            <label style="color: red;width: 3px;">*</label><label class="nub-2"><?php echo Yii::t('app', '开户银行'); ?></label>
            <input disabled id="bank" value="<?php echo $res['bank']; ?>" style="color:#fff;">
        </div>
    </div>

    <div class="am-u-sm-12">
        <div class="login1">
            <label style="color: red;width: 3px;">*</label><label class="nub-2"><?php echo Yii::t('app', '银行卡号'); ?></label>
            <input type="text" id="bank_number" disabled value="<?php echo $res["bank_number"]; ?>" placeholder="<?php echo Yii::t('app', '请输入开户银行的卡号'); ?>" style="color:#fff;">
        </div>
    </div>
</div>

<div align="center">
    <button id="mcard" type="button" class="am-btn am-radius button" style="color: #fff; margin-top: 50px;background:url(/img/baor_top.png) no-repeat top left;background-size:100% 100%;border-radius: 6px;">
        <?php echo Yii::t('app', '确定'); ?>
    </button>
</div>

<!--[if lt IE 9]>
<!--<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>-->
<!--<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>-->
<!--<script src="assets/js/amazeui.ie8polyfill.min.js"></script>-->
<!--<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="../js/jquery.min.js"></script>
<!--<![endif]-->
<script src="../js/amazeui.min.js"></script>
<!--<script src="../js/swiper-3.3.1.min.js"></script>-->
<!--<script src="../js/home.js"></script>-->
<script>

    $("#mcard").on("click",function(){
        var bankid = $("#bankid").val();
        var display = $('#xuan').css('display');
        if(display == 'block'){
            var isdefault = 1;
        }else{
            var isdefault = 2;
        }
        $("#mcard").prop("disabled", true);
        $.ajax({
            type: 'post',
            url: "/trade/updatebank.html",
            data: {bankid:bankid,order_type: <?php echo $order_type; ?>},
            dataType: "json",
            success: function(data) {
                if(data.status == '0001'){
                    alert(data.message);
                    if(data.order_type == 1) {
                        goAppBack();
                    } else {
                        window.location.href = '/trade/tbselling.html';
                    }
                }else{
                    alert(data.message);
                    if(data.order_type == 1) {
                        goAppBack();
                    } else {
                        window.location.href = '/trade/tbselling.html';
                    }
                }
                $("#mcard").prop("disabled", false);
            }
        });
    });
</script>
</body>

</html>
