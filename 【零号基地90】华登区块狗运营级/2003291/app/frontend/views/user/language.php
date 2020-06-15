<div  class="Body">
    <div  class="ng-scope">
        <div class="ng-scope">
            <?php echo $this->render("_linktop"); ?>
            <div class="panel">
                <div class="panelH">
                    <h2><em  class="ng-binding"><?php echo Yii::t('app', '语言'); ?></em></h2></div>
                <div  class="panelC">
                    <div class="languages">
                        <p  class="frm ng-scope"><label   class="cbox ng-scope ng-binding"><input type="radio" name="lang"  value="en_US">English</label></p>
                        <p  class="frm ng-scope"><label   class="cbox ng-scope ng-binding curLang"><input type="radio" name="lang"  checked="checked" value="zh_CN"><?php echo Yii::t('app', '中文(简体)'); ?></label></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
