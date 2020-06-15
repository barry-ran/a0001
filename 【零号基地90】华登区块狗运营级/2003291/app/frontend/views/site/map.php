<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php echo Yii::t('app', '关于我们'); ?></title>
		<link rel="stylesheet" href="/css/ymj.css" />
		<link rel="stylesheet" href="/css/resetTable.css" />
	</head>
	<body>
		<div class="am-container">
			<div class="am-g">
                <a href="baidumap://map/direction?mode=driving:驾车&origin=24.4676182941,118.1740406281&destination=24.8052984558,118.4184909384&region=泉州">点击我调用百度地图导航1</a>

                <br />

                <a href="http://api.map.baidu.com/direction?origin=latlng:24.4676182941,118.1740406281|name:起点&destination=latlng:24.8052984558,118.4184909384|name:南安市金桥新城&mode=driving&region=泉州&output=html&src=webapp.baidu.openAPIdemo" target="_blank">点击我调用百度地图导航2</a>

                <br />

                <a href="http://api.map.baidu.com/direction?origin=latlng:34.264642646862,108.95108518068|name:我家&destination=西安交通大学&mode=driving&region=西安&output=html&src=webapp.baidu.openAPIdemo" target="_blank">点击我调用百度地图导航3</a>
			</div>
		</div>
	</body>
</html>