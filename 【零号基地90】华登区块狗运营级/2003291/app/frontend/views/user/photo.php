<?php
use yii\helpers\Url;




?>
<div  class="Body">
    <div  class="ng-scope">
        <div class="ng-scope">
           
            <div class="panel">
                     <?php echo $this->render("_linktop"); ?>
                <div  class="panelC">
                    <form action= "<?php echo Url::toRoute(["photo"]);?>" method="post" enctype="multipart/form-data">
                    <div class="form-group field-addissueform-title required">
                        <label class="control-label">上传图片</label>
                        <input name="WB_UserServer[picture]" class="form-control" style="width:300px;" type="file">
                        <div class="help-block"></div>
                    </div>
                          <input type="submit" value="上传" />
                    </form>
           
                </div>
            </div>
        </div>
    </div>
</div>

 