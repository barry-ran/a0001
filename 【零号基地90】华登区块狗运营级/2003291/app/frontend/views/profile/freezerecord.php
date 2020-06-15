<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php echo Yii::t('app', '定存记录'); ?></title>
        <link rel="stylesheet" href="/css/common.css" />
        <link rel="stylesheet" href="/css/resetTable.css" />
    </head>

    <body>
<!--        <div class="header">
            <div class="headerBack"  onclick="javascript:window.history.back();return false;">
                <img src="/img/goLeft.png"/>
            </div>
            <?php //echo Yii::t('app', '定存记录'); ?>
        </div>-->
        <!-- 背景div -->
        <div id="mydiv"></div>
        <div id="mydivIMG">
            <img src="/img/mosha_001.png"/>
        </div>
        <div class="am-container">
            <div class="am-g">

                <!--主背景块-->

                <div>
                    <table class="gtable">
                        <thead>
                            <tr>
                                <th><?php echo Yii::t('app', '数量'); ?></th>
                                <th><?php echo Yii::t('app', '定存时间'); ?></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($res['data'] as $item): ?>
                            <tr>
                                <td class="boxDate">-<?php echo $item['num'] ?></td>
                                <td class="colorYellow"><?php echo date("Y-m-d",$item['created_at']); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="pagination">
                        <?php echo common\components\SLinkPager::widget([
                                'pagination' => $res['pager'],
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