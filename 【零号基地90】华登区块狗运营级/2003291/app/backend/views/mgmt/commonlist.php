<?php

/**
 * @author shuang
 * @date 2016-8-4 14:59:08
 */
use yii\helpers\Url;
?>

<div class="formbody">
    <div class="formtitle"><span>常用功能</span></div>
    <div class="toolsli">
        <ul class="toollist">
            <?php foreach (backend\models\MY_Mgmt::getShortcutData(1) as $item): ?>
                <?php if ($item["url"] !== "mgmt/commonlist"): ?>
                    <li><a href="<?php echo Url::toRoute($item["url"]); ?>"><?php echo common\components\MTools::getPreviewImage($item["icon"], 65, 65); ?></a><h5><?php echo $item["title"]; ?></h5></li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        <span class="tooladd"><img src="/images/add.png" title="添加" /></span> 
    </div>
</div>
