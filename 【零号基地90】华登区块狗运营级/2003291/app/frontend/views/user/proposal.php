<?php
use yii\helpers\Url;
?>
<div  class="Body">
    <div  class="ng-scope">
        <div class="ng-scope">
           
            <div class="panel">
           
                <div  class="panelC">
                     <?php echo $this->render("//layouts/prompt"); ?>
                    <form action= "<?php echo Url::toRoute(["proposal"]);?>" method="post" enctype="multipart/form-data">
                        <input type="text" name="news">
                        <input name="WB_UserServer[picture]" class="form-control" style="width:300px;" type="file">
                         <button type="submit" class="btn bg-blue color-white send-message">提交</button> 
                       
                       
                    </form>
                  
           
                </div>
            </div>
        </div>
    </div>
</div>
