<div class="navs3 ng-isolate-scope">
    <a  class="ng-binding ng-scope nav3 <?php echo $this->context->action->id == "index" ? "on" : ""; ?>" href="<?php echo \yii\helpers\Url::toRoute(["index"]) ?>"><?php echo Yii::t('app', '基本信息'); ?></a>
    <a  class="ng-binding ng-scope nav3 <?php echo $this->context->action->id == "security" ? "on" : ""; ?>" href="<?php echo \yii\helpers\Url::toRoute(["security"]) ?>"><?php echo Yii::t('app', '安全验证'); ?></a>
    <a  class="ng-binding ng-scope nav3 <?php echo $this->context->action->id == "links" ? "on" : ""; ?>" href="<?php echo \yii\helpers\Url::toRoute(["links"]) ?>"><?php echo Yii::t('app', '链接'); ?></a>
    <a  class="ng-binding ng-scope nav3 <?php echo $this->context->action->id == "language" ? "on" : ""; ?>" href="<?php echo \yii\helpers\Url::toRoute(["language"]) ?>"><?php echo Yii::t('app', '语言'); ?></a>
</div>