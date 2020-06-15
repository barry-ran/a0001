<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title><?php echo Yii::t('app', '公告'); ?></title>
		<link rel="stylesheet" href="/css/ymj.css" />
	</head>

    <style>
        .accordionName{
            margin-left: 5%;
            float: left;
            width: 56%;
            overflow:hidden;
            text-overflow:ellipsis;
            white-space:nowrap
        }
    </style>

	<body>
		<div class="am-container">
			<div class="am-g" style="margin-top: -20px;">
				<div class="am-u-sm-12 userGo">
					<div class="accordion3"></div>
				</div>
                <div class="am-u-sm-12 userGo">
                    <?php foreach ($data['data'] as $item): ?>
                        <a href="<?php echo Url::toRoute(["user/noticecontent", "id" => $item["id"]]); ?>">
                            <div class="accordion">
                                <div class="accordionImg accImg3 opacity6"></div>
                                <div class="accordionName">
                                    <?php if ($lang == 'zh_CN') { ?>
                                        <?php echo $item["title"]; ?>
                                    <?php } else { ?>
                                        <?php echo $item["title_en"]; ?>
                                    <?php } ?>
                                </div>
                                <span style="color: #7b7b7b;font-size:12px;float: left;margin-left: 15%;">
                                    <?php echo date('Y/m/d',$item["created_at"]);?>
                                </span>
                                <div class="goRight">
                                    <img src="/img/goRight.png" />
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
			</div>
		</div>
</html>
