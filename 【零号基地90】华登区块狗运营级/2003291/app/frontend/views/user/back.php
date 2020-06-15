<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title><?php echo Yii::t('app', '添加银行卡'); ?></title>
    <link rel="stylesheet" href="../css/amazeui.min.css" />
    <link rel="stylesheet" href="../css/login.css" />
    <link rel="stylesheet" href="../css/myassets.css" />
</head>

<body>
<div  class="am-g">
    <div align="center" class="am-u-sm-12">
        <p class="bound"></p>
    </div>
</div>
<div class="am-g" style="background-color: white;width: 90%;border-radius: 5px;">
        <div class="am-u-sm-12">
            <div class="login1">
                <label style="color: red;width: 3px;">*</label><label class="nub-2"><?php echo Yii::t('app', '持卡人姓名'); ?></label>
                <input type="text" id="username" placeholder="<?php echo Yii::t('app', '请输入持卡人姓名'); ?>">
            </div>
        </div>

        <div class="am-u-sm-12">
            <div class="login1">
                <label style="color: red;width: 3px;">*</label><label class="nub-2"><?php echo Yii::t('app', '开户银行'); ?></label>
                <select class="option" id="bank">
                    <option value=""><?php echo Yii::t('app', '请选择开户银行'); ?></option>
                    <?php if($lang == "en_US"){?>
                        <?php foreach ($bankdata as $item): ?>
                            <option value="<?php echo $item["en_name"]; ?>"><?php echo $item["en_name"]; ?></option>
                        <?php endforeach; ?>
                    <?php } else {?>
                        <?php foreach ($bankdata as $item): ?>
                            <option value="<?php echo $item["name"]; ?>"><?php echo $item["name"]; ?></option>
                        <?php endforeach; ?>
                    <?php }?>
                </select>
            </div>
        </div>

        <div class="am-u-sm-12">
            <div class="login1">
                <label style="color: red;width: 3px;">*</label><label class="nub-2"><?php echo Yii::t('app', '银行卡号'); ?></label>
                <input type="text" id="bank_number" placeholder="<?php echo Yii::t('app', '请输入开户银行的卡号'); ?>">
            </div>
        </div>
        <div class="am-u-sm-12">
            <div class="login1" style="border-bottom: 0px;">
                <label class="nub-2"><?php echo Yii::t('app', '开户支行'); ?></label>
                <input type="text" id="branch" placeholder="<?php echo Yii::t('app', '请输入开户银行的支行分行'); ?>">
            </div>
        </div>
</div>
<div style="width: 90%;height:50px;margin:auto;margin-top: 10px;">
    <div class="default" id="xuan"></div>
    <div class="default2" align="center" id="ze">√</div>
    <div class="default1"><?php echo Yii::t('app', '设为默认银行卡'); ?></div>
</div>
<div align="center">
    <button id="addcard" type="submit" class="am-btn am-btn-secondary am-radius button" style="color:white;background-color:#1e88e5;outline: none;border-bottom: 0px;border-top: 0px;border-left: 0px;border-right: 0px;padding-bottom: 10px;padding-top: 10px;">
        <?php echo Yii::t('app', '确定'); ?>
    </button>
</div>

<script src="../js/jquery.min.js"></script>
<script src="../js/amazeui.min.js"></script>
<script src="../js/home.js"></script>
<script>
    $("#xuan").click(function(){
        $("#xuan").css("display","none");
        $("#ze").css("display","block");
    })

    $("#ze").click(function(){
        $("#xuan").css("display","block");
        $("#ze").css("display","none");
    })

    $("#addcard").on("click",function(){
        var userid = $("#userid").val();
        var username = $("#username").val();
        var bank = $("#bank").val();
        var bank_number = $("#bank_number").val();
        var branch = $("#branch").val();
        var display = $('#xuan').css('display');
        if(display == 'block'){
            var isdefault = 1;
        }else{
            var isdefault = 2;
        }
        if(username == "" || username == null){
            alert(" <?php echo Yii::t('app', '必须输入持卡人姓名'); ?>！");
            return false;
        }
        if(bank =="" || bank == null){
            alert(" <?php echo Yii::t('app', '必须选择开户银行名称'); ?>！");
            return false;
        }
        if(bank_number =="" || bank_number == null){
            alert("<?php echo Yii::t('app', '必须输入银行卡号 '); ?>！");
            return false;
        }
        if(isNaN(bank_number)){
            alert('<?php echo Yii::t("app", "银行卡号必须是数字"); ?>！');
            return false;
        }
        $("#addcard").prop("disabled",true);
        var url = "/user/back.html";
        $.ajax({
            type: 'post',
            url: url,
            data: {userid:userid,username:username,bank:bank,bank_number:bank_number,isdefault:isdefault,branch:branch},
            dataType: "json",
            success: function(result) {
                if(result.status == true){
                    alert(result.message);
                    location.href = '/user/addcard.html';
                }else{
                    alert(result.message);
                }
                $("#addcard").prop("disabled",false);
            }
        });
    });
</script>
</body>

</html>
