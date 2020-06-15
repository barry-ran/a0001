<!DOCTYPE html>

<html lang="zh-CN" class="ACCOUNT am-touch js cssanimations"><head>

    <meta charset="UTF-8">

    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">

    <meta name="apple-mobile-web-app-capable" content="yes">

    <meta name="apple-touch-fullscreen" content="yes">

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title><?php echo $title2; ?></title>

    <link href="/css/admin.css" rel="stylesheet">

    <link href="/css/amazeui.min.css" rel="stylesheet">

    <link href="/css/myassets.css" rel="stylesheet">

    <link rel="stylesheet" href="/css/common2.css">

    <link rel="stylesheet" href="/css/resetTable2.css">

    <link rel="stylesheet" href="/css/page2.css?version=1">

    <style>



        .Nubtime1{ text-align: center;font-size: 16px; background-color: white;}

        .choose{ color: #1AB1FF; border-bottom: 1px solid #1AB1FF;}

        .unchoose {color: #b3b3b3;}

        .pagination > li > a,

        .pagination > li > span {

            background: #1AB1FF;

            border: 1px solid #1AB1FF;

            border-left: 1px solid #3b3b3a;

        }

        .pagination > .disabled > span,

        .pagination > .disabled > span:hover,

        .pagination > .disabled > span:focus,

        .pagination > .disabled > a,

        .pagination > .disabled > a:hover,

        .pagination > .disabled > a:focus {

            color:#b3b3b3;

            cursor: not-allowed;

            background-color: white;

            border-color: #1AB1FF;

        }

        body{

            overflow: auto;

            overflow-x: hidden;

        }

    </style>

</head>

<section style="position:absolute;top: 0;width: 100%;">

    <div class="am-container">

        <div class="am-g">

            <div class="am-g Nubtime1" style="margin-right:0;margin-left: 0;">

                <a href="/trade/traderecord.html?token=<?php echo $token?$token:''; ?>&status=ywc&type=2&order_type=<?php echo $_GET['order_type'] ?>">

                    <div class="am-u-sm-6 <?php echo  !isset($_GET['type']) || (isset($_GET['type']) && $_GET['type'] == 2) ? 'choose' : 'unchoose' ?>" ><?php echo Yii::t('app', '卖出已完成'); ?></div>

                </a>

                <a href="/trade/traderecord.html?token=<?php echo $token?$token:''; ?>&status=ywc&type=1&order_type=<?php echo $_GET['order_type'] ?>">

                    <div class="am-u-sm-6 <?php echo  isset($_GET['type']) && $_GET['type'] == 1 ? 'choose' : 'unchoose' ?>"><?php echo Yii::t('app', '买入已完成'); ?></div>

                </a>

            </div>

            <?php

            foreach ($tradeRecordData['data'] as $val){

                ?>

                <div class="am-u-sm-12 mt10 bg-white">

                    <div class="recodeRecode" style="border-bottom: 0;">

                        <div class="fl height44">

                            <div class="fz16 height22" style="color: #1AB1FF;"><?php echo $val['show']; ?></div>

                            <div class="color-grey height22" style="color: #b3b3b3;"><?php echo $val['created_at']; ?></div>

                        </div>

                        <div class="fr height44 tright">

                            <div class="height22" style="color: #1AB1FF;"><?php echo $val['show2']; ?></div>

                            <div class="color-red height22"><?php echo $val['description']; ?></div>

                        </div>

                    </div>

                </div>

                <?php

            }

            ?>

        </div>

        <div class="pagination" style="margin-top: 10px;">

            <?php echo common\components\SLinkPager::widget([

                'pagination' => $tradeRecordData['pager'],

                'firstPageLabel' => Yii::t("app", "首页"),

                'nextPageLabel' => Yii::t("app", "下一页"),

                'prevPageLabel' => Yii::t("app", "上一页"),

                'lastPageLabel' => Yii::t("app", "末页"),

                "hideOnSinglePage" => false

            ]);

            ?>

        </div>

    </div>

    <script src="/js/3.2.1.js"></script>

</section>