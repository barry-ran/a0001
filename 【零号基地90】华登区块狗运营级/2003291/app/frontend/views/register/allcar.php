<?php

use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php echo Yii::t('app', '加速器商城');?></title>
        <link rel="stylesheet" href="/css/common.css" />
        <link rel="stylesheet" href="/css/resetTable.css" />
        <link rel="stylesheet" href="/css/home.css" />
    </head>

    <body>
        <!-- 背景div -->
        <div id="mydiv"></div>
        <div id="mydivIMG">
            <img src="/img/mosha_001.png"/>
        </div>
        <div class="am-container">
            <div class="am-g">
                <!--主背景块-->
                <div class="am-u-sm-12 userGo pb60">
                    <?php foreach ($allcar as $item): ?>
                    <div class="accordion3 qmgreen width100_20 mt10">
                        <div class="accordionImg3 accImg1">
                            <img src="<?php echo $item['img']; ?>"/>
                        </div>
                        <div class="accordionName pl10"><?php echo Yii::t('app', '型号');?>:</div>
                        <div class="accordionInput2"><?php echo $item['name'];?></div>
                        <div class="accordionName pl10"><?php echo Yii::t('app', '级别');?>:</div>
                        <div class="accordionInput2"><?php echo $item['level'];?></div>
                        <div class="accordionName pl10"><?php echo Yii::t('app', '加速天数');?>:</div>
                        <div class="accordionInput2"><?php echo $item['out_times'];?></div>	
                        <div class="accordionName pl10"><?php echo Yii::t('app', '价格');?>:</div>
                        <div class="accordionInput2"><?php echo sprintf('%0.2f',$item['price']);?><span class="colorRed pl10"></span></div>
                        <div class="tright">
                            <a href="<?php echo Url::toRoute(["register/cardetail","id"=>$item['id'],'token'=>$token]); ?>"><div class="languageBtn" style="background-color: #E6b447; border-radius: 6px;"><?php echo Yii::t('app', '购买');?></div></a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <script src="/js/jquery.min.js"></script>
<!--        <script type="text/javascript" src="/js/canvas-particle.js"></script>-->
        <script charset="utf-8" src="/js/3.2.1.js"></script>
        <script src="/js/interactive.js"></script>
    </body>

</html>