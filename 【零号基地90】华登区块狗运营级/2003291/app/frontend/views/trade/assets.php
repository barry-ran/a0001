<!DOCTYPE html>
<html lang="zh-CN" class="ACCOUNT">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php  echo $title2; ?></title>
    <link href="/css/home.css" rel="stylesheet">
    <link href="/css/myassets.css" rel="stylesheet">

    <link rel="stylesheet" href="/css/common2.css" />
    <style>
        html{overflow: initial;}
        body{overflow:auto;background:url(/img/bg2.png) no-repeat left top;background-size:100% 100%;}
        .vpayzi {border: 0;}
        .vpayzi-1 {background-color: #ff9000;display: -webkit-box;}
        .vpayzi-2 {font-size: 14px;color:#fff;}
        .vpayzi-3 {background-color: #ff9000;}
        .vpayzi-4 {font-size: 14px;width:100%;}
        .split {margin: 0 auto;width: 90%; height: 1px;background-color: #4d4d4d;border: none;}
        input:disabled, textarea:disabled {color: rgb(0, 0, 0) !important;}
        .money-b-b{height:25px;border-radius: 3px;margin-left:10%;margin-right:3%; background-color:rgb(21,179,213);border:none;color:white;}
        .money-c{height:25px;border-radius: 3px;background-color: #57DBB1; border:none;line-break: none;color:white;}
        .vpayzi-2{width: 150px;height: 20px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;line-height: 20px;}
        
        .asset{background:url(/img/baor_top.png) no-repeat left top;background-size:100% 100%;}
    </style>
</head>

<section class="content">
    <div class="asset">

        <div align="center" style="position:relative;">
            <img src="/img/zichan-logo.png" style="max-width:120px;max-height:120px;">
            <a href="/trade/traderecord.html?status=ywc&type=2&order_type=1" style="position:absolute;right: 10px;top:10px;">
<!--                <span style="color: white;">--><?php //echo Yii::t('app', '交易记录'); ?><!--</span>-->
            </a>
        </div>
        <!--<div align="center" class="asset-span" style="margin-top: 0px;"><span style="margin-left: 5px; color: white; font-weight: bolder;font-size: 25px; letter-spacing: 2px;"><?php echo $balSysPrice; ?></span></div>-->
        <div align="center" class="asset-span">
            <span style=" color: white;letter-spacing: 2px;font-size: 20px;display:block;"><?php echo $lkcSysPrice; ?></span>
            <span style="color: white;display:block;"><?php echo Yii::t('app', '当前价格'); ?></span>
        </div>
    </div>

    <div class="digital" style="color: white; margin-top:5px; width: 100%; height: 120px;background:url(/img/baor_top2.png) no-repeat top left;background-size:100% 100%;padding-top:.1px;">
        <div class="vpayzi"style="height:40px;overflow: hidden;">
            <!--style="background-color:#F0CC3A;"-->
            <div class="vpayzi-1" style="margin-top:15px;float:left;"></div>
            <div class="vpayzi-2" style="color:#fff;height: 40px;line-height:40px;float:left;margin-top:0px;margin-left:8px;">
                <?php echo Yii::t('app', '卢宝资产'); ?>&nbsp;
            </div>
                <span style="float: right;text-align: right;color: rgb(0,246,255);height: 40px;line-height:40px;margin-right:8px;"><?php echo $user_wallet['cash_wa']; ?></span>
        </div>

        <div class="vpayzi"style="height: 40px;overflow: hidden;">
            <div class="vpayzi-3" style="margin-top:15px;float:left;background:red;"></div>
            <div class="vpayzi-2" style="color:#fff;height: 40px;line-height:40px;float:left;margin-top:0px;margin-left:8px;">
                <?php echo Yii::t('app', '钱包地址'); ?>&nbsp;
            </div>

            <button class="vpayzi-4 clone" style="background:none;border: 0;color:rgb(0,246,255);text-align:right;float:right;width:100px;margin-top:0px;padding:0px;height:40px;line-height:40px;" id="test" data-clipboard-action="copy" data-clipboard-target="#wallet_addr"><?php echo Yii::t('app', '复制地址'); ?></button>
        </div>
        <div class="vpayzi" style="border: 0;height: 40px;">
            <input class="address fzdz" readonly="readonly"  style=" background: transparent; width: 90%;border: 0; outline: 0;margin-top: 0;color:#ccc !important;" type="text" readonly id="wallet_addr" value="<?php echo $wallet_token; ?>">
        </div>
        <div style="clear:both;"></div>
    </div>
    
    <div class="coin" style="color: #ff9000; margin-top:5px;background:url(/img/baor_top2.png) no-repeat top left;background-size:100% 100%;">
        <div class="people">
            <div align="center" class="middle">
                <a href="javascript:void(0);" style="color: #fff;"><img src="/img/my_assets@2x.png"><br />
                    <?php echo Yii::t('app', '我的资产'); ?>
                </a>
            </div>
        </div>
        <div class="people">
            <div align="center" class="middle">
                <a href="javascript:void(0);" style="color: #fff;"><img src="/img/zhong_chou@2x.png"><br />
                    <?php echo Yii::t('app', '众筹'); ?>
                </a>
            </div>
        </div>
        <div class="people">
            <div align="center" class="middle">
                <a href="javascript:void(0);" style="color:#fff;"><img src="/img/zhuan_chu2@2x.png"><br />
                    <?php echo Yii::t('app', '转出'); ?></a>
            </div>
        </div>
        <div class="people">
            <div align="center" class="middle">
                <a href="/trade/tbtradecenter.html?method=2" style="color: #fff;"><img src="/img/jiao_yi@2x.png"><br />
<!--                <a href="javascript:alert('--><?php //echo Yii::t('app', '功能暂未开放'); ?><!--')" style="color: #fff;"><img src="/img/jiao_yi@2x.png"><br />-->
                    <?php echo Yii::t('app', '交易'); ?>
                </a>
            </div>
        </div>

    </div>

    <div class="digital" style="color:#4E4E4E;  margin-top:5px; width: 100%; height:initial;background:none;">
            <div class="vpayzi" style="margin-bottom:5px; border: 0;height:auto;overflow: hidden;padding: 5px 0;background:url(/img/baor_top2.png) no-repeat top left;background-size:100% 100%;">
                <div>
                    <span class="vpayzi-1"></span>
                    <span class="vpayzi-2">
                        <?php echo Yii::t('app', 'LKC'); ?>&nbsp;
                    </span>
                </div>

                <div class="" style="border: 0;float: left;clear: both;width:100%;margin-left: 10px">
                    <div class="" style="border: 0;">
                        <div style="float:left;width:22%;">
                            <span style="color:#fff; border: 0; background: transparent; vertical-align: middle;"><?php echo $user_wallet['care_wa']; ?></span><br/>
                            <span style="color: rgb(179,179,179); vertical-align: middle;"><?php echo Yii::t('app', 'LKC'); ?><?php echo Yii::t('app', '资产'); ?></span>
                        </div>
                        <div style="float:left;width:22%;" align="center">
                            <span style="color:rgb(0,246,255); border: 0; background: transparent; vertical-align: middle;overflow: hidden;text-overflow:ellipsis;white-space: nowrap;"><?php echo $lkcSysPrice; ?></span><br/>
                            <span style="color:rgb(179,179,179); vertical-align: middle;overflow: hidden;text-overflow:ellipsis;white-space: nowrap;"><?php echo Yii::t('app', '当前价格'); ?></span>
                        </div>
                        <div style="width:56%;float:left;">
                            <a href="/trade/tbtradecenter.html?method=1"><button class="money-b-b"><?php echo Yii::t('app', '现金交易'); ?></button></a>
                            <a href="/trade/tbtradecenter.html?method=2"><button class="money-c"><?php echo Yii::t('app', '卢宝交易'); ?></button></a>
                        </div>
                    </div>
                </div>
            </div>

            <?php foreach ($coins as $coin) { ?>
            <div class="vpayzi" style="margin-bottom: 5px;overflow: hidden;height:initial;padding:5px 0;background:url(/img/baor_top2.png) no-repeat top left;background-size:100% 100%;">
                <div>
                    <span class="vpayzi-1"></span>
                    <span class="vpayzi-2">
                        <?php if($lang == "en_US") { ?>
                            <?php echo $coin['en_name']; ?>
                        <?php } else { ?>
                            <?php echo $coin['name']; ?>
                        <?php } ?>
                    </span>
                </div>
                
                <div class="" style="border: 0;float: left;clear: both;width:100%;margin-left: 10px">
                    <div class="" style="border: 0;">
                        <div style="float:left;width:22%;">
                            <span style="color:#fff; border: 0; background: transparent; vertical-align: middle;"><?php //echo $user_wallet['care_wa']; ?>0.0000</span><br/>
                            <span style="color:rgb(179,179,179); vertical-align: middle;">
                                <?php if($lang == "en_US") { ?>
                                    <?php echo $coin['en_name']; ?><?php echo Yii::t('app', '资产'); ?>
                                <?php } else { ?>
                                    <?php echo $coin['name']; ?><?php echo Yii::t('app', '资产'); ?>
                                <?php } ?>
                            </span>
                        </div>
                        <div style="float:left;width:22%;" align="center">
                            <span style="color: rgb(0,246,255); border: 0; background: transparent; vertical-align: middle;height:20px;overflow: hidden;text-overflow:ellipsis;white-space: nowrap;"><?php echo $coin['price']; ?></span><br/>
                            <span style="color: rgb(179,179,179); vertical-align: middle;height:20px;overflow: hidden;text-overflow:ellipsis;white-space: nowrap;"><?php echo Yii::t('app', '当前价格'); ?></span>
                        </div>
                        <div style="width:56%;float:left;">
                            <button class="money-b-b dev"><?php echo Yii::t('app', '现金交易'); ?></button>
                            <a href="/trade/applybuy.html"><button class="money-c"><?php echo Yii::t('app', '卢宝交易'); ?></button></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

</section>
<script src="/js/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/clipboard.js/2.0.1/clipboard.min.js"></script>
<script src="/js/interactive.js"></script>
<script>
    $(function () {
//        背景高宽
        $("body").width($(document).outerWidth(true));
        var height = $(document).outerHeight(true)
	$("body").css('min-higeht','height');
        
        var u = navigator.userAgent;
        var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
        var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
        if(isiOS) {
            $('#test').click(function(){
                $("#wallet_addr").removeAttr('disabled');
            });
            var clipboard = new ClipboardJS("#test");
            clipboard.on("success", function() {
                alert("<?php echo Yii::t('app', '已复制链接');?>");
                $("#wallet_addr").attr('disabled', 'disable');
            })
        } else {
            $("#test").click(function(){
                $("#wallet_addr").removeAttr('disabled');
                var c=$("#wallet_addr").select();
                if(document.execCommand('copy', false, null)){
                    document.execCommand('copy', false, null); // 执行浏览器复制命令
                    alert("<?php echo Yii::t('app', '已复制链接'); ?>");
                    $("#wallet_addr").attr('disabled', 'disabled');
                }
            })
        }
    });

    $(".dev").click(function() {
        alert("<?php echo Yii::t('app', '功能暂未开放'); ?>");
    });


</script>
