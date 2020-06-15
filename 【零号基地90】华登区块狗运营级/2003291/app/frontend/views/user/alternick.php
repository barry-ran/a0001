<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo Yii::t('app', '修改昵称'); ?></title>
    <link rel="stylesheet" href="/css/common.css" />
</head>

<body>
<div class="am-container">
    <div class="am-g">
        <div class="am-u-sm-12 userGo">
            <div class="accordion2">
                <div class="accordionInput frm">
                    <input type="text" name="truename" value="<?php echo $user->userprofile->truename;?>"  placeholder="<?php echo Yii::t('app', '请输入昵称'); ?>" class="txt large fl" step="1">
                    <label title="<?php echo Yii::t('app', '昵称'); ?>"></label>
                    <span role="tooltip"></span>
                </div>
                <div class="goRight opacity6 closeInput"><img src="/img/close_gray_18.png" /></div>
            </div>
        </div>
        <div class="am-u-sm-12 safeLogout">
            <button type="button" class="btnsize" style="background-color:#1e88e5;color:white;">
                <?php echo Yii::t('app', '确定'); ?>
            </button>
        </div>
    </div>
</div>
<script charset="utf-8" src="/js/3.2.1.js"></script>
<script charset="utf-8" src="/js/common.js"></script>
<script>
    $('.btnsize').click(function(){
        $(this).prop("disabled", true);
        var url = "/user/alternick.html";
        $.ajax({
            type: "post",
            data: {truename: $('[name="truename"]').val()},
            dataType: "json",
            url: url,
            success: function (data) {
                if (data.status == '0001') {
                    alert(data.msg);
                } else {
                    alert(data.msg);
                }
                $('.btnsize').prop("disabled", false);
            }
        });
    });
</script>
</body>

</html>
