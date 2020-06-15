<?php
/**
 * @author shuang
 * @date 2016-12-9 22:50:58
 */
use yii\helpers\Url;
?>
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="small-box bg-333 big-title" style="padding: 15px;"><?php echo Yii::t('app',"个人资料/关联账户")?></div>
        </div>
    </div>
    <form id="form-tras" class="form-horizontal bg-white">
         <?php echo $this->render("//layouts/prompt"); ?>
        <div class="row">
            <div class="col-lg-6">
                <div class="box-body bg-white">
                    <div class="form-group field-checkform-password required">
                        <label class="col-sm-3 control-label" for="checkform-password" style="font-size: 1.5rem"><?php echo Yii::t('app',"请输入交易密码")?></label>
                        <div class="col-sm-8">
                            <input id="checkform-password" class="form-control" name="traspass" type="password"><div class="help-block"></div>
                        </div>
                    </div>
                </div>
            </div>	
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="box-footer">
                    <div class="col-lg-6 col-xs-4"></div>
                    <div class="col-lg-1 col-xs-4">
                        <button type="button" class="btn bg-blue color-white" id="querytras"><?php echo Yii::t('app',"确认")?></button>
                    </div>
                    <div class="col-lg-5 col-xs-4"></div>
                </div>
            </div>
        </div>        
        </div>
    </form>  
</section>