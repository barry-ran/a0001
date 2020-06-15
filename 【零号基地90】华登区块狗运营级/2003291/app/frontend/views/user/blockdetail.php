<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo Yii::t('app','区块详情')?></title>
    <link rel="stylesheet" href="/css/common.css" />
    <link rel="stylesheet" href="/css/resetTable.css" />
    <link rel="stylesheet" href="/css/page2.css" />
    <style>
        body{
            overflow: auto;
        }
        *, :after, :before{
            box-sizing: content-box;
        }
        .ln{
            line-height: normal !important;
            height: auto !important;
        }
        .accordionName{
            width: 120px;
        }
        .qkym{
            display: inline-block;
            margin: 10px 10px 0;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<!--主背景块-->
<div class="userGo">
    <a class="qkym" href="/user/blockintro.html?token=<?php echo $token; ?>"><?php echo Yii::t('app', '点击了解区块源码');?></a>
    <!--保留以下这块用于循环 start-->
    <?php
    foreach ($data as $v){
        ?>
        <div class="accordion ln">
            <div class="width100">
                <div class="accordionName pl10">BlockId：<?php echo $v['id']; ?></div>
                <div class="goRight">Hash: <?php echo $v['hash']; ?></div>
            </div>
            <div class="width100 mt10">
                <div class="accordionName pl10">Time: <?php echo date('Y-m-d H:i:s',$v['created_at']); ?></div>
                <div class="goRight">ParentHash: <?php echo $v['pre_hash'] ? $v['pre_hash'] : ' - '; ?></div>
            </div>
        </div>
        <?php
    }
    ?>
    <!--循环体 end-->
    <div class="pagination">
        <?php echo common\components\SLinkPager::widget([
            'pagination' => $pager,
            'firstPageLabel' => Yii::t("app", "首页"),
            'nextPageLabel' => Yii::t("app", "下一页"),
            'prevPageLabel' => Yii::t("app", "上一页"),
            'lastPageLabel' => Yii::t("app", "末页"),
            "hideOnSinglePage" => false
        ]);
        ?>
    </div>
</div>


<!--<script type="text/javascript" src="/js/canvas-particle.js"></script>-->
<script charset="utf-8" src="/js/3.2.1.js"></script>
</body>
</html>



