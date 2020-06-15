<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo Yii::t('app', '通知公告'); ?></title>
    <link rel="stylesheet" href="/css/ymj.css" />
    <style>
        iframe{
            width: 100%; height: auto; display: inherit;
        }
        body{
            overflow: auto;
            background: url(/img/bg2.png) no-repeat top left;
            background-size: 100% 100%;
        }
        div,p,span{color: white!important;}
        .bulletinTime{border-bottom: 1px dotted white!important;}
    </style>
</head>

<body>
<div class="am-container">
    <div class="am-g">
        <div class="am-u-sm-12 userGo">
            <div class="accordion3 mt10" style="color: white!important;">
                <div class="bulletinTitle pad5">
                    <span class="bull">&bull;</span>
                    <?php if ($lang == 'zh_CN') { ?>
                        <?php echo $data["title"]; ?>
                    <?php } else { ?>
                        <?php echo $data["title_en"]; ?>
                    <?php } ?>
                    <span class="bull">&bull;</span>
                </div>
                <div class="bulletinTime"><?php echo Yii::$app->formatter->asDatetime($data["created_at"]); ?></div>
                <div class="bulletinArticle">
                    <?php if ($lang == 'zh_CN') { ?>
                        <?php echo htmlspecialchars_decode($data["content"]); ?>
                    <?php } else { ?>
                        <?php echo htmlspecialchars_decode($data["content_en"]); ?>
                    <?php } ?>
                </div>
            </div>
        </div>

    </div>
</div>
<script charset="utf-8" src="/js/3.2.1.js"></script>
</body>

</html>