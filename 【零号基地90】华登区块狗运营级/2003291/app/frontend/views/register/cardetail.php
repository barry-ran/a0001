<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php echo Yii::t('app', '购买加速器');?></title>
        <link rel="stylesheet" href="/css/common.css" />
        <link rel="stylesheet" href="/css/resetTable.css" />
    </head>

    <body>
<!--        <div class="header">
            <div class="headerBack" onclick="javascript:window.history.back();return false;">
                <img src="/img/goLeft.png"/>
            </div>
            <?php //echo Yii::t('app', '购买加速器');?>
            <a href="/user/mycontent.html">
                <div class="headerUser">
                    <span class="headerName">
                        <?php //echo Yii::$app->user->identity->username; ?>
                    </span>
                </div>
            </a>	
        </div>-->
        <!-- 背景div -->
        <div id="mydiv"></div>
        <div id="mydivIMG">
            <img src="/img/mosha_001.png"/>
        </div>
        <div class="am-container">
            <div class="am-g">
                <!--主背景块-->
                <div class="am-u-sm-12 userGo">

                    <div class="accordion3 qmgreen width100 mt10">
                        <div class="accordionImg3 accImg1 height100">
                            <img src="<?php echo $car['img']; ?>" />
                        </div>
                        <div class="accordionName pl10 pt15"><?php echo Yii::t('app', '型号');?>:</div>
                        <div class="accordionInput2"><?php echo $car['name']; ?></div>
                        <div class="accordionName pl10 pt15"><?php echo Yii::t('app', '价格');?>:</div>
                        <div class="accordionInput2"><?php echo sprintf('%0.2f',$car['price']); ?></div>
                    </div>

                    <div class="accordion3 tcenter">
                        <div class="orderBtn1 borderR8 width30f"><?php echo Yii::t('app', '加速器详情');?></div>
                        <!--<div class="orderBtn2">详情</div>-->
                    </div>

                    <div class="accordion3 tcenter width100 pad0">
                        <li class="asset2">
                            <div id="VMCPay">
                                <div class="accordion">
                                    <div class="accordionName fl pl15"><?php echo Yii::t('app', '等级');?>:</div>
                                    <div class="accordionInput"><?php echo $car['level']; ?></div>
                                </div>

                                <div class="accordion">
                                    <div class="accordionName fl pl15"><?php echo Yii::t('app', '加速比例');?>:</div>
                                    <div class="accordionInput"><?php echo $car['award_per']*100 .'%'; ?></div>
                                </div>
                                <div class="accordion">
                                    <div class="accordionName fl pl15"><?php echo Yii::t('app', '价格');?>:</div>
                                    <div class="accordionInput colorRed">
                                        <input type="text" class="tright" disabled=true placeholder="<?php echo $car['price']; ?>"/>
                                    </div>
                                </div>
                                <div class="accordion">
                                    <div class="accordionName fl pl15"><?php echo Yii::t('app', '购买数量');?>:</div>
                                    <div class="accordionInput colorRed">
                                        <input type="text" class="tright" name="out_num"  id="out_num" value="1" placeholder="<?php echo Yii::t('app', '请输入购买数量'); ?>"/>
                                    </div>
                                </div>
                                <div class="accordion">
                                    <div class="accordionName fl pl15"><?php echo Yii::t('app', '总价格');?>:</div>
                                    <div class="accordionInput colorRed"><?php echo $car['price']; ?> <?php echo Yii::t('app', '卢宝');?></div>
                                </div>

                                <div class="accordion">
                                    <div class="accordionName fl pl15"><?php echo Yii::t('app', '交易密码');?>:</div>
                                    <div class="accordionInput">
                                        <input type="password" class="tright" name="pay_pwd" id="pay_pwd" placeholder="<?php echo Yii::t('app', '请输入交易密码');?>"/>
                                    </div>
                                </div>

                                <!--这个隐藏域用来存储支付类型-->
                                <input type="hidden" name="price" id="price" value="<?php echo $car['price']; ?>">
                                <input type="hidden" name="my_cash" id="my_cash" value="<?php echo $user_wallet->cash_wa; ?>">
                                <input type="hidden" name="car_id" id="car_id" value="<?php echo $car['id']; ?>">
                                <input type="hidden" name="token" id="token" value="<?php echo $token; ?>">
                                <div class="am-u-sm-12 safeLogout">
                                    <button type="button" id="sendOutBtn"><?php echo Yii::t('app', '立即购买');?></button>
                                </div>
                            </div>
                        </li>

                        <!--当前加速器价格--><input type="hidden" id="total_price" value="<?php echo $car['price']; ?>" />
                    </div>

                </div>
            </div>
        </div>
        <script src="/js/jquery.min.js"></script>
<!--        <script type="text/javascript" src="/js/canvas-particle.js"></script>-->
        
        <script src="/js/interactive.js"></script>
    <!--<![endif]-->
    <script>
        $("#out_num").on("blur",function(){
            var price = $("#price").val();
            var out_num = parseFloat($("#out_num").val());
            var total = price * out_num;
            
            $("#total_price").html(total);
        });
        
        $('#sendOutBtn').click(function(){
            $('#sendOutBtn').attr("disabled","disabled");
            //  校验报单卢宝
            var out_num = parseFloat($("#out_num").val());

            if(isNaN(out_num)){
                alert('<?php echo Yii::t('app', '购买数量格式不正确！'); ?>');
                $('#sendOutBtn').removeAttr('disabled');
                return false;
            }else{
                if(out_num < 1){
                    alert('<?php echo Yii::t('app', '购买数量不能小于1！'); ?>');
                    $('#sendOutBtn').removeAttr('disabled');
                    return false;
                }
            }
            
            var my_cash = $("#my_cash").val();
            var price = $("#price").val();
            var total_price = out_num * price;
            var token = $("#token").val();
            if(my_cash < total_price){
                alert('<?php echo Yii::t('app', '卢宝不足！'); ?>');
                $('#sendOutBtn').removeAttr('disabled');
                return false;
            }
            //支付密码
            var pay_pwd = $("#pay_pwd").val();
            if(pay_pwd == ""){
                alert('<?php echo Yii::t('app', '请输入支付密码'); ?>！');
                $('#sendOutBtn').removeAttr('disabled');
                return false;
            }
            var car_id = $("#car_id").val();
            $.ajax({
                type: "post",
                data: {out_num:out_num,car_id:car_id,pay_pwd:pay_pwd,token:token},
                dataType: "json",
                url: "/register/buycar.html",
                success: function (data) {
                    if (data.status == '0001') {
                        alert(data.msg);
                        window.location.href = '/register/mycar.html?token='+token;
                    } else {
                        alert(data.msg);
                    }
                    $('#sendOutBtn').removeAttr('disabled');
                }
            });
        });
    </script>
    </body>

</html>