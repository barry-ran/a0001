<!DOCTYPE html>
<html>

<head lang="en">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo Yii::t('app', '修改银行卡'); ?></title>
    <link rel="stylesheet" href="/css/amazeui.min.css" />
    <link rel="stylesheet" href="/css/login.css" />
    <link rel="stylesheet" href="/css/myassets.css" />
</head>
<body>
<div class="am-g" style="float: left; border-radius:10px;margin-top: 5%;">
    <input type="hidden" id="bankid" value="<?php echo $res["id"]; ?>" />

    <div class="login1" style="border-top-left-radius: 10px;border-top-right-radius:10px;">
        <label class="nub-2"><?php echo Yii::t('app', '持卡人姓名'); ?></label>
        <input type="text" id="username" value="<?php echo $res["username"]; ?>" placeholder="<?php echo Yii::t('app', '请输入持卡人姓名'); ?>">
    </div>

    <div class="login1">
        <label class="nub-2"><?php echo Yii::t('app', '开户银行'); ?></label>
        <select class="option" id="bank">
            <?php if($lang == "en_US"){?>
                <?php foreach ($bankdata as $item): ?>
                    <option <?php  if($res["bank"]==$item["en_name"]){echo "selected";}?>><?php echo $item["en_name"]; ?></option>
                <?php endforeach; ?>
            <?php } else {?>
                <?php foreach ($bankdata as $item): ?>
                    <option <?php  if($res["bank"]==$item["name"]){echo "selected";}?>><?php echo $item["name"]; ?></option>
                <?php endforeach; ?>
            <?php }?>
        </select>
    </div>

    <div class="login1">
        <label class="nub-2"><?php echo Yii::t('app', '银行卡号'); ?></label>
        <input type="text" id="bank_number" value="<?php echo $res["bank_number"]; ?>" placeholder="<?php echo Yii::t('app', '请输入开户银行的卡号'); ?>">
    </div>

    <div class="login1" style="border-bottom-left-radius: 10px;border-bottom-right-radius:10px;">
        <label class="nub-2"><?php echo Yii::t('app', '开户支行'); ?></label>
        <input type="text" id="branch" value="<?php echo $res["branch"]; ?>" placeholder="<?php echo Yii::t('app', '请输入开户银行的支行分行'); ?>">
    </div>

    <div class="login1" style="border-bottom: 0;background-color: #f1f1f1;margin-top: 5px;">
        <?php if($res["isdefault"] == 2 ):?>
            <div class="default2" align="center" id="ze" style="display: block">√</div>
            <div class="default" id="xuan" style="display: none"></div>
        <?php else:?>
            <div class="default" id="xuan" style="display: block"></div>
            <div class="default2" align="center" id="ze" style="display: none">√</div>
        <?php endif;?>
        <div class="default1"><?php echo Yii::t('app', '设为默认银行卡'); ?></div>
    </div>
</div>
<div align="center">
    <button id="mcard" type="button" class="am-btn am-btn-secondary am-radius button" style="background-color:#1e88e5;outline: none;border-bottom: 0px;border-top: 0px;border-left: 0px;border-right: 0px;">
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
    });

    $("#ze").click(function(){
        $("#xuan").css("display","block");
        $("#ze").css("display","none");
    });

    $("#mcard").on("click",function(){
        var bankid = $("#bankid").val();
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
            return;
        }
        $("#mcard").prop("disabled",true);
        var url = "/user/updbankdata.html";
        $.ajax({
            type: 'post',
            url: url,
            data: {bankid:bankid, username:username,bank:bank,bank_number:bank_number,isdefault:isdefault,branch:branch},
            dataType: "json",
            success: function(result) {
                if(result.status === true){
                    alert(result.message);
                    location.href = '/user/addcard.html';
                }else{
                    alert(result.message);
                }
                $("#mcard").prop("disabled",false);
            }
        });
    });
</script>
</body>
</html>
