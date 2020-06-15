<!DOCTYPE html>
<html lang="zh-CN" class="ACCOUNT">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $title; ?></title>
    <link href="/css/admin.css" rel="stylesheet">
    <link href="/css/base.css" rel="stylesheet">
    <link href="/css/myassets.css" rel="stylesheet">
</head>
<style>
    .approve {
        width: 100%;
        height: 80px;
        border: none;
    }
    .ren {
        width: 50px;
        height: 25px;
        border: 1px solid white;
        border-radius: 5px;
        float: right;
        margin-top: -46px;
        line-height: 25px;
        font-size: 13px;
        text-align: center;
        color: white;
        margin-right: 10px;
    }

    body{background:url(/img/bg2.png) no-repeat top left;background-size:100% 100%;}
    .addcard span{color:#fff;}
    .approve1{border-radius: 0px;background:url(/img/baor_top.png) no-repeat top left;background-size:100% 100%;margin-bottom:5px;-moz-box-shadow: 3px 3px 4px rgba(0,0,0,.8);-webkit-box-shadow: 3px 3px 4px rgba(0,0,0,.8);box-shadow: 3px 3px 4px rgba(0,0,0,.8);}
    .approve2 p {margin-left: 0;}
</style>
<section class="content">
    <input type="hidden" id="hascard" name="hascard" value="<?php echo $hascard;?>">

    <?php foreach ($res as $item): ?>
        <div class="approve" id="<?php echo $item["id"]; ?>">
            <div class="approve1">
                <p><?php echo Yii::t('app',$item["bank"]); ?></p>
                <?php if($item["isdefault"] == 2 ):?>
                    <div class="ren"><?php echo  Yii::t('app', '默认'); ?></div>
                <?php else:?>
                    <div></div>
                <?php endif;?>
            </div>
            <div class="approve2">
                <p style="color: #fff; box-shadow: 3px 3px 4px rgba(0,0,0,.8);"><span style="margin-left: 20px;"><?php  echo $item["bank_number"]; ?></span></p>
<!--                <div class="ren1"><a href="--><?php //echo Url::toRoute(["user/bank","id" => $item["id"]]);?><!--">--><?php //echo Yii::t('app', '删除'); ?><!--</a></div>-->
            </div>
        </div>
    <?php endforeach; ?>

    <?php if($hascard == 2) { ?>
        <div class="am-g">
            <div class="am-u-sm-12 Acard" id="addcard">
                <input type="text" placeholder="<?php echo Yii::t('app', '添加银行卡'); ?>" class="card" disabled />
            </div>
        </div>
    <?php } ?>
    <script src="../js/jquery.min.js"></script>
    <!--<![endif]-->
    <script src="../js/amazeui.min.js"></script>
    <script>
        $(".approve").click(function(){
            var appdid = $(this).attr("id");
            window.location="/trade/modify.html?order_type=<?php echo $order_type; ?>&id=" + appdid;
        })
    </script>
</section>
