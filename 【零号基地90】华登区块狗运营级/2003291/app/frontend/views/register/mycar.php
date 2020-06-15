<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php echo Yii::t('app', '我的加速器');?></title>
        <link rel="stylesheet" href="/css/ymj.css" />
        <link rel="stylesheet" href="/css/page2.css" />
        <link rel="stylesheet" href="/css/resetTable.css" />
        <link rel="stylesheet" href="/css/home.css" />
    </head>

    <body>
        <div class="am-container">
            <div class="am-g">
                <!--主背景块-->

                <div class="am-u-sm-12 userGo">
                    <?php foreach ($mycar['data'] as $item): ?>
                    <div class="accordion3 qmgreen width100_20 mt10">
                        <div class="accordionImg3 accImg1">
                            <img src="<?php echo $item['car_img']; ?>"/>
                        </div>
                        <div class="accordionName pl10"><?php echo Yii::t('app', '型号');?>:</div>
                        <div class="accordionInput2"><?php echo $item['car_name'];?></div>
                        <div class="accordionName pl10"><?php echo Yii::t('app', '级别');?>:</div>
                        <div class="accordionInput2 colorRed"><?php echo $item['car_level'];?></div>
                        <div class="accordionName pl10"><?php echo Yii::t('app', '价格');?>:</div>
                        <div class="accordionInput2"><?php echo $item['car_price'];?></div>
                        <div class="accordionName pl10"><?php echo Yii::t('app', '加速比例');?>:</div>
                        <div class="accordionInput2"><?php echo $item['award_per']*100 .'%';?></div>
                        <div class="accordionName pl10"><?php echo Yii::t('app', '已加速天数');?>：</div>
                        <div class="accordionInput2"><?php echo $item['get_num'];?></div>
                        <div class="accordionName pl10"><?php echo Yii::t('app', '总天数');?>：</div>
                        <div class="accordionInput2"><?php echo $item['out_num'];?></div>
                        <div class="tright">
                            <div class="languageBtn">
                                <?php
                                if($item['get_num'] >= $item['out_num']){
                                    echo  Yii::t('app', '已出局');
                                }else{
                                    echo Yii::t('app', '运行中');
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <div class="pagination">
                        <?php echo common\components\SLinkPager::widget([
                                'pagination' => $mycar['pager'],
                                'firstPageLabel' => Yii::t("app", "首页"),
                                'nextPageLabel' => Yii::t("app", "下一页"),
                                'prevPageLabel' => Yii::t("app", "上一页"),
                                'lastPageLabel' => Yii::t("app", "末页"),
                                "hideOnSinglePage" => false
                            ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="/js/jquery.min.js"></script>
<!--        <script type="text/javascript" src="/js/canvas-particle.js"></script>-->
        <script charset="utf-8" src="/js/3.2.1.js"></script>
        <script src="/js/interactive.js"></script>
    </body>

</html>